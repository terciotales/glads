<?php

/**
 * Define the post type functionality
 *
 * @link       https://github.com/terciotales/glads
 * @since      1.0.0
 *
 * @package    Glads
 * @subpackage Glads/includes
 */

/**
 * Define the post type functionality.
 *
 * @package    Glads
 * @subpackage Glads/includes
 * @author     Tércio Tales <terciotalesb@gmail.com>
 */
class Glads_PostType {

    /**
     * Register the post type with WordPress.
     *
     * @since    1.0.0
     */
    public function __construct() {
        add_action('init', array($this, 'register_post_type'));
    }

    /**
     * Register the custom post type.
     *
     * @since    1.0.0
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x('Ads', 'Post Type General Name', 'glads'),
            'singular_name'         => _x('Ad', 'Post Type Singular Name', 'glads'),
            'menu_name'             => __('Ads', 'glads'),
            'name_admin_bar'        => __('Ad', 'glads'),
            'archives'              => __('Ad Archives', 'glads'),
            'attributes'            => __('Ad Attributes', 'glads'),
            'parent_item_colon'     => __('Parent Ad:', 'glads'),
            'all_items'             => __('All Ads', 'glads'),
            'add_new_item'          => __('Add New Ad', 'glads'),
            'add_new'               => __('Add New', 'glads'),
            'new_item'              => __('New Ad', 'glads'),
            'edit_item'             => __('Edit Ad', 'glads'),
            'update_item'           => __('Update Ad', 'glads'),
            'view_item'             => __('View Ad', 'glads'),
            'view_items'            => __('View Ads', 'glads'),
            'search_items'          => __('Search Ad', 'glads'),
            'not_found'             => __('Not found', 'glads'),
            'not_found_in_trash'    => __('Not found in Trash', 'glads'),
            'featured_image'        => __('Featured Image', 'glads'),
            'set_featured_image'    => __('Set featured image', 'glads'),
            'remove_featured_image' => __('Remove featured image', 'glads'),
            'use_featured_image'    => __('Use as featured image', 'glads'),
            'insert_into_item'      => __('Insert into ad', 'glads'),
            'uploaded_to_this_item' => __('Uploaded to this ad', 'glads'),
            'items_list'            => __('Ads list', 'glads'),
            'items_list_navigation' => __('Ads list navigation', 'glads'),
            'filter_items_list'     => __('Filter ads list', 'glads'),
        );

        $args = array(
            'label'                 => __('Ad', 'glads'),
            'description'           => __('Post Type for Ads', 'glads'),
            'labels'                => $labels,
            'supports'              => array('title', 'custom-fields', 'revisions'),
            'taxonomies'            => array('category', 'tag', 'ad_area'),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
        );

        register_post_type('glads', $args);
    }

}
