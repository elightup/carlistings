<?php
/**
 * Add required and recommended plugins.
 *
 * @package autodealer
 */

add_action( 'tgmpa_register', 'autodealer_register_required_plugins' );

/**
 * Register required plugins
 *
 * @since  1.0
 */
function autodealer_register_required_plugins() {
	$plugins = array(
		array(
			'name'     => esc_html__( 'Jetpack', 'autodealer' ),
			'slug'     => 'jetpack',
			'required' => true,
		),
		array(
			'name' => esc_html__( 'Auto Listings', 'autodealer' ),
			'slug' => 'auto-listings',
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
	);

	$config = array(
		'id' => 'autodealer',
	);

	tgmpa( $plugins, $config );
}
