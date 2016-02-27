<?php
/*
Plugin Name: Mplugin
Plugin URI: http://analytics.mckayadvertising.com
Description: A basic plugin bootstraped with underscore, requirejs, backbone
Version: 0.2.0
Author: Matt Oldfield
Author URI: http://www.matthewoldfield.com
*/
// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'MPLUGIN_NAMESPACE', 'mplugin' );
define( 'MPLUGIN_VERSION', '0.6.0' );
define( 'MPLUGIN__MINIMUM_WP_VERSION', '3.2' );
define( 'MPLUGIN__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'MPLUGIN__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mplugin-activator.php
 */
function activate_mplugin() {
	require_once MPLUGIN__PLUGIN_DIR . 'inc/class.mplugin-activator.php';
	$activate = new Mplugin_Activator();
	$activate->activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mplugin-deactivator.php
 */
function deactivate_mplugin() {
	require_once MPLUGIN__PLUGIN_DIR . 'inc/class.mplugin-deactivator.php';
	Mplugin_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mplugin' );
register_deactivation_hook( __FILE__, 'deactivate_mplugin' );

require_once( MPLUGIN__PLUGIN_DIR . 'inc/class.mplugin.php' );

if ( is_admin() ) {
	//require_once( MPLUGIN__PLUGIN_DIR . 'inc/class.mplugin-admin.php' );
} else {
	require_once( MPLUGIN__PLUGIN_DIR . 'inc/class.mplugin-public.php' );
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    0.0.1
 */
function run_mplugin() {

	$plugin = new Mplugin();
	$plugin->run();

}
/**
 * Kick it all off
 *
 */
run_mplugin();
