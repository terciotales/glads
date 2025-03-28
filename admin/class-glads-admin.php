<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/terciotales/glads
 * @since      1.0.0
 *
 * @package    Glads
 * @subpackage Glads/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Glads
 * @subpackage Glads/admin
 * @author     Tércio Tales <terciotalesb@gmail.com>
 */
class Glads_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $glads    The ID of this plugin.
     */
    private $glads;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $glads       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $glads, $version ) {

        $this->glads = $glads;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Glads_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Glads_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->glads, GLADS_PLUGIN_DIR_URL . 'dist/admin.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Glads_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Glads_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->glads, GLADS_PLUGIN_DIR_URL . 'dist/admin.js', array( 'jquery' ), $this->version, false );

    }

}
