<?php
/**
 * Add required and recommended plugins.
 *
 * @package CarListings
 */

add_action( 'tgmpa_register', 'carlistings_register_required_plugins' );

/**
 * Register required plugins
 *
 * @since  1.0
 */
function carlistings_register_required_plugins() {
	$plugins = carlistings_required_plugins();

	$config = array(
		'id'          => 'carlistings',
		'has_notices' => false,
	);

	tgmpa( $plugins, $config );
}

/**
 * List of required plugins
 */
function carlistings_required_plugins() {
	return array(
		array(
			'name' => esc_html__( 'Jetpack', 'carlistings' ),
			'slug' => 'jetpack',
		),
		array(
			'name' => esc_html__( 'Auto Listings', 'carlistings' ),
			'slug' => 'auto-listings',
		),
		array(
			'name' => esc_html__( 'One click demo import', 'carlistings' ),
			'slug' => 'one-click-demo-import',
		),
		array(
			'name' => esc_html__( 'Ultimate Fonts', 'carlistings' ),
			'slug' => 'ultimate-fonts',
		),
		array(
			'name' => esc_html__( 'Ultimate Colors', 'carlistings' ),
			'slug' => 'ultimate-colors',
		),
		array(
			'name' => esc_html__( 'Instagram Slider Widget', 'carlistings' ),
			'slug' => 'instagram-slider-widget',
		),
	);
}
