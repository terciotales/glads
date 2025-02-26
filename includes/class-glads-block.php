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
class Glads_Block {

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

        // Register the block script
        wp_register_script(
            'glads-block',
            plugins_url('js/glads-block.js', __FILE__),
            array('wp-blocks', 'wp-element', 'wp-editor'),
            filemtime(plugin_dir_path(__FILE__) . 'js/glads-block.js')
        );

        // Register the block type
        register_block_type('glads/block', array(
            'editor_script' => 'glads-block',
            'render_callback' => array($this, 'render_block'),
        ));
    }

    /**
     * Render the block.
     *
     * @since    1.0.0
     * @param    array $attributes Block attributes.
     * @return   string            Block output.
     */
    public function render_block($attributes) {
        // Output for the block
        $output = '';

        return $output;
    }

}
