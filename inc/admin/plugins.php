<?php
/**
 * Add required and recommended plugins.
 *
 * @package AutoDealer
 */

add_action( 'tgmpa_register', 'autodealer_register_required_plugins' );

/**
 * Register required plugins
 *
 * @since  1.0
 */
function autodealer_register_required_plugins() {
	$plugins = autodealer_required_plugins();

	$config = array(
		'id'          => 'autodealer',
		'has_notices' => false,
	);

	tgmpa( $plugins, $config );
}

/**
 * List of required plugins
 */
function autodealer_required_plugins() {
	return array(
		array(
			'name'     => esc_html__( 'Jetpack', 'autodealer' ),
			'slug'     => 'jetpack',
		),
		array(
			'name'     => esc_html__( 'Auto Listings', 'autodealer' ),
			'slug'     => 'auto-listings',
			'required' => true,
		),
		array(
			'name' => esc_html__( 'One click demo import', 'autodealer' ),
			'slug' => 'one-click-demo-import',
		),
		array(
			'name' => esc_html__( 'Ultimate Fonts', 'autodealer' ),
			'slug' => 'ultimate-fonts',
		),
		array(
			'name' => esc_html__( 'Ultimate Colors', 'autodealer' ),
			'slug' => 'ultimate-colors',
		),
		array(
			'name' => esc_html__( 'Instagram Slider Widget', 'autodealer' ),
			'slug' => 'instagram-slider-widget',
		),
	);
}
