<?php
/**
 * Jetpack Compatibility File
 *
 * @link https://jetpack.com/
 *
 * @package autodealer
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.com/support/infinite-scroll/
 * See: https://jetpack.com/support/responsive-videos/
 * See: https://jetpack.com/support/content-options/
 */
function autodealer_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support(
		'infinite-scroll', array(
			'container' => 'main',
			'render'    => 'autodealer_infinite_scroll_render',
			'footer'    => 'page',
		)
	);

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );

	// Add theme support social menu.
	add_theme_support( 'jetpack-social-menu' );

	// Featured content.
	add_theme_support(
		'featured-content', array(
			'filter'     => 'autodealer_get_featured_posts',
			'max_posts'  => 3,
			'post_types' => array( 'post', 'page' ),
		)
	);

	// Add theme support for Content Options.
	add_theme_support(
		'jetpack-content-options', array(
			'blog-display'    => 'content',
			// the default setting of the theme: 'content', 'excerpt' or array( 'content', 'excerpt' ) for themes mixing both display.
			'post-details'    => array(
				'stylesheet' => 'autodealer-style',
				'date'       => '.posted-on',
				'categories' => '.entry-header__category',
				'tags'       => '.tags-links',
				'author'     => '.byline',
				'comment'    => '.comments-link',
			),
			'featured-images' => array(
				'archive'         => true,
				'archive-default' => false,
				'post'            => true,
				'post-default'    => false,
				'page'            => true,
				'page-default'    => false,
			),
		)
	);
}
add_action( 'after_setup_theme', 'autodealer_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function autodealer_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
			get_template_part( 'template-parts/content', 'search' );
		else :
			get_template_part( 'template-parts/content', get_post_type() );
		endif;
	}
}

/**
 * Getter function for Featured Content.
 *
 * @return array An array of WP_Post objects.
 */
function autodealer_get_featured_posts() {
	return apply_filters( 'autodealer_get_featured_posts', array() );
}
