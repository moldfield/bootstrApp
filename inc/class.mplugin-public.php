<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the mplugin, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      0.0.1
 *
 * @package    mplugin
 * @subpackage mplugin/public
 * @author     Your Name <email@example.com>
 */
class Mplugin_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $mplugin    The ID of this plugin.
	 */
	private $mplugin;

	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;
	/**
	 * The version of this plugin.
	 *
	 * @since    0.0.1
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $user_id;
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    0.0.1
	 * @param      string    $mplugin       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $mplugin, $version ) {

		$this->mplugin = $mplugin;
		$this->version = $version;
		$this->user_id = get_current_user_id();
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in mplugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The mplugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( 'public', MPLUGIN__PLUGIN_URL . 'inc/css/public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    0.0.1
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in mplugin_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The mplugin_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		// Require JS 
		wp_enqueue_script('requirejs',  MPLUGIN__PLUGIN_URL . 'inc/js/libs/require/require.js',  array(), $this->version);

		$app_base = MPLUGIN__PLUGIN_URL . 'inc/js';

		$this->write_log( 'The app base ' .  $app_base);

		$ajaxurl = get_site_url() . '/wp-admin/admin-ajax.php';

		$this->write_log( 'The site ajax url ' .  $ajaxurl);
		wp_localize_script( 'requirejs', 'require', array(
		 	'baseUrl' => $app_base,
	    'deps'    => array( $app_base . '/main.js'),
	    //'ajaxurl' => 'http://analytics.mckayadvertising.com/wp-admin/admin-ajax.php'
		));

		// Setting some vars
		wp_localize_script( 'requirejs', 'vars', array(
		    'baseUrl' => $app_base
		));
		
		/*wp_register_script( 'mplugin-wp-api', MPLUGIN__PLUGIN_URL . 'inc/js/wp-api.js', array('jquery1','charts','spin'), $this->version );
		wp_enqueue_script( 'mplugin-wp-api');
		wp_localize_script( 'mplugin-wp-api', 'WP_API_Settings', array( 'root' => esc_url_raw( rest_url() ), 'nonce' => wp_create_nonce( 'wp_rest' ) ) );*/
	}

	public function write_log( $log ) {
		if ( is_array( $log ) || is_object( $log ) ) {
       error_log( print_r( $log, true ) );
    } else {
       error_log( $log );
    }

	}
	
} // Mplugin Public Class


