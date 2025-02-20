<?php
/**
 * Plugin Name: Glads - WordPress Ad Manager
 * Version: 1.0.0
 * Plugin URI: https://github.com/terciotales/glads
 * Description: A simple ad manager for WordPress.
 * Author: Tércio Tales
 * Author URI: https://github.com/terciotales
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: glads
 * Domain Path: /lang/
 *
 * @package WordPress
 * @author Tércio Tales
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Returns the main instance of Glads to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object WordPress_Plugin_Template
 */
function glads(): object {


    return (object)[];
}

glads();
