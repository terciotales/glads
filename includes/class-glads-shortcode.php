<?php

/**
 * Define the shortcode functionality
 *
 * @link       https://github.com/terciotales/glads
 * @since      1.0.0
 *
 * @package    Glads
 * @subpackage Glads/includes
 */

/**
 * Define the shortcode functionality.
 *
 * @package    Glads
 * @subpackage Glads/includes
 * @author     Tércio Tales <terciotalesb@gmail.com>
 */
class Glads_Shortcode {

    /**
     * Register the shortcode with WordPress.
     *
     * @since    1.0.0
     */
    public function __construct() {
        add_shortcode('glads', array($this, 'render_shortcode'));
    }

    /**
     * Render the shortcode.
     *
     * @since    1.0.0
     * @param    array $atts Shortcode attributes.
     * @return   string      Shortcode output.
     */
    public function render_shortcode($atts) {
        // Extract shortcode attributes
        $atts = shortcode_atts(
            array(
                'id' => '',
            ),
            $atts,
            'glads'
        );

        // Output for the shortcode
        $output = '<div class="glads-ad" data-id="' . esc_attr($atts['id']) . '">';
        $output .= 'Ad content goes here...';
        $output .= '</div>';

        return $output;
    }

}
