<?php

/**
 * Registers the `testimony_category` taxonomy,
 * for use with 'testimony'.
 */
function testimony_category_init() {
        register_taxonomy( WEEBY_TESTIMONY_TAXONOMY_NAME, array( WEEBY_POST_TYPE_TESTIMONY ), array(
                'hierarchical'      => true,
                'public'            => true,
                'show_in_nav_menus' => true,
                'show_ui'           => true,
                'show_admin_column' => false,
                'query_var'         => true,
                'rewrite'           => true,
                'capabilities'      => array(
                        'manage_terms'  => 'edit_posts',
                        'edit_terms'    => 'edit_posts',
                        'delete_terms'  => 'edit_posts',
                        'assign_terms'  => 'edit_posts',
                ),
                'labels'            => array(
                        'name'                       => __( 'Categories', 'Weeby Testimony' ),
                        'singular_name'              => _x( 'Category', 'taxonomy general name', 'Weeby Testimony' ),
                        'search_items'               => __( 'Search Categories', 'Weeby Testimony' ),
                        'popular_items'              => __( 'Popular Categories', 'Weeby Testimony' ),
                        'all_items'                  => __( 'All Categories', 'Weeby Testimony' ),
                        'parent_item'                => __( 'Parent Category', 'Weeby Testimony' ),
                        'parent_item_colon'          => __( 'Parent Category:', 'Weeby Testimony' ),
                        'edit_item'                  => __( 'Edit Category', 'Weeby Testimony' ),
                        'update_item'                => __( 'Update Category', 'Weeby Testimony' ),
                        'view_item'                  => __( 'View Category', 'Weeby Testimony' ),
                        'add_new_item'               => __( 'New Category', 'Weeby Testimony' ),
                        'new_item_name'              => __( 'New Category', 'Weeby Testimony' ),
                        'separate_items_with_commas' => __( 'Separate categories with commas', 'Weeby Testimony' ),
                        'add_or_remove_items'        => __( 'Add or remove categories', 'Weeby Testimony' ),
                        'choose_from_most_used'      => __( 'Choose from the most used categories', 'Weeby Testimony' ),
                        'not_found'                  => __( 'No categories found.', 'Weeby Testimony' ),
                        'no_terms'                   => __( 'No categories', 'Weeby Testimony' ),
                        'menu_name'                  => __( 'Categories', 'Weeby Testimony' ),
                        'items_list_navigation'      => __( 'Categories list navigation', 'Weeby Testimony' ),
                        'items_list'                 => __( 'Categories list', 'Weeby Testimony' ),
                        'most_used'                  => _x( 'Most Used', WEEBY_TESTIMONY_TAXONOMY_NAME, 'Weeby Testimony' ),
                        'back_to_items'              => __( '&larr; Back to Categories', 'Weeby Testimony' ),
                ),
                'show_in_rest'      => true,
                'rest_base'         => WEEBY_TESTIMONY_TAXONOMY_NAME,
                'rest_controller_class' => 'WP_REST_Terms_Controller',
        ) );

}
add_action( 'init', 'testimony_category_init', 0 );

/**
 * Sets the post updated messages for the `testimony_category` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `testimony_category` taxonomy.
 */
function testimony_category_updated_messages( $messages ) {

        $messages[WEEBY_TESTIMONY_TAXONOMY_NAME] = array(
                0 => '', // Unused. Messages start at index 1.
                1 => __( 'Category added.', 'Weeby Testimony' ),
                2 => __( 'Category deleted.', 'Weeby Testimony' ),
                3 => __( 'Category updated.', 'Weeby Testimony' ),
                4 => __( 'Category not added.', 'Weeby Testimony' ),
                5 => __( 'Category not updated.', 'Weeby Testimony' ),
                6 => __( 'Categories deleted.', 'Weeby Testimony' ),
        );

        return $messages;
}
add_filter( 'term_updated_messages', 'testimony_category_updated_messages' );

