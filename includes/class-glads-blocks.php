<?php

/**
 * Define the block functionality
 *
 * @link       https://github.com/terciotales/glads
 * @since      1.0.0
 *
 * @package    Glads
 * @subpackage Glads/includes
 */

/**
 * Define the block functionality.
 *
 * @package    Glads
 * @subpackage Glads/includes
 * @author     Tércio Tales <terciotalesb@gmail.com>
 */
class Glads_Blocks {

    /**
     * Register the block with WordPress.
     *
     * @since    1.0.0
     */
    public function __construct() {
        add_action('init', array($this, 'register_block'));
    }

    /**
     * Register the custom block.
     *
     * @since    1.0.0
     */
    public function register_block() {
        // Check if function exists
        if (!function_exists('register_block_type')) {
            return;
        }

    }
}
