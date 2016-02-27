<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      0.0.1
 * @package    mplugin
 * @subpackage mplugin/includes
 */

global $mplugin_db_version;
$mplugin_db_version = '0.0.2';

class Mplugin_Activator {

	
	private $mplugin_db_version = '0.0.1';

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    0.0.1
	 */
	public function activate() {



		//$this->create_update_database();
		//$this->create_user_role();
		$this->create_user_roles();
		echo "Mplugin Activated";
		
		
	}
	public function create_user_roles () {
		$result = add_role(
	    'client',
	    __( 'Client' ),
	    array(
	        'read'         => true,  // true allows this capability
	    )
		);
		if ( null !== $result ) {
		    echo 'Yay! New role created!';
		}
		else {
		    echo 'Oh... the client role already exists.';
		}
	}
	
	/**
	 * Create the database
	 *
	 */
	private function create_update_database () {

		global $wpdb;
		global $mplugin_db_version;
		

		$installed_db_version = get_option( 'mplugin_db_version' );

		

		/**
		 * Use this one do the initial creation
		 *
		 */
		if ( !$installed_db_version ) {

			$table_name = $wpdb->prefix . 'workouts';

			$charset_collate = $wpdb->get_charset_collate();


			$sql = "CREATE TABLE $table_name (
							user_id mediumint(9) DEFAULT 0 NOT NULL,
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							entry_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
							workout_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
							workout_category int DEFAULT 0 NOT NULL,
							num_reps int,
							exercise_time TIME,
							UNIQUE KEY id (id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			dbDelta( $sql );

			// Create the database version option that can e checked in the future

	    add_option( 'mplugin_db_version', $mplugin_db_version );
	    
	    Mplugin_Utilities::write_log('The database was created successfully.');

		} else if ( $installed_db_version != $mplugin_db_version ) {

			$table_name = $wpdb->prefix . 'workouts';

			$sql = "CREATE TABLE $table_name (
							user_id mediumint(9) DEFAULT 0 NOT NULL,
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							entry_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
							workout_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
							workout_category int DEFAULT 0 NOT NULL,
							num_reps int,
							exercise_time TIME,
							UNIQUE KEY id (id)
			);";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			dbDelta( $sql );

			// Update the database version if necessary

	    update_option( 'mplugin_db_version', $mplugin_db_version );

	    Mplugin_Utilities::write_log('The database was updated successfully.');

		} else {

			Mplugin_Utilities::write_log('The update database function ran but nothing happened..');
		}
	}

	/**
	 * Add a role for regular mplugin users
	 *
	 * Need to look into whether 'manage_options' gives the user
	 * too much power. It is included because it is needed to 
	 * let the user edit pages under admin.php which includes
	 * the custom dashboard that they will use.
	 *
	 */
	private function create_user_role () {

		$user_capabilities  = array(

															'read' => true,
															'manage_options' => true,
															'upload_files' => true

		);
		add_role( 'mplugin_user', 'mplugin User', $user_capabilities );
	}

} // Mplugin_Activator 