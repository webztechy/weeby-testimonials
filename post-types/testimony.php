<?php

/**
 * Registers the `testimony` post type.
 */
function testimony_init() {
	register_post_type( WEEBY_POST_TYPE_TESTIMONY , array(
		'labels'                => array(
			'name'                  => __( 'Testimonies', 'Weeby Testimony' ),
			'singular_name'         => __( 'Testimony', 'Weeby Testimony' ),
			'all_items'             => __( 'All Testimonies', 'Weeby Testimony' ),
			'archives'              => __( 'Testimony Archives', 'Weeby Testimony' ),
			'attributes'            => __( 'Testimony Attributes', 'Weeby Testimony' ),
			'insert_into_item'      => __( 'Insert into Testimony', 'Weeby Testimony' ),
			'uploaded_to_this_item' => __( 'Uploaded to this Testimony', 'Weeby Testimony' ),
			'featured_image'        => _x( 'Person Image', 'testimony', 'Weeby Testimony' ),
			'set_featured_image'    => _x( 'Set person image', 'testimony', 'Weeby Testimony' ),
			'remove_featured_image' => _x( 'Remove person image', 'testimony', 'Weeby Testimony' ),
			'use_featured_image'    => _x( 'Use as person image', 'testimony', 'Weeby Testimony' ),
			'filter_items_list'     => __( 'Filter Testimonies list', 'Weeby Testimony' ),
			'items_list_navigation' => __( 'Testimonies list navigation', 'Weeby Testimony' ),
			'items_list'            => __( 'Testimonies list', 'Weeby Testimony' ),
			'new_item'              => __( 'New Testimony', 'Weeby Testimony' ),
			'add_new'               => __( 'Add New', 'Weeby Testimony' ),
			'add_new_item'          => __( 'Add New Testimony', 'Weeby Testimony' ),
			'edit_item'             => __( 'Edit Testimony', 'Weeby Testimony' ),
			'view_item'             => __( 'View Testimony', 'Weeby Testimony' ),
			'view_items'            => __( 'View Testimonies', 'Weeby Testimony' ),
			'search_items'          => __( 'Search Testimonies', 'Weeby Testimony' ),
			'not_found'             => __( 'No Testimonies found', 'Weeby Testimony' ),
			'not_found_in_trash'    => __( 'No Testimonies found in trash', 'Weeby Testimony' ),
			'parent_item_colon'     => __( 'Parent Testimony:', 'Weeby Testimony' ),
			'menu_name'             => __( 'Testimonies', 'Weeby Testimony' ),
		),
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'excerpt', 'thumbnail' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-format-chat',
		'show_in_rest'          => true,
		'rest_base'             => 'testimony',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
	) );

}
add_action( 'init', 'testimony_init' );

/**
 * Sets the post updated messages for the `testimony` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `testimony` post type.
 */
function testimony_updated_messages( $messages ) {
	global $post;

	$permalink = get_permalink( $post );

	$messages['testimony'] = array(
		0  => '', // Unused. Messages start at index 1.
		/* translators: %s: post permalink */
		1  => sprintf( __( 'Testimony updated. <a target="_blank" href="%s">View Testimony</a>', 'Weeby Testimony' ), esc_url( $permalink ) ),
		2  => __( 'Custom field updated.', 'Weeby Testimony' ),
		3  => __( 'Custom field deleted.', 'Weeby Testimony' ),
		4  => __( 'Testimony updated.', 'Weeby Testimony' ),
		/* translators: %s: date and time of the revision */
		5  => isset( $_GET['revision'] ) ? sprintf( __( 'Testimony restored to revision from %s', 'Weeby Testimony' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		/* translators: %s: post permalink */
		6  => sprintf( __( 'Testimony published. <a href="%s">View Testimony</a>', 'Weeby Testimony' ), esc_url( $permalink ) ),
		7  => __( 'Testimony saved.', 'Weeby Testimony' ),
		/* translators: %s: post permalink */
		8  => sprintf( __( 'Testimony submitted. <a target="_blank" href="%s">Preview Testimony</a>', 'Weeby Testimony' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
		/* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
		9  => sprintf( __( 'Testimony scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Testimony</a>', 'Weeby Testimony' ),
		date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( $permalink ) ),
		/* translators: %s: post permalink */
		10 => sprintf( __( 'Testimony draft updated. <a target="_blank" href="%s">Preview Testimony</a>', 'Weeby Testimony' ), esc_url( add_query_arg( 'preview', 'true', $permalink ) ) ),
	);

	return $messages;
}
add_filter( 'post_updated_messages', 'testimony_updated_messages' );
