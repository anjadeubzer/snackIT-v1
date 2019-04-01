<?php
/***********************************
 * 8. User Overview page - snack columns
 *
 * a) balance
 * b) link to purchase history
 *
 *
 ***********************************/


//  Exit if accessed directly.
defined('ABSPATH') || exit;

function snackit_add_user_column($columns) {
	return array(
		'cb'       => '<input type="checkbox" />',
		'username' => __( 'Username' ),
		'name'     => __( 'Name' ),
		'email'    => __( 'E-mail' ),
		'role'     => __( 'Role' ),
		'posts'    => __( 'Posts' ),
		'purchase_history' => __('Einkäufe'),
		'user_balance' => __('Balance'),
	);
}
add_filter('manage_users_columns' , 'snackit_add_user_column');

// Add the data to the custom columns for user:
function add_user_column_data( $val, $column_name, $user_id ) {

	switch ($column_name) {
		case 'user_balance' :
			return get_user_meta( $user_id, 'user_balance', true);
			break;

		case 'purchase_history' :
			return '<a href="/wp-admin/edit.php?post_type=snack_purchase&author=' . $user_id . '">Purchase history</a>';
			break;


	}
}
add_action( 'manage_users_custom_column', 'add_user_column_data', 10, 3 );