<?php
/**
 * Add required and recommended plugins.
 *
 * @package CarListings
 */

add_action( 'tgmpa_register', 'carlistings_register_required_plugins', 11 );

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
		'parent_slug' => 'themes.php',
		'capability'  => 'install_themes',
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
			'name' => esc_html__( 'Meta Box', 'carlistings' ),
			'slug' => 'meta-box',
		),
		array(
			'name' => esc_html__( 'One Click Demo Import', 'carlistings' ),
			'slug' => 'one-click-demo-import',
		),
		array(
			'name' => esc_html__( 'Slim SEO', 'carlistings' ),
			'slug' => 'slim-seo',
		),
	);
}
