<?php

if (!defined('UPDRAFTPLUS_DIR')) die('No direct access allowed.');

# Migrate options to new-style storage - Jan 2014
if (!is_array(UpdraftPlus_Options::get_updraft_option('updraft_s3')) && '' != UpdraftPlus_Options::get_updraft_option('updraft_s3_login', '')) {
	$opts = array(
		'accesskey' => UpdraftPlus_Options::get_updraft_option('updraft_s3_login'),
		'secretkey' => UpdraftPlus_Options::get_updraft_option('updraft_s3_pass'),
		'path' => UpdraftPlus_Options::get_updraft_option('updraft_s3_remote_path')
	);
	UpdraftPlus_Options::update_updraft_option('updraft_s3', $opts);
	UpdraftPlus_Options::delete_updraft_option('updraft_s3_login');
	UpdraftPlus_Options::delete_updraft_option('updraft_s3_pass');
	UpdraftPlus_Options::delete_updraft_option('updraft_s3_remote_path');
}

// This class is used by both UpdraftPlus_S3 and UpdraftPlus_S3_Compat
class UpdraftPlus_S3Exception extends Exception {
	public function __construct($message, $file, $line, $code = 0)
	{
		parent::__construct($message, $code);
		$this->file = $file;
		$this->line = $line;
	}
}

class UpdraftPlus_BackupModule_s3 {

	private $s3_object;
	private $got_with;
	protected $quota_used = null;

	protected function get_config() {
		global $updraftplus;
		$opts = $updraftplus->get_job_option('updraft_s3');
		if (!is_array($opts)) $opts = array('accesskey' => '', 'secretkey' => '', 'path' => '');
		$opts['whoweare'] = 'S3';
		$opts['whoweare_long'] = 'Amazon S3';
		$opts['key'] = 's3';
		return $opts;
	}

	public function get_credentials() {
		return array('updraft_s3');
	}

	protected function indicate_s3_class() {
		// N.B. : The classes must have different names, as if multiple remote storage options are chosen, then we could theoretically need both (if both Amazon and a compatible-S3 provider are used)
		// Conditional logic, for new AWS SDK (N.B. 3.x branch requires PHP 5.5, so we're on 2.x - requires 5.3.3)

		$opts = $this->get_config();
		$class_to_use = 'UpdraftPlus_S3';
		if (version_compare(PHP_VERSION, '5.3.3', '>=') && !empty($opts['key']) && ('s3' == $opts['key'] || 'updraftvault' == $opts['key']) && (!defined('UPDRAFTPLUS_S3_OLDLIB') || !UPDRAFTPLUS_S3_OLDLIB)) {
			$class_to_use = 'UpdraftPlus_S3_Compat';
		}

		if ('UpdraftPlus_S3_Compat' == $class_to_use) {
			if (!class_exists($class_to_use)) require_once(UPDRAFTPLUS_DIR.'/includes/S3compat.php');
		} else {
			if (!class_exists($class_to_use)) require_once(UPDRAFTPLUS_DIR.'/includes/S3.php');
		}
		return $class_to_use;
	}

	// Get an S3 object, after setting our options
	public function getS3($key, $secret, $useservercerts, $disableverify, $nossl, $endpoint = null, $sse = false) {

		if (!empty($this->s3_object) && !is_wp_error($this->s3_object)) return $this->s3_object;

		if (is_string($key)) $key = trim($key);
		if (is_string($secret)) $secret = trim($secret);

		// Saved in case the object needs recreating for the corner-case where there is no permission to look up the bucket location
		$this->got_with = array(
			'key' => $key,
			'secret' => $secret,
			'useservercerts' => $useservercerts,
			'disableverify' => $disableverify,
			'nossl' => $nossl,
			'server_side_encryption' => $sse
		);

		if (is_wp_error($key)) return $key;

		if ('' == $key || '' == $secret) {
			return new WP_Error('no_settings', __('No settings were found','updraftplus'));
		}

		global $updraftplus;

		$use_s3_class = $this->indicate_s3_class();

		if (!class_exists('WP_HTTP_Proxy')) require_once(ABSPATH.WPINC.'/class-http.php');
		$proxy = new WP_HTTP_Proxy();

		$use_ssl = true;
		$ssl_ca = true;
		if (!$nossl) {
			$curl_version = (function_exists('curl_version')) ? curl_version() : array('features' => null);
			$curl_ssl_supported = ($curl_version['features'] & CURL_VERSION_SSL);
			if ($curl_ssl_supported) {
				if ($disableverify) {
					$ssl_ca = false;
					//$s3->setSSL(true, false);
					$updraftplus->log("S3: Disabling verification of SSL certificates");
				} else {
					if ($useservercerts) {
						$updraftplus->log("S3: Using the server's SSL certificates");
						$ssl_ca = 'system';
					} else {
						$ssl_ca = file_exists(UPDRAFTPLUS_DIR.'/includes/cacert.pem') ? UPDRAFTPLUS_DIR.'/includes/cacert.pem' : true;
					}
				}
			} else {
				$use_ssl = false;
				$updraftplus->log("S3: Curl/SSL is not available. Communications will not be encrypted.");
			}
		} else {
			$use_ssl = false;
			$updraftplus->log("SSL was disabled via the user's preference. Communications will not be encrypted.");
		}

		try {
			$s3 = new $use_s3_class($key, $secret, $use_ssl, $ssl_ca, $endpoint);
		} catch (Exception $e) {
			$updraftplus->log(sprintf(__('%s Error: Failed to initialise','updraftplus'), 'S3').": ".$e->getMessage().' (line: '.$e->getLine().', file: '.$e->getFile().')');
			$updraftplus->log(sprintf(__('%s Error: Failed to initialise','updraftplus'), $key), 'S3');
			return new WP_Error('s3_init_failed', sprintf(__('%s Error: Failed to initialise','updraftplus'), 'S3').": ".$e->getMessage().' (line: '.$e->getLine().', file: '.$e->getFile().')');
		}

		if ($proxy->is_enabled()) {
			# WP_HTTP_Proxy returns empty strings where we want nulls
			$user = $proxy->username();
			if (empty($user)) {
				$user = null;
				$pass = null;
			} else {
				$pass = $proxy->password();
				if (empty($pass)) $pass = null;
			}
			$port = (int)$proxy->port();
			if (empty($port)) $port = 8080;
			$s3->setProxy($proxy->host(), $user, $pass, CURLPROXY_HTTP, $port); 
		}

// Old: from before we passed the SSL options when getting the object
// 		if (!$nossl) {
// 			$curl_version = (function_exists('curl_version')) ? curl_version() : array('features' => null);
// 			$curl_ssl_supported = ($curl_version['features'] & CURL_VERSION_SSL);
// 			if ($curl_ssl_supported) {
// 				if ($disableverify) {
// 					$s3->setSSL(true, false);
// 					$updraftplus->log("S3: Disabling verification of SSL certificates");
// 				} else {
// 					$s3->setSSL(true, true);
// 				}
// 				if ($useservercerts) {
// 					$updraftplus->log("S3: Using the server's SSL certificates");
// 				} else {
// 					$s3->setSSLAuth(null, null, UPDRAFTPLUS_DIR.'/includes/cacert.pem');
// 				}
// 			} else {
// 				$s3->setSSL(false, false);
// 				$updraftplus->log("S3: Curl/SSL is not available. Communications will not be encrypted.");
// 			}
// 		} else {
// 			$s3->setSSL(false, false);
// 			$updraftplus->log("SSL was disabled via the user's preference. Communications will not be encrypted.");
// 		}

		if (method_exists($s3, 'setServerSideEncryption') && (is_a($this, 'UpdraftPlus_BackupModule_updraftvault') || $sse)) $s3->setServerSideEncryption('AES256');

		$this->s3_object = $s3;

		return $this->s3_object;
	}

	protected function set_region($obj, $region, $bucket_name = '') {
		global $updraftplus;
		switch ($region) {
			case 'EU':
			case 'eu-west-1':
				$endpoint = 's3-eu-west-1.amazonaws.com';
				break;
			case 'us-west-1':
				$endpoint = 's3.amazonaws.com';
				break;
			case 'us-west-2':
			case 'ap-southeast-1':
			case 'ap-southeast-2':
			case 'ap-northeast-1':
			case 'ap-northeast-2':
			case 'sa-east-1':
			case 'us-gov-west-1':
			case 'eu-central-1':
				$endpoint = 's3-'.$region.'.amazonaws.com';
				break;
			case 'cn-north-1':
				$endpoint = 's3.'.$region.'.amazonaws.com.cn';
				break;
			default:
				break;
		}

		if (isset($endpoint)) {
			if (is_a($obj, 'UpdraftPlus_S3_Compat')) {
				$updraftplus->log("Set region: $region");
				$obj->setRegion($region);
				return;
			}

			$updraftplus->log("Set endpoint: $endpoint");

			if ($region == 'us-west-1') {
				$obj->useDNSBucketName(true, $bucket_name);
				return;
			}

			return $obj->setEndpoint($endpoint);
		}
	}

	public function backup($backup_array) {

		global $updraftplus, $updraftplus_backup;

		$config = $this->get_config();

		if (empty($config['accesskey']) && !empty($config['error_message'])) {
			$err = new WP_Error('no_settings', $config['error_message']);
			return $updraftplus->log_wp_error($err, false, true);
		}

		$whoweare = $config['whoweare'];
		$whoweare_key = $config['key'];
		$whoweare_keys = substr($whoweare_key, 0, 3);
		$sse = (empty($config['server_side_encryption'])) ? false : true;

		$s3 = $this->getS3(
			$config['accesskey'],
			$config['secretkey'],
			UpdraftPlus_Options::get_updraft_option('updraft_ssl_useservercerts'), UpdraftPlus_Options::get_updraft_option('updraft_ssl_disableverify'),
			UpdraftPlus_Options::get_updraft_option('updraft_ssl_nossl'),
			null,
			$sse
		);

		if (is_wp_error($s3)) return $updraftplus->log_wp_error($s3, false, true);

		if (is_a($s3, 'UpdraftPlus_S3_Compat') && !class_exists('XMLWriter')) {
			$updraftplus->log('The required XMLWriter PHP module is not installed');
			$updraftplus->log(sprintf(__('The required %s PHP module is not installed - ask your web hosting company to enable it', 'updraftplus'), 'XMLWriter'), 'error');
			return false;
		}

		$bucket_name = untrailingslashit($config['path']);
		$bucket_path = "";
		$orig_bucket_name = $bucket_name;

		if (preg_match("#^([^/]+)/(.*)$#",$bucket_name,$bmatches)) {
			$bucket_name = $bmatches[1];
			$bucket_path = $bmatches[2]."/";
		}

		// This needs to cope with both original S3 and others (where there is no getBucketLocation())
		$region = ($config['key'] == 's3' || $config['key'] == 'updraftvault') ? @$s3->getBucketLocation($bucket_name) : 'n/a';

		// See if we can detect the region (which implies the bucket exists and is ours), or if not create it
		if (!empty($region) || @$s3->putBucket($bucket_name, 'private') || ('s3' == $config['key'] && false !== ($s3 = $this->use_dns_bucket_name($s3, $bucket_name)) && false !== @$s3->getBucket($bucket_name, $bucket_path, null, 1))) {
			if (empty($region) && ($config['key'] == 's3' || $config['key'] == 'updraftvault')) $region = $s3->getBucketLocation($bucket_name);
			if (!empty($region)) $this->set_region($s3, $region, $bucket_name);

			$updraft_dir = trailingslashit($updraftplus->backups_dir_location());

			foreach ($backup_array as $key => $file) {

				// We upload in 5MB chunks to allow more efficient resuming and hence uploading of larger files
				// N.B.: 5MB is Amazon's minimum. So don't go lower or you'll break it.
				$fullpath = $updraft_dir.$file;
				$orig_file_size = filesize($fullpath);

				if (isset($config['quota']) && method_exists($this, 's3_get_quota_info')) {
					$quota_used = $this->s3_get_quota_info('numeric', $config['quota']);
					if (false === $quota_used) {
						$updraftplus->log("Quota usage: count failed");
					} else {
						$this->quota_used = $quota_used;
						if ($config['quota'] - $this->quota_used < $orig_file_size) {
							if (method_exists($this, 's3_out_of_quota')) call_user_func(array($this, 's3_out_of_quota'), $config['quota'], $this->quota_used, $orig_file_size);
							continue;
						} else {
							// We don't need to log this always - the s3_out_of_quota method will do its own logging
							$updraftplus->log("$whoweare: Quota is available: used=$quota_used (".round($quota_used/1048576, 1)." MB), total=".$config['quota']." (".round($config['quota']/1048576, 1)." MB), needed=$orig_file_size (".round($orig_file_size/1048576, 1)." MB)");
						}
					}
				}

				$chunks = floor($orig_file_size / 5242880);
				// There will be a remnant unless the file size was exactly on a 5MB boundary
				if ($orig_file_size % 5242880 > 0) $chunks++;
				$hash = md5($file);

				$updraftplus->log("$whoweare upload ($region): $file (chunks: $chunks) -> $whoweare_key://$bucket_name/$bucket_path$file");

				$filepath = $bucket_path.$file;

				// This is extra code for the 1-chunk case, but less overhead (no bothering with job data)
				if ($chunks < 2) {
					$s3->setExceptions(true);
					try {
						if (!$s3->putObjectFile($fullpath, $bucket_name, $filepath, 'private', array(), array(), apply_filters('updraft_'.$whoweare_key.'_storageclass', 'STANDARD', $s3, $config))) {
							$updraftplus->log("$whoweare regular upload: failed ($fullpath)");
							$updraftplus->log("$file: ".sprintf(__('%s Error: Failed to upload','updraftplus'),$whoweare), 'error');
						} else {
							$this->quota_used += $orig_file_size;
							if (method_exists($this, 's3_record_quota_info')) $this->s3_record_quota_info($this->quota_used, $config['quota']);
							$extra_log = '';
							if (method_exists($this, 's3_get_quota_info')) {
								$extra_log = ', quota used now: '.round($this->quota_used / 1048576, 1).' MB';
							}
							$updraftplus->log("$whoweare regular upload: success$extra_log");
							$updraftplus->uploaded_file($file);
						}
					} catch (Exception $e) {
						$updraftplus->log("$file: ".sprintf(__('%s Error: Failed to upload','updraftplus'),$whoweare).": ".$e->getMessage().' (line: '.$e->getLine().', file: '.$e->getFile());
						$updraftplus->log("$file: ".sprintf(__('%s Error: Failed to upload','updraftplus'),$whoweare), 'error');
					}
					$s3->setExceptions(false);
				} else {

					// Retrieve the upload ID
					$uploadId = $updraftplus->jobdata_get("upd_${whoweare_keys}_${hash}_uid");
					if (empty($uploadId)) {
						$s3->setExceptions(true);
						try {
							$uploadId = $s3->initiateMultipartUpload($bucket_name, $filepath, 'private', array(), array(), apply_filters('updraft_'.$whoweare_key.'_storageclass', 'STANDARD', $s3, $config));
						} catch (Exception $e) {
							$updraftplus->log("$whoweare error whilst trying initiateMultipartUpload: ".$e->getMessage().' (line: '.$e->getLine().', file: '.$e->getFile().')');
							$uploadId = false;
						}
						$s3->setExceptions(false);

						if (empty($uploadId)) {
							$updraftplus->log("$whoweare upload: failed: could not get uploadId for multipart upload ($filepath)");
							$updraftplus->log(sprintf(__("%s upload: getting uploadID for multipart upload failed - see log file for more details",'updraftplus'),$whoweare), 'error');
							continue;
						} else {
							$updraftplus->log("$whoweare chunked upload: got multipart ID: $uploadId");
							$updraftplus->jobdata_set("upd_${whoweare_keys}_${hash}_uid", $uploadId);
						}
					} else {
						$updraftplus->log("$whoweare chunked upload: retrieved previously obtained multipart ID: $uploadId");
					}

					$successes = 0;
					$etags = array();
					for ($i = 1 ; $i <= $chunks; $i++) {
						# Shorted to upd here to avoid hitting the 45-character limit
						$etag = $updraftplus->jobdata_get("ud_${whoweare_keys}_${hash}_e$i");
						if (strlen($etag) > 0) {
							$updraftplus->log("$whoweare chunk $i: was already completed (etag: $etag)");
							$successes++;
							array_push($etags, $etag);
						} else {
							// Sanity check: we've seen a case where an overlap was truncating the file from underneath us
							if (filesize($fullpath) < $orig_file_size) {
								$updraftplus->log("$whoweare error: $key: chunk $i: file was truncated underneath us (orig_size=$orig_file_size, now_size=".filesize($fullpath).")");
								$updraftplus->log(sprintf(__('%s error: file %s was shortened unexpectedly', 'updraftplus'), $whoweare, $fullpath), 'error');
							}
							$etag = $s3->uploadPart($bucket_name, $filepath, $uploadId, $fullpath, $i);
							if ($etag !== false && is_string($etag)) {
								$updraftplus->record_uploaded_chunk(round(100*$i/$chunks,1), "$i, $etag", $fullpath);
								array_push($etags, $etag);
								$updraftplus->jobdata_set("ud_${whoweare_keys}_${hash}_e$i", $etag);
								$successes++;
							} else {
								$updraftplus->log("$whoweare chunk $i: upload failed");
								$updraftplus->log(sprintf(__("%s chunk %s: upload failed",'updraftplus'),$whoweare, $i), 'error');
							}
						}
					}
					if ($successes >= $chunks) {
						$updraftplus->log("$whoweare upload: all chunks uploaded; will now instruct $whoweare to re-assemble");

						$s3->setExceptions(true);
						try {
							if ($s3->completeMultipartUpload($bucket_name, $filepath, $uploadId, $etags)) {
								$updraftplus->log("$whoweare upload ($key): re-assembly succeeded");
								$updraftplus->uploaded_file($file);
								$this->quota_used += $orig_file_size;
								if (method_exists($this, 's3_record_quota_info')) $this->s3_record_quota_info($this->quota_used, $config['quota']);
							} else {
								$updraftplus->log("$whoweare upload ($key): re-assembly failed ($file)");
								$updraftplus->log(sprintf(__('%s upload (%s): re-assembly failed (see log for more details)','updraftplus'),$whoweare, $key), 'error');
							}
						} catch (Exception $e) {
							$updraftplus->log("$whoweare re-assembly error ($key): ".$e->getMessage().' (line: '.$e->getLine().', file: '.$e->getFile().')');
							$updraftplus->log($e->getMessage().": ".sprintf(__('%s re-assembly error (%s): (see log file for more)','updraftplus'),$whoweare, $e->getMessage()), 'error');
						}
						// Remember to unset, as the deletion code later reuses the object
						$s3->setExceptions(false);
					} else {
						$updraftplus->log("$whoweare upload: upload was not completely successful on this run");
					}
				}
			}
			return array('s3_object' => $s3, 's3_orig_bucket_name' => $orig_bucket_name);
		} else {
			$updraftplus->log("$whoweare Error: Failed to create bucket $bucket_name.");
			$updraftplus->log(sprintf(__('%s Error: Failed to create bucket %s. Check your permissions and credentials.','updraftplus'),$whoweare, $bucket_name), 'error');
		}
	}

	public function listfiles($match = 'backup_') {

		global $updraftplus;

		$config = $this->get_config();
		$whoweare = $config['whoweare'];
		$whoweare_key = $config['key'];
		$sse = empty($config['server_side_encryption']) ? false : true;

		$s3 = $this->getS3(
			$config['accesskey'],
			$config['secretkey'],
			UpdraftPlus_Options::get_updraft_option('updraft_ssl_useservercerts'), UpdraftPlus_Options::get_updraft_option('updraft_ssl_disableverify'),
			UpdraftPlus_Options::get_updraft_option('updraft_ssl_nossl'),
			null,
			$sse
		);

		if (is_wp_error($s3)) return $s3;
		if (!is_a($s3, 'UpdraftPlus_S3') && !is_a($s3, 'UpdraftPlus_S3_Compat')) return new WP_Error('no_s3object', 'Failed to gain access to '.$config['whoweare']);

		$bucket_name = untrailingslashit($config['path']);
		$bucket_path = '';

		if (preg_match("#^([^/]+)/(.*)$#", $bucket_name, $bmatches)) {
			$bucket_name = $bmatches[1];
			$bucket_path = trailingslashit($bmatches[2]);
		}

		if (!empty($config['is_new_bucket'])) {
			if (method_exists($s3, 'waitForBucket')) {
				$s3->setExceptions(true);
				try {
					$s3->waitForBucket($bucket_name);
				} catch (Exception $e) {
					// This seems to often happen - we get a 403 on a newly created user/bucket pair, even though the bucket was already waited for by the creator
					// We could just sleep() - a sleep(5) seems to do it. However, given that it's a new bucket, that's unnecessary.
					$s3->setExceptions(false);
					return array();
				}
				$s3->setExceptions(false);
			} else {
				sleep(4);
			}
		} elseif (!empty($config['is_new_user'])) {
			// A crude waiter, because the AWS toolkit does not have one for IAM propagation - basically, loop around a few times whilst the access attempt still fails
			$attempt_flag = 0;
			while ($attempt_flag < 5) {

				$attempt_flag++;
				if (@$s3->getBucketLocation($bucket_name)) {
					$attempt_flag = 100;
				} else {

					sleep($attempt_flag*1.5 + 1);
					
					// Get the bucket object again... because, for some reason, the AWS PHP SDK (at least on the current version we're using, March 2016) calculates an incorrect signature on subsequent attempts
					$this->s3_object = null;
					$s3 = $this->getS3(
						$config['accesskey'],
						$config['secretkey'],
						UpdraftPlus_Options::get_updraft_option('updraft_ssl_useservercerts'), UpdraftPlus_Options::get_updraft_option('updraft_ssl_disableverify'),
						UpdraftPlus_Options::get_updraft_option('updraft_ssl_nossl'),
						null,
						$sse
					);

					if (is_wp_error($s3)) return $s3;
					if (!is_a($s3, 'UpdraftPlus_S3') && !is_a($s3, 'UpdraftPlus_S3_Compat')) return new WP_Error('no_s3object', 'Failed to gain access to '.$config['whoweare']);
					
				}
			}
		}

		$region = ($config['key'] == 'dreamobjects' || $config['key'] == 's3generic') ? 'n/a' : @$s3->getBucketLocation($bucket_name);
		if (!empty($region)) {
			$this->set_region($s3, $region, $bucket_name);
		} else {
			# Final thing to attempt - see if it was just the location request that failed
			$s3 = $this->use_dns_bucket_name($s3, $bucket_name);
			if (false === ($gb = @$s3->getBucket($bucket_name, $bucket_path, null, 1))) {
				$updraftplus->log("$whoweare Error: Failed to access bucket $bucket_name. Check your permissions and credentials.");
				return new WP_Error('bucket_not_accessed', sprintf(__('%s Error: Failed to access bucket %s. Check your permissions and credentials.','updraftplus'),$whoweare, $bucket_name));
			}
		}

		$bucket = $s3->getBucket($bucket_name, $bucket_path.$match);

		if (!is_array($bucket)) return array();

		$results = array();

		foreach ($bucket as $key => $object) {
			if (!is_array($object) || empty($object['name'])) continue;
			if (isset($object['size']) && 0 == $object['size']) continue;

			if ($bucket_path) {
				if (0 !== strpos($object['name'], $bucket_path)) continue;
				$object['name'] = substr($object['name'], strlen($bucket_path));
			} else {
				if (false !== strpos($object['name'], '/')) continue;
			}

			$result = array('name' => $object['name']);
			if (isset($object['size'])) $result['size'] = $object['size'];
			unset($bucket[$key]);
			$results[] = $result;
		}

		return $results;

	}

	public function delete($files, $s3arr = false, $sizeinfo = array()) {

		global $updraftplus;
		if (is_string($files)) $files=array($files);

		$config = $this->get_config();
		$sse = (empty($config['server_side_encryption'])) ? false : true;
		$whoweare = $config['whoweare'];

		if ($s3arr) {
			$s3 = $s3arr['s3_object'];
			$orig_bucket_name = $s3arr['s3_orig_bucket_name'];
		} else {

			$s3 = $this->getS3(
				$config['accesskey'],
				$config['secretkey'],
				UpdraftPlus_Options::get_updraft_option('updraft_ssl_useservercerts'), UpdraftPlus_Options::get_updraft_option('updraft_ssl_disableverify'),
				UpdraftPlus_Options::get_updraft_option('updraft_ssl_nossl'),
				null,
				$sse
			);

			if (is_wp_error($s3)) return $updraftplus->log_wp_error($s3, false, false);

			$bucket_name = untrailingslashit($config['path']);
			$orig_bucket_name = $bucket_name;

			if (preg_match("#^([^/]+)/(.*)$#",$bucket_name,$bmatches)) {
				$bucket_name = $bmatches[1];
				$bucket_path = $bmatches[2]."/";
			} else {
				$bucket_path = '';
			}

			$region = ($config['key'] == 'dreamobjects' || $config['key'] == 's3generic') ? 'n/a' : @$s3->getBucketLocation($bucket_name);
			if (!empty($region)) {
				$this->set_region($s3, $region, $bucket_name);
			} else {
				# Final thing to attempt - see if it was just the location request that failed
				$s3 = $this->use_dns_bucket_name($s3, $bucket_name);
				if (false === ($gb = @$s3->getBucket($bucket_name, $bucket_path, null, 1))) {
					$updraftplus->log("$whoweare Error: Failed to access bucket $bucket_name. Check your permissions and credentials.");
					$updraftplus->log(sprintf(__('%s Error: Failed to access bucket %s. Check your permissions and credentials.','updraftplus'),$whoweare, $bucket_name), 'error');
					return false;
				}
			}
		}

		$ret = true;

		foreach ($files as $i => $file) {

			if (preg_match("#^([^/]+)/(.*)$#", $orig_bucket_name, $bmatches)) {
				$s3_bucket=$bmatches[1];
				$s3_uri = $bmatches[2]."/".$file;
			} else {
				$s3_bucket = $orig_bucket_name;
				$s3_uri = $file;
			}
			$updraftplus->log("$whoweare: Delete remote: bucket=$s3_bucket, URI=$s3_uri");

			$s3->setExceptions(true);
			try {
				if (!$s3->deleteObject($s3_bucket, $s3_uri)) {
					$updraftplus->log("$whoweare: Delete failed");
				} elseif (null !== $this->quota_used && !empty($sizeinfo[$i]) && isset($config['quota']) && method_exists($this, 's3_record_quota_info')) {
					$this->quota_used -= $sizeinfo[$i];
					$this->s3_record_quota_info($this->quota_used, $config['quota']);
				}
			} catch (Exception $e) {
				$updraftplus->log("$whoweare delete failed: ".$e->getMessage().' (line: '.$e->getLine().', file: '.$e->getFile().')');
				$s3->setExceptions(false);
				$ret = false;
			}
			$s3->setExceptions(false);

		}

		return $ret;

	}

	public function download($file) {

		global $updraftplus;

		$config = $this->get_config();
		$whoweare = $config['whoweare'];
		$sse = (empty($config['server_side_encryption'])) ? false : true;

		$s3 = $this->getS3(
			$config['accesskey'],
			$config['secretkey'],
			UpdraftPlus_Options::get_updraft_option('updraft_ssl_useservercerts'), UpdraftPlus_Options::get_updraft_option('updraft_ssl_disableverify'),
			UpdraftPlus_Options::get_updraft_option('updraft_ssl_nossl'),
			null,
			$sse
		);
		if (is_wp_error($s3)) return $updraftplus->log_wp_error($s3, false, true);

		$bucket_name = untrailingslashit($config['path']);
		$bucket_path = "";

		if (preg_match("#^([^/]+)/(.*)$#", $bucket_name, $bmatches)) {
			$bucket_name = $bmatches[1];
			$bucket_path = $bmatches[2]."/";
		}

		$region = ($config['key'] == 'dreamobjects' || $config['key'] == 's3generic') ? 'n/a' : @$s3->getBucketLocation($bucket_name);

		if (empty($region) && 's3' == $config['key']) {
			# Final thing to attempt - see if it was just the location request that failed
			$s3 = $this->use_dns_bucket_name($s3, $bucket_name);
			if (false !== ($gb = @$s3->getBucket($bucket_name, $bucket_path, null, 1))) {
				$keep_going = true;
			}
		}

		if (!empty($region) || !empty($keep_going)) {
			$this->set_region($s3, $region, $bucket_name);
			$fullpath = $updraftplus->backups_dir_location().'/'.$file;
			if (!$s3->getObject($bucket_name, $bucket_path.$file, $fullpath, true)) {
				$updraftplus->log("$whoweare Error: Failed to download $file. Check your permissions and credentials.");
				$updraftplus->log(sprintf(__('%s Error: Failed to download %s. Check your permissions and credentials.','updraftplus'),$whoweare, $file), 'error');
				return false;
			}
		} else {
			$updraftplus->log("$whoweare Error: Failed to access bucket $bucket_name. Check your permissions and credentials.");
			$updraftplus->log(sprintf(__('%s Error: Failed to access bucket %s. Check your permissions and credentials.','updraftplus'),$whoweare, $bucket_name), 'error');
			return false;
		}
		return true;

	}

	public function config_print() {
	
		# White: https://d36cz9buwru1tt.cloudfront.net/Powered-by-Amazon-Web-Services.jpg
		$this->config_print_engine('s3', 'S3', 'Amazon S3', 'AWS', 'https://aws.amazon.com/console/', '<img src="//awsmedia.s3.amazonaws.com/AWS_logo_poweredby_black_127px.png" alt="Amazon Web Services">');
		
	}

	public function config_print_engine($key, $whoweare_short, $whoweare_long, $console_descrip, $console_url, $img_html = '', $include_endpoint_chooser = false) {

		$opts = $this->get_config();
		?>
		<tr class="updraftplusmethod <?php echo $key; ?>">
			<td></td>
			<td><?php echo $img_html ?><p><em><?php printf(__('%s is a great choice, because UpdraftPlus supports chunked uploads - no matter how big your site is, UpdraftPlus can upload it a little at a time, and not get thwarted by timeouts.','updraftplus'),$whoweare_long);?></em></p>
			<?php
				if ('s3generic' == $key) {
					_e('Examples of S3-compatible storage providers:').' ';
					echo '<a href="http://www.cloudian.com/">Cloudian</a>, ';
					echo '<a href="https://www.mh.connectria.com/rp/order/cloud_storage_index">Connectria</a>, ';
					echo '<a href="http://www.constant.com/cloud/storage/">Constant</a>, ';
					echo '<a href="http://www.eucalyptus.com/eucalyptus-cloud/iaas">Eucalyptus</a>, ';
					echo '<a href="http://cloud.nifty.com/storage/">Nifty</a>, ';
					echo '<a href="http://www.ntt.com/cloudn/data/storage.html">Cloudn</a>';
					echo ''.__('... and many more!', 'updraftplus').'<br>';
				}
			?>
			</td>
		</tr>
		<tr class="updraftplusmethod <?php echo $key; ?>">
		<th></th>
		<td>
		<?php
			global $updraftplus_admin;

			$use_s3_class = $this->indicate_s3_class();

			if ('UpdraftPlus_S3_Compat' == $use_s3_class && !class_exists('XMLWriter')) {
				$updraftplus_admin->show_double_warning('<strong>'.__('Warning', 'updraftplus').':</strong> '. sprintf(__("Your web server's PHP installation does not included a required module (%s). Please contact your web hosting provider's support and ask for them to enable it.", 'updraftplus'), 'XMLWriter'));
			}

			if (!class_exists('SimpleXMLElement')) {
				$updraftplus_admin->show_double_warning('<strong>'.__('Warning', 'updraftplus').':</strong> '.sprintf(__("Your web server's PHP installation does not included a required module (%s). Please contact your web hosting provider's support.", 'updraftplus'), 'SimpleXMLElement').' '.sprintf(__("UpdraftPlus's %s module <strong>requires</strong> %s. Please do not file any support requests; there is no alternative.", 'updraftplus'),$whoweare_long, 'SimpleXMLElement'), $key);
			}
			$updraftplus_admin->curl_check($whoweare_long, true, $key);
		?>

		</td>
		</tr>
		<tr class="updraftplusmethod <?php echo $key; ?>">
		<th></th>
		<td>
			<p>
				<?php if ($console_url) echo sprintf(__('Get your access key and secret key <a href="%s">from your %s console</a>, then pick a (globally unique - all %s users) bucket name (letters and numbers) (and optionally a path) to use for storage. This bucket will be created for you if it does not already exist.','updraftplus'), $console_url, $console_descrip, $whoweare_long);?>

				<a href="https://updraftplus.com/faqs/i-get-ssl-certificate-errors-when-backing-up-andor-restoring/"><?php _e('If you see errors about SSL certificates, then please go here for help.','updraftplus');?></a>

				<a href="https://updraftplus.com/faq-category/amazon-s3/"><?php if ('s3' == $key) echo sprintf(__('Other %s FAQs.', 'updraftplus'), 'S3');?></a>
			</p>
		</td></tr>
		<?php if ($include_endpoint_chooser) { ?>
		<tr class="updraftplusmethod <?php echo $key; ?>">
			<th><?php echo sprintf(__('%s end-point','updraftplus'), $whoweare_short);?>:</th>
			<td><input data-updraft_settings_test="endpoint" type="text" style="width: 360px" id="updraft_<?php echo $key; ?>_endpoint" name="updraft_<?php echo $key; ?>[endpoint]" value="<?php if (!empty($opts['endpoint'])) echo esc_attr($opts['endpoint']); ?>" /></td>
		</tr>
		<?php } else { ?>
			<input data-updraft_settings_test="endpoint" type="hidden" id="updraft_<?php echo $key; ?>_endpoint" name="updraft_<?php echo $key; ?>_endpoint" value="">
		<?php } ?>
		<?php if ('s3' == $key && version_compare(PHP_VERSION, '5.3.3', '>=') && class_exists('UpdraftPlus_Addon_S3_Enhanced')) { ?>
			<tr class="updraftplusmethod <?php echo $key; ?>">
				<th></th>
				<td><?php echo apply_filters('updraft_s3_apikeysetting', '<a href="https://updraftplus.com/shop/s3-enhanced/"><em>'.__('To create a new IAM sub-user and access key that has access only to this bucket, use this add-on.', 'updraftplus').'</em></a>'); ?></td>
			</tr>
		<?php } ?>

		<tr class="updraftplusmethod <?php echo $key; ?>">
			<th><?php echo sprintf(__('%s access key','updraftplus'), $whoweare_short);?>:</th>
			<td><input data-updraft_settings_test="apikey" type="text" autocomplete="off" style="width: 360px" id="updraft_<?php echo $key; ?>_apikey" name="updraft_<?php echo $key; ?>[accesskey]" value="<?php echo esc_attr($opts['accesskey']); ?>" /></td>
		</tr>
		<tr class="updraftplusmethod <?php echo $key; ?>">
			<th><?php echo sprintf(__('%s secret key','updraftplus'), $whoweare_short);?>:</th>
			<td><input data-updraft_settings_test="apisecret" type="<?php echo apply_filters('updraftplus_admin_secret_field_type', 'text'); ?>" autocomplete="off" style="width: 360px" id="updraft_<?php echo $key; ?>_apisecret" name="updraft_<?php echo $key; ?>[secretkey]" value="<?php echo esc_attr($opts['secretkey']); ?>" /></td>
		</tr>
		<tr class="updraftplusmethod <?php echo $key; ?>">
			<th><?php echo sprintf(__('%s location','updraftplus'), $whoweare_short);?>:</th>
			<td><?php echo $key; ?>://<input data-updraft_settings_test="path" title="<?php echo htmlspecialchars(__('Enter only a bucket name or a bucket and path. Examples: mybucket, mybucket/mypath', 'updraftplus')); ?>" type="text" style="width: 360px" name="updraft_<?php echo $key; ?>[path]" id="updraft_<?php echo $key; ?>_path" value="<?php echo esc_attr($opts['path']); ?>" /></td>
		</tr>
		<?php do_action('updraft_'.$key.'_extra_storage_options', $opts); ?>
		<tr class="updraftplusmethod <?php echo $key; ?>">
			<th></th>
			<td><p><button id="updraft-<?php echo $key; ?>-test" type="button" class="button-primary updraft-test-button" data-method_label="<?php esc_attr_e($whoweare_short);?>" data-method="<?php echo $key;?>"><?php echo htmlspecialchars(sprintf(__('Test %s Settings','updraftplus'),$whoweare_short));?></button></p></td>
		</tr>

	<?php
	}

	public function credentials_test($posted_settings) {
		return $this->credentials_test_engine($this->get_config(), $posted_settings);
	}

	// This is not pretty, but is the simplest way to accomplish the task within the pre-existing structure (no need to re-invent the wheel of code with corner-cases debugged over years)
	public function use_dns_bucket_name($s3, $bucket, $echo_errors = false) {
		if (is_a($s3, 'UpdraftPlus_S3_Compat')) {
			$this->s3_object = null;
			$s3 = $this->getS3($this->got_with['key'], $this->got_with['secret'], $this->got_with['useservercerts'], $this->got_with['disableverify'], $this->got_with['nossl'], $bucket.".s3.amazonaws.com", $this->got_with['server_side_encryption']);
			if (is_wp_error($s3)) {
				if ($echo_errors) {
					foreach ($s3->get_error_messages() as $msg) { echo $msg."\n"; }
				} else {
					global $updraftplus;
					$updraftplus->log_wp_error($s3);
				}
				return;
			}
			global $updraftplus;
			if (!$echo_errors) $updraftplus->log("Using DNS bucket name: $bucket.s3.amazonaws.com");
		} else {
			$s3->useDNSBucketName(true, $bucket);
		}
		return $s3;
	}

	public function credentials_test_engine($config, $posted_settings) {

		if (empty($posted_settings['apikey'])) {
			printf(__("Failure: No %s was given.",'updraftplus'),__('API key','updraftplus'));
			return;
		}
		if (empty($posted_settings['apisecret'])) {
			printf(__("Failure: No %s was given.",'updraftplus'),__('API secret','updraftplus'));
			return;
		}

		$key = $posted_settings['apikey'];
		$secret = stripslashes($posted_settings['apisecret']);
		$path = $posted_settings['path'];
		$useservercerts = (isset($posted_settings['useservercerts'])) ? absint($posted_settings['useservercerts']) : 0;
		$disableverify = (isset($posted_settings['disableverify'])) ? absint($posted_settings['disableverify']) : 0;
		$nossl = (isset($posted_settings['nossl'])) ? absint($posted_settings['nossl']) : 0;
		$endpoint = (isset($posted_settings['endpoint'])) ? $posted_settings['endpoint'] : '';
		$sse = !empty($posted_settings['sse']) ? true : false;

		if (preg_match("#^/*([^/]+)/(.*)$#", $path, $bmatches)) {
			$bucket = $bmatches[1];
			$path = trailingslashit($bmatches[2]);
		} else {
			$bucket = $path;
			$path = "";
		}

		if (empty($bucket)) {
			_e("Failure: No bucket details were given.",'updraftplus');
			return;
		}
		$whoweare = $config['whoweare'];

		$s3 = $this->getS3($key, $secret, $useservercerts, $disableverify, $nossl, null, $sse);
		if (is_wp_error($s3)) {
			foreach ($s3->get_error_messages() as $msg) {
				echo $msg."\n";
			}
			return;
		}

		$location = ('s3' == $config['key'] || 'updraftvault' == $config['key']) ? @$s3->getBucketLocation($bucket) : 'n/a';

		if ('s3' != $config['key']) $this->set_region($s3, $endpoint, $bucket);

		if ($location && 'n/a' != $location) {
			if ('s3' == $config['key']) {
				$bucket_exists = true;
				$bucket_verb = __('Region','updraftplus').": $location: ";
			} else {
				$bucket_verb = '';
			}
		}

		# Saw one case where there was read/write permission, but no permission to get the location - yet the bucket did exist. Try to detect that.
		# Feb 2015: after we moved to the new SDK which didn't support this, two more reports came in
		if (!isset($bucket_exists) && 's3' == $config['key']) {
			$s3 = $this->use_dns_bucket_name($s3, $bucket, true);
			$gb = @$s3->getBucket($bucket, $path, null, 1);
			if ($gb !== false) {
				$bucket_exists = true;
				$location = '';
				$bucket_verb = '';
			}
		}

		if (!isset($bucket_exists)) {
			$s3->setExceptions(true);
			try {
				$try_to_create_bucket = @$s3->putBucket($bucket, 'private');
			} catch (Exception $e) {
				$try_to_create_bucket = false;
				$s3_error = $e->getMessage();
			}
			$s3->setExceptions(false);
			if ($try_to_create_bucket) {
 				$bucket_verb = '';
				$bucket_exists = true;
			} else {
				echo sprintf(__("Failure: We could not successfully access or create such a bucket. Please check your access credentials, and if those are correct then try another bucket name (as another %s user may already have taken your name).",'updraftplus'),$whoweare);
				if (isset($s3_error)) echo "\n\n".sprintf(__('The error reported by %s was:','updraftplus'), $config['key']).' '.$s3_error;
			}
		}

		if (isset($bucket_exists)) {
			$try_file = md5(rand());
			if ($config['key'] != 'dreamobjects' && $config['key'] != 's3generic') $this->set_region($s3, $location, $bucket);
			$s3->setExceptions(true);
			try {
				if (!$s3->putObjectString($try_file, $bucket, $path.$try_file)) {
					echo __('Failure','updraftplus').": ${bucket_verb}".__('We successfully accessed the bucket, but the attempt to create a file in it failed.','updraftplus');
				} else {
					echo  __('Success', 'updraftplus').": ${bucket_verb}".__('We accessed the bucket, and were able to create files within it.','updraftplus').' ';
					$comm_with = ($config['key'] == 's3generic') ? $endpoint : $config['whoweare_long'];
					if ($s3->getuseSSL()) {
						echo sprintf(__('The communication with %s was encrypted.', 'updraftplus'), $comm_with);
					} else {
						echo sprintf(__('The communication with %s was not encrypted.', 'updraftplus'), $comm_with);
					}
					$create_success = true;
				}
			} catch (Exception $e) {
				echo __('Failure','updraftplus').": ${bucket_verb}".__('We successfully accessed the bucket, but the attempt to create a file in it failed.','updraftplus').' '.__('Please check your access credentials.','updraftplus').' ('.$e->getMessage().')';
			}

			if (!empty($create_success)) {
				try {
					@$s3->deleteObject($bucket, $path.$try_file);
				} catch (Exception $e) {
					echo ' '.__('Delete failed:', 'updraftplus').' '.$e->getMessage();
				}
			}

		}

	}

}
