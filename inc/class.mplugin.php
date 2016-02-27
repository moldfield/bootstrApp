<?php 
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://example.com
 * @since      0.0.1
 *
 * @package    mplugin
 * @subpackage mplugin/inc
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      0.0.1
 * @package    mplugin
 * @subpackage mplugin/inc
 * @author     Your Name <email@example.com>
 */
class Mplugin {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      mplugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;
	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      string    $mplugin    The string used to uniquely identify this plugin.
	 */
	protected $mplugin;

	/**
	 * The current version of the plugin.
	 *
	 * @since    0.0.1
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the mplugin and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function __construct() {

		$this->mplugin = MPLUGIN_NAMESPACE;
		$this->version = MPLUGIN_VERSION;

		$this->load_dependencies();

		$this->define_public_hooks();

	}

	/**
	 * Loads required php files
	 *
	 */
	public function load_dependencies() {
		require_once( MPLUGIN__PLUGIN_DIR . 'inc/lib/googleads-php-lib/examples/AdWords/v201509/init.php');
		require_once( MPLUGIN__PLUGIN_DIR . 'inc/lib/googleads-php-lib/examples/AdWords/v201509/AccountManagement/GetAccountHierarchy.php');
		//require_once( MPLUGIN__PLUGIN_DIR . 'inc/lib/googleads-php-lib/examples/AdWords/v201509/Reporting/GetReportFields.php');
		require_once( ADWORDS_UTIL_VERSION_PATH . '/ReportUtils.php');
		require_once( MPLUGIN__PLUGIN_DIR . 'inc/auth/class.mplugin-auth.php' );
		require_once( MPLUGIN__PLUGIN_DIR . 'inc/lib/moz-api/bootstrap.php' );
		require_once( MPLUGIN__PLUGIN_DIR . 'inc/class.mplugin-loader.php' );
		require_once( MPLUGIN__PLUGIN_DIR . 'inc/class.mplugin-public.php' );

		$this->loader = new Mplugin_Loader();
	}

	/**
	 * Loads required actions for the public facing side
	 * of the site.
	 *
	 */
	public function define_public_hooks() {

		$plugin_public = new Mplugin_Public( $this->get_mplugin(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		/*$this->loader->add_action( 'wp_print_scripts', $plugin_public, 'set_up_data_layer' );
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'remove_admin_bar' );
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'get_adwords_data' );*/

		/*$ajax_fns = array('','');
		foreach ($ajax_fns as $fn) {
			$this->loader->add_action( 'wp_ajax_'.$fn, $plugin_public, $fn );
			$this->loader->add_action( 'wp_ajax_nopriv_'.$fn, $plugin_public, $fn );
		}*/

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    0.0.1
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     0.0.1
	 * @return    string    The name of the plugin.
	 */
	public function get_mplugin() {
		return $this->mplugin;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     0.0.1
	 * @return    zenfit_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     0.0.1
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

} // Mplugin