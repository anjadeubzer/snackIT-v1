<?php
/***********************************
 * 3. The custom fields for the custom post type 'snack'
 *
 * a) snack_price
 * b) snack_size
 * c) snack_description
 * d) active (yes/no)
 *
 ***********************************/


//  Exit if accessed directly.
defined('ABSPATH') || exit;


// register custom meta fields for the snackit custom post type
add_action( 'init', 'register_snack_purchase_meta' );


function register_snack_purchase_meta() {

	register_meta( 'post', 'snack_id', array(
		'show_in_rest' => true,
		'single' => true,
		'type' => 'integer', // zb. 75
		'description' => 'ID of purchased product',
		'object_subtype' => 'snack_purchase',
	) );

	register_meta( 'post', 'purchase_price', array(
		'show_in_rest' => true,
		'single' => true,
		'type' => 'integer', // zb. 60 cents
		'description' => 'save the current price', // in case it may be changed while balance is not cleared
		'object_subtype' => 'snack_purchase',
	) );

	register_meta( 'post', 'purchase_paid', array(
		'show_in_rest' => true,
		'single' => true,
		'type' => 'boolean',
		'description' => 'Have you paid it or not',
		'object_subtype' => 'snack_purchase',
	) );

}
