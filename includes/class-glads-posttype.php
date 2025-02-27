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
        add_action('add_meta_boxes', array($this, 'customize_post_type_editor'));
        add_action('save_post', array($this, 'save_custom_fields'));
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

    /**
     * Remove the default editor and add custom fields as the main editor
     */
    public function customize_post_type_editor() {
        // Remove the default content editor
        remove_post_type_support('glads', 'editor');

        // Add a new metabox to replace the content area
        add_meta_box(
            'glads_main_fields',
            __('Ad Details', 'glads'),
            array($this, 'render_main_fields'),
            'glads', // Post type to which the metabox belongs
            'normal', // Position (normal, side, or advanced)
            'high' // High priority to ensure it's displayed at the top
        );
    }

    /**
     * Render the main custom fields in the post type editor.
     *
     * @param WP_Post $post The post currently being edited.
     */
    public function render_main_fields($post) {
        // Secure the form with a nonce
        wp_nonce_field('save_glads_custom_fields', 'glads_custom_fields_nonce');

        // Retrieve field values if they already exist
        $image_url = get_post_meta($post->ID, '_glads_image', true); // Custom image field
        $description = get_post_meta($post->ID, '_glads_description', true); // Custom description field

        // Image field
        echo '<label for="glads_image">';
        echo __('Upload Image:', 'glads');
        echo '</label><br>';
        echo '<input type="text" id="glads_image" name="glads_image" value="' . esc_attr($image_url) . '" style="width:100%;" />';
        echo '<button type="button" id="glads_image_button" class="button">' . __('Select Image', 'glads') . '</button>';
        echo '<p class="description">' . __('Enter or select a URL for the custom image.', 'glads') . '</p>';

        // Description field
        echo '<br><br><label for="glads_description">';
        echo __('Description:', 'glads');
        echo '</label><br>';
        echo '<textarea id="glads_description" name="glads_description" rows="4" style="width:100%;">' .
             esc_textarea($description) .
             '</textarea>';
        echo '<p class="description">' . __('Provide a short description.', 'glads') . '</p>';

        // Media uploader script
        ?>
        <script>
			jQuery(document).ready(function($){
				let mediaUploader;

				$('#glads_image_button').click(function(e){
					e.preventDefault();
					if (mediaUploader) {
						mediaUploader.open();
						return;
					}

					mediaUploader = wp.media.frames.file_frame = wp.media({
						title: '<?php _e("Select Image", "glads"); ?>',
						button: {
							text: '<?php _e("Use this image", "glads"); ?>'
						},
						multiple: false
					});

					mediaUploader.on('select', function() {
						var attachment = mediaUploader.state().get('selection').first().toJSON();
						$('#glads_image').val(attachment.url);
					});

					mediaUploader.open();
				});
			});
        </script>
        <?php
    }

    /**
     * Save the custom fields when the post is saved.
     *
     * @param int $post_id The ID of the current post being saved.
     */
    public function save_custom_fields($post_id) {
        // Verify the nonce for security
        if (!isset($_POST['glads_custom_fields_nonce']) ||
            !wp_verify_nonce($_POST['glads_custom_fields_nonce'], 'save_glads_custom_fields')) {
            return $post_id;
        }

        // Ignore autosave requests
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }

        // Save the image URL field
        if (isset($_POST['glads_image'])) {
            update_post_meta($post_id, '_glads_image', sanitize_text_field($_POST['glads_image']));
        }

        // Save the description field
        if (isset($_POST['glads_description'])) {
            update_post_meta($post_id, '_glads_description', sanitize_textarea_field($_POST['glads_description']));
        }

        return $post_id;
    }

}
