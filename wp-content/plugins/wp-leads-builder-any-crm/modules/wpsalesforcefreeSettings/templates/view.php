<?php

/*********************************************************************************
 * WP Leads Builder For CRM is a tool to capture leads from WordPress to CRM.
 * plugin developed by Smackcoder. Copyright (C) 2016 Smackcoders.
 *
 * WP Leads Builder For CRM is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License version 3
 * as published by the Free Software Foundation with the addition of the
 * following permission added to Section 15 as permitted in Section 7(a): FOR
 * ANY PART OF THE COVERED WORK IN WHICH THE COPYRIGHT IS OWNED BY WP Leads 
 * Builder For CRM, WP Leads Builder For CRM DISCLAIMS THE WARRANTY OF NON
 * INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * WP Leads Builder For CRM is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public
 * License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program; if not, see http://www.gnu.org/licenses or write
 * to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA 02110-1301 USA.
 *
 * You can contact Smackcoders at email address info@smackcoders.com.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * WP Leads Builder For CRM copyright notice. If the display of the logo is
 * not reasonably feasible for technical reasons, the Appropriate Legal
 * Notices must display the words
 * "Copyright Smackcoders. 2016. All rights reserved".
 ********************************************************************************/

$config = get_option("wp_{$skinnyData['activatedplugin']}_settings");
if(isset( $_REQUEST['code'] ) && ($_REQUEST['code'] != '') )
{
	include_once(WP_CONST_ULTIMATE_CRM_CPT_DIRECTORY."/lib/SmackSalesForceApi.php");
	$response = Getaccess_token( $config , $_GET['code']);
	$access_token = $response['access_token'];
	$instance_url = $response['instance_url'];
	if (!isset($access_token) || $access_token == "") {
		die("Error - access token missing from response!");
	}
	if (!isset($instance_url) || $instance_url == "") {
		die("Error - instance URL missing from response!");
	}
	$_SESSION['access_token'] = $access_token;
	$_SESSION['instance_url'] = $instance_url;
	$config['access_token'] = $access_token;
	$config['instance_url'] = $instance_url;
	$config['id_token'] = $response['id_token'];
	$config['signature'] = $response['signature'];

}
$siteurl = site_url();
update_option("wp_{$skinnyData['activatedplugin']}_settings" , $config );
?>
<form id="smack-salesforce-settings-form" action="<?php echo esc_url_raw( $_SERVER['REQUEST_URI'] ); ?>" method="post">
	<h2 style="margin-left:15px;">Salesforce CRM Settings</h2> <br>
	<img src="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_DIR); ?>images/loading-indicator.gif" id="loading-image" style="display: none; position:relative; left:500px;padding-top: 5px; padding-left: 15px;">
	<input type="hidden" name="smack-salesforce-settings-form" value="smack-salesforce-settings-form" />
	<input type="hidden" id="plug_URL" value="<?php echo esc_url(WP_CONST_ULTIMATE_CRM_CPT_PLUG_URL);?>" />
	<div class="wp-common-crm-content" style="width: 100%;float: left;">
		<table>
			<tr>
				<td><label id="innertext" style="font-weight:bold;">Choose Your CRM</label></td>
				<td>
					<?php
					$ContactFormPluginsObj = new ContactFormPlugins();
					echo $ContactFormPluginsObj->getPluginActivationHtml();
					?>
				</td>
			</tr>
			<tr><td> <br /></tr></td>
		</table>
		<label id="inneroptions" style="font-weight:bold;">Provide your CRM configuration details,</label>
		<table  class="settings-table">
			<tr>
				<td style='width:160px;'>
					<label id="innertext"> Consumer Key  </label><div style='float:right;'> : </div>
				</td>
				<td>
					<input type='text' class='smack-salesforce-free-settings-text' name='key' id='smack_host_address' value="<?php echo sanitize_text_field( $config['key'] ) ?>"/>
				</td>
				<td style='width:160px;'>
					<label id="innertext"> Consumer Secret </label><div style='float:right;'> : </div>
				</td>
				<td>
					<input type='password' class='smack-salesforce-free-settings-text' name='secret' id='smack_host_username' value="<?php echo sanitize_text_field( $config['secret'] ) ?>"/>
				</td>
			</tr>
			<tr>
				<td style='width:160px;'>
					<label id="innertext"> Callback URL </label><div style='float:right;'> : </div>
				</td>
				<td colspan="3">
					<input type='text' class='smack-salesforce-free-settings-text urlfield' name='callback' id='smack_host_access_key' value="<?php echo esc_url_raw($config['callback'] , $protocols=null) ?>"/>
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
			</tr>
			<tr>
				<td style='width:160px;' colspan="3">
					<label id="innertext"><div style='float:left;'> Do you want to capture all WP Users as SalesForce Contacts ? </div></label>
				</td>
				<td>
					<input type='checkbox' class='smack-salesforce-settings-text cmn-toggle cmn-toggle-yes-no' name='user_capture' id='user_capture' value="on" <?php if(isset($config['user_capture']) && sanitize_text_field( $config['user_capture'] ) == 'on') { echo "checked=checked"; } ?>/>
					<label for="user_capture" id="innertext" data-on="Yes" data-off="No"></label>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<h5 id="inneroptions" style="font-weight:bold;">Form Type</h5>
				</td>
			</tr>
			<tr>
				<td style='width:160px;' colspan="3">
					<label id="innertext"><div style='float:left;'> Do you want to enable the Contact Form 7 ? </div></label>
				</td>
				<td>
					<input type='checkbox' class='smack-salesforce-settings-text cmn-toggle cmn-toggle-yes-no' name='contact_form' id='contact_form' value="on" <?php if(isset($config['contact_form']) && sanitize_text_field( $config['contact_form'] ) == 'on') { echo "checked=checked"; } ?>/>
					<label for="contact_form" id="innertext" data-on="Yes" data-off="No"></label>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<h5 id="inneroptions" style="font-weight:bold;">Email Notification</h5>
				</td>
			</tr>
			<tr>
				<td style='width:160px;' colspan="3">
					<label id="innertext"><div style='float:left;'> Do you want the log for all your captured data ? </div></label>
				</td>
				<td>
					<input type='checkbox' class='smack-salesforce-settings-text cmn-toggle cmn-toggle-yes-no' name='smack_email' id='smack_email' value="on" onclick="smack_email_check(this.id);"<?php if(isset($config['smack_email']) && sanitize_text_field( $config['smack_email'] ) == 'on') { echo "checked=checked"; } ?>/>
					<label for="smack_email" id="innertext" data-on="Yes" data-off="No"></label>
				</td>
			</tr>
			<tr>
				<td style='width:160px;' colspan="4">
					<label id="innertext"><div style='float:left;'> If yes, Provide the e-mail id here, </div></label>
					<input type='text' class='smack-salesforce-free-settings-text' name='email' id='email' value="<?php echo $config_email = sanitize_email($config['email']) ?>"/>
				</td>
			</tr>
			<tr>
				<td colspan="4">
					<h5 id="inneroptions" style="font-weight:bold;">Debug Mode</h5>
				</td>
			</tr>
			<tr>
				<td style='width:160px;' colspan="3">
					<label id="innertext"><div style='float:left;'> Do you want to enable the WP Debug mode ? </div></label>
				</td>
				<td>
					<input type='checkbox' class='smack-vtiger-settings-text cmn-toggle cmn-toggle-yes-no' name='debug_mode' id='debug_mode' value="on" <?php if(isset($config['debug_mode']) && sanitize_text_field( $config['debug_mode'] ) == 'on') { echo "checked=checked"; } ?>/>
					<label for="debug_mode" id="innertext" data-on="Yes" data-off="No"></label>
				</td>
			</tr>
		</table>
		<br/>
		<input type="hidden" name="posted" value="<?php echo 'posted';?>">
		<p class="submit">
			<input type="submit" value="<?php _e('Save CRM Configuration');?>" class="button-primary" onclick="document.getElementById('loading-image').style.display = 'block'" style="float: right;"/>
			<?php
			$auth_url =  "https://login.salesforce.com/services/oauth2/authorize?response_type=code&client_id=" . $config['key'] . "&redirect_uri=" . urlencode($config['callback']);
			?>
			<a href="<?php echo "$auth_url"?>" ><input name="submit" type="button" value="Authenticate" class="button-primary" /> </a>
		</p>
	</div>
</form>
