<?php

/**
 * Define the taxonomy functionality
 *
 * @link       https://github.com/terciotales/glads
 * @since      1.0.0
 *
 * @package    Glads
 * @subpackage Glads/includes
 */

/**
 * Define the taxonomy functionality.
 *
 * @package    Glads
 * @subpackage Glads/includes
 * @author     Tércio Tales <terciotalesb@gmail.com>
 */
class Glads_Taxonomy {

    /**
     * Register the taxonomy with WordPress.
     *
     * @since    1.0.0
     */
    public function __construct() {
        add_action('init', array($this, 'register_taxonomy'));
    }

    /**
     * Register the custom taxonomy.
     *
     * @since    1.0.0
     */
    public function register_taxonomy() {
        $labels = array(
            'name'              => _x('Ad Areas', 'taxonomy general name', 'glads'),
            'singular_name'     => _x('Ad Area', 'taxonomy singular name', 'glads'),
            'search_items'      => __('Search Ad Areas', 'glads'),
            'all_items'         => __('All Ad Areas', 'glads'),
            'parent_item'       => __('Parent Ad Area', 'glads'),
            'parent_item_colon' => __('Parent Ad Area:', 'glads'),
            'edit_item'         => __('Edit Ad Area', 'glads'),
            'update_item'       => __('Update Ad Area', 'glads'),
            'add_new_item'      => __('Add New Ad Area', 'glads'),
            'new_item_name'     => __('New Ad Area Name', 'glads'),
            'menu_name'         => __('Ad Areas', 'glads'),
        );

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'ad-area'),
        );

        register_taxonomy('ad_area', array('post'), $args);
    }

}
