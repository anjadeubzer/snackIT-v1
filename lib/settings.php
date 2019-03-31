<?php

/**
 * Start up
 */
add_action( 'admin_menu', 'add_plugin_page');

/**
 * We need an options page
 */
function add_plugin_page() {
	// This page will be under "Settings"
	add_options_page(
		'SnackIT Settings Page',
		'SnackIT QuickStart',
		'manage_options',
		'snack-it-admin',
		'create_admin_page'
	);
	add_action( 'admin_init', 'page_init' );
}

/**
 * Register and add settings
 */
function page_init() {
	register_setting(
		'snack-group-creator', // Option group
		'additional_snack_groups' // Option name
	);
	create_snack_groups();
}


/**
 * Create Categories
 */
function create_snack_groups() {

	// Populate Custom Taxonomy on plugin install
	$snack_groups = array(
		'DrinkMe!',

		'SoftDrink',
		'HipsterDrink',
		'EnergyDrink',
		'Beer',
		'Dairy',
		'Water',
		'Tea',
		'SugarFree',

		'EatMe!',

		'Soup',
		'Cereals',
		'CerealBars',
		'Nuts',
		'Sweets',
		'Chocolate',
		'Organic',
	);

	if( isset($_POST['additional_snack_groups']) ){
		$addGroupsValue = esc_attr($_POST['additional_snack_groups'] );
	} else {
		$addGroupsValue = ' ';
	}

	$addGroupsTrimmed = trim($addGroupsValue);

	$addGroupsArray = explode(',',$addGroupsTrimmed);
	$merged_snack_groups = array_merge($snack_groups, $addGroupsArray);

	foreach ($merged_snack_groups as $key => $value)
	{

		$termString = $value.''; //to make sure the value is a string
		$term = term_exists($termString,'snack_groups');

		if($term==0 || $term==null)
		{
			$trimmedValue = trim($termString);
			wp_insert_term( $trimmedValue, 'snack_groups' );
		}

	}
}



/**
 * Options page callback
 */
function create_admin_page()
{
	// Set class property
	settings_fields( 'snack-group-creator' );
	do_settings_sections( 'snack-group-creator' ); ?>
	<div class="wrap">
		<h1>SnackIT QuickStart - helping you to get started with ease … </h1>

		<form method='post'>
			<input type='hidden' name='form-name' value='form 2' />
			<?php settings_fields( 'snack-group-creator' ); ?>
			<?php do_settings_sections( 'snack-group-creator' ); ?>
			<table class="form-table">
				<tr valign="top">
					<td scope="row"><strong>Create a first set of Snack Groups by clicking the Button.</strong><br>
						<br>
						This Groups will be created: <br>
						<br>
						DrinkMe! -> SoftDrink, Beer, Dairy, Water, Tea, SugarFree, HipsterDrink, EnergyDrink <br>
						EatMe!   -> Soup, Müsli, CerealBar, Nuts, Sweets, Chocolate, Organic
					</td>
				</tr>
				<tr>
					<td>
						<label for="moreGroups">Optional you can also add additional groups in one sweep:</label><br>
						<textarea id="moreGroups" cols="80" rows="4" name="additional_snack_groups"></textarea> <br>
						<i>(add the names of the Category separated by comma)</i>
					</td>
				</tr>
			</table>
			<?php submit_button('Create Snack Groups'); ?>
		</form>
	</div>
	<?php
}