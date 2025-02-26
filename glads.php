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

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}


/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GLADS_VERSION', '1.0.0' );

/**
 * Get the absolute path to the plugin directory.
 */
define( 'GLADS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Get the URL to the plugin directory.
 */
define( 'GLADS_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-glads-activator.php
 */
function activate_glads() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-glads-activator.php';
    Glads_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-glads-deactivator.php
 */
function deactivate_glads() {
    require_once plugin_dir_path( __FILE__ ) . 'includes/class-glads-deactivator.php';
    Glads_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_glads' );
register_deactivation_hook( __FILE__, 'deactivate_glads' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-glads.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_glads() {
    $plugin = new Glads();
    $plugin->run();
}

run_glads();
