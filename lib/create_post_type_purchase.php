<?php

/***********************************
 * 1b. The Custom Post Type 'snack_purchase' for the SnackIT app
 *
 * It stores all purchases of all users in one post type
 *
 ***********************************/


//  Exit if accessed directly.
defined('ABSPATH') || exit;


add_action( 'init', 'create_post_type_purchase' );



function create_post_type_purchase() {

	$labels = array(
		'name'               => _x( 'Snack Purchases', 'post type general name', 'snackit' ),
		'singular_name'      => _x( 'Purchase', 'post type singular name', 'snackit' ),
		'menu_name'          => _x( 'Snack Purchases', 'admin menu', 'snackit' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'All snack purchases are stored here', 'snackit' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'snack_purchase' ),
		'has_archive'        => true,

		// no creation through wordpress admin - only through the react app
		'capability_type'    => 'post',
//		'capabilities' => array(
////			'create_posts' => 'administrator',
//			'create_posts' => false,
//		),
//		'map_meta_cap' => true, // Set to `false`, if users are not allowed to edit/delete existing posts

		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'          => 'dashicons-cart',
		'show_in_rest'       => true,
//		'template' => array(
//			array( 'snackit/snack-meta' ),
//		),
//		'template_lock'      => 'all',
		'taxonomies'         => array( 'snack_groups' ),
		'supports'           => array( 'title', 'author', 'custom-fields')
	);

	register_post_type( 'snack_purchase', $args );
}