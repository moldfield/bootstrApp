<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the mplugin, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      0.0.1
 *
 * @package    mplugin
 * @subpackage mplugin/admin
 */
class Mplugin_Admin {

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
     * @param      string    $mplugin       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $mplugin, $version ) {

        $this->mplugin = $mplugin;
        $this->version = $version;
        $this->user_id = get_current_user_id();
    }

    /**
     * Register the stylesheets for the admin area.
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

        wp_enqueue_style( 'admin', MPLUGIN__PLUGIN_URL . 'inc/css/admin.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
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

       // wp_enqueue_script( $this->mplugin.'-admin', MPLUGIN__PLUGIN_URL . 'js/mplugin-admin.js', array( 'jquery'), $this->version, false );

    }


} // Mplugin_Admin class