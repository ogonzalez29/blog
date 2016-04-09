<?php

/* Public methods in this class will be run at least once during plugin activation script. */
/* Updater methods fired are stored in transient to prevent repeat processing */

if ( !class_exists('Leads_Activation_Update_Routines') ) {

	class Leads_Activation_Update_Routines {

		/**
		* @introduced: 1.5.1
		* @migration-type: db modification
		* @mirgration: creates wp_inbound_link_tracking table
		*/
		public static function create_link_tracking_table() {
			global $wpdb;


			$table_name = $wpdb->prefix . "inbound_tracked_links";

			$charset_collate = '';

			if ( ! empty( $wpdb->charset ) ) {
			  $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
			}

			if ( ! empty( $wpdb->collate ) ) {
			  $charset_collate .= " COLLATE {$wpdb->collate}";
			}

			$sql = "CREATE TABLE $table_name (
			  `id` mediumint(9) NOT NULL AUTO_INCREMENT,
			  `token` tinytext NOT NULL,
			  `args` text NOT NULL,
			  UNIQUE KEY id (id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

		}

		/**
		* @introduced: 1.1.0
		* @migration-type: meta key update
		* @mirgration: standardizes meta key from old naming conversion to new naming convention
		* @keychange: wpl-lead-conversion-count to wpleads_conversion_count
		* @keychange: wpl-lead-page-view-count to wpleads_page_view_count
		* @keychange: wpl-lead-raw-post-data to wpleads_raw_post_data
		*/
		public static function migrate_meta_keys() {
			global $wpdb;

			$wpdb->query("update {$wpdb->prefix}postmeta set meta_key = 'wpleads_conversion_count' where meta_key = 'wpl-lead-conversion-count'");

			$wpdb->query("update {$wpdb->prefix}postmeta set meta_key = 'wpleads_page_view_count' where meta_key = 'wpl-lead-page-view-count'");

			$wpdb->query("update {$wpdb->prefix}postmeta set meta_key = 'wpleads_raw_post_data' where meta_key = 'wpl-lead-raw-post-data'");

		}

		/**
		 * @introduced: 2.0.1
		 * @migration-type: batch lead processing / data migration into inbound_events table
		 * @details: Moving form submissions, cta clicks, custom events into events table.
		 * @details: 112015 represents date added in
		 */
		public static function batch_import_event_data_112015() {

			/* lets make sure the inbound_events table is created */
			if ( !class_exists('Inbound_Events')) {
				Inbound_Load_Shared::load_constants();
				include_once( INBOUNDNOW_SHARED_PATH . 'classes/class.events.php');
			}
			Inbound_Events::create_events_table();

			/* create flag for batch uploader */
			add_option(
				'leads_batch_processing', 		/* db option name - lets batch processor know it's needed */
				array(
					'method' => 'import_events_table_112015', 	/* tells batch processor which method to run */
					'posts_per_page' => 100, 					/* leads per query */
					'offset' => 0 								/* initial page offset */
				),
				0 , 							/* depreciated leave as 0 */
				true 							/* autoload true */
			);

		}


	}

}

