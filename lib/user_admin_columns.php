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

function add_extra_user_column($columns) {
	return array_merge( $columns,
		array('user_balance' => __('Balance')) );
}
add_filter('manage_users_columns' , 'add_extra_user_column');