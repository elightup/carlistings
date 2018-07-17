<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package autodealer
 */

/**
 * Length excerpt
 */
function autodealer_custom_excerpt_length() {
	return 50;
}
add_filter( 'excerpt_length', 'autodealer_custom_excerpt_length' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a 'Read More' link.
 *
 * @param string $link The string shown within the more link.
 *
 * @return string 'Read More' link prepended with an ellipsis.
 */
function autodealer_excerpt_more_link( $link ) {
	if ( is_admin() || is_front_page() ) {
		return $link;
	}

	$link = sprintf(
		'<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Read More<span class="screen-reader-text"> "%s"</span>', 'autodealer' ), get_the_title( get_the_ID() ) )
	);
	return ' [&hellip;] ' . $link;
}
add_filter( 'excerpt_more', 'autodealer_excerpt_more_link' );

/**
 * Change markup of archive and category widget to include .count for post count
 *
 * @param string $output Alter the output of the list categories and archives widgets.
 *
 * @return string
 */
function autodealer_widget_archive_count( $output ) {
	$output = preg_replace( '|\((\d+)\)|', '<span class="count">(\\1)</span>', $output );

	return $output;
}
add_filter( 'wp_list_categories', 'autodealer_widget_archive_count' );

/**
 * Add tag to the content
 *
 * @param string $content Alter the output of the list categories and archives widgets.
 *
 * @return string
 */
function add_tag_the_content( $content ) {
	// Hide category and tag text for pages.
	if ( is_single() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( 'Tags: ', esc_html_x( ' ', 'list item separator', 'autodealer' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			return $content . '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
		} else {
			return $content;
		}
	} else {
		return $content;
	}
}
add_filter( 'the_content', 'add_tag_the_content' );

/**
 * Add social networks to user profile
 *
 * @param array $methods Currently set contact methods.
 *
 * @return array
 */
function user_social_networks_add( $methods ) {
	$methods['googleplus'] = esc_html__( 'Google+', 'autodealer' );
	$methods['twitter']    = esc_html__( 'Twitter username (without @)', 'autodealer' );
	$methods['facebook']   = esc_html__( 'Facebook profile URL', 'autodealer' );
	$methods['linkedin']   = esc_html__( 'Linkedin', 'autodealer' );
	$methods['instagram']  = esc_html__( 'Instagram', 'autodealer' );
	$methods['dribbble']   = esc_html__( 'Dribbble', 'autodealer' );
	$methods['youtube']    = esc_html__( 'Youtube', 'autodealer' );
	$methods['pinterest']  = esc_html__( 'Pinterest', 'autodealer' );

	return $methods;
}
add_filter( 'user_contactmethods', 'user_social_networks_add' );

/**
 * Demo files for importing.
 *
 * @return array List of demos configuration.
 */
function autodealer_import_files() {
	$autodealer_demo_url = trailingslashit( get_template_directory_uri() ) . 'demo/';

	return array(
		array(
			'import_file_name'             => esc_html__( 'Demo 1', 'autodealer' ),
			'import_file_url'              => $autodealer_demo_url . 'content.xml',
			'import_widget_file_url'       => $autodealer_demo_url . 'widgets.wie',
			'local_import_customizer_file' => $autodealer_demo_url . 'theme-options.dat',
			'import_preview_image_url'     => $autodealer_demo_url . 'preview_image.jpg',
		),
	);
}

add_filter( 'pt-ocdi/import_files', 'autodealer_import_files' );

/**
 * Setup the theme after importing demo.
 */
function autodealer_after_import_setup() {
	// Assign menus to their locations.
	$header = get_term_by( 'slug', 'Header', 'nav_menu' );
	$footer = get_term_by( 'slug', 'Footer', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations', array(
			'menu-1'              => $header->term_id,
			'menu-2'              => $footer->term_id,
		)
	);

	// Setup static front page.
	$front_page = get_page_by_title( 'Home' );
	$blog       = get_page_by_title( 'Blog' );

	$search_page = get_page_by_title( 'i am looking for' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page->ID );
	update_option( 'page_for_posts', $blog->ID );

	set_theme_mod( 'search_section', $search_page->ID );

	update_option( 'permalink_structure', '/%postname%/' );
}

add_action( 'pt-ocdi/after_import', 'autodealer_after_import_setup' );

/**
 * Add at a glance to left section
 */
add_action( 'auto_listings_before_listings_loop_item_summary', 'auto_listings_template_loop_at_a_glance', 20 );

/**
 * Add description
 */
add_action( 'auto_listings_listings_loop_item', 'auto_listings_template_loop_description', 20 );

/**
 * Remove description
 */
function remove_active_hooks_description() {
	remove_action( 'auto_listings_listings_loop_item', 'auto_listings_template_loop_description', 50 );
}
add_action( 'auto_listings_listings_loop_item', 'remove_active_hooks_description', 49 );

/**
 *
 * Filter the make in listing archive
 *
 * @param object $query query object.
 */
function autodealer_filter_make_in_archive( $query ) {
	if ( ! $query->is_main_query() || ! is_post_type_archive( 'auto-listing' ) || is_admin() ) {
		return $query;
	}
	$make = get_query_var( 'make' );
	if ( empty( $make ) ) {
		return $query;
	}
	$meta_query = array(
		array(
			'key'   => '_al_listing_make_display',
			'value' => $make,
		),
	);
	$query->set( 'meta_query', $meta_query );
}
add_action( 'pre_get_posts', 'autodealer_filter_make_in_archive' );

/**
 * Filters the CSS class(es) applied to a menu item's list item element.
 *
 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 */
function autodealer_active_autolisting_archive_on_menu( $classes, $item, $args, $depth ) {
	if ( 'menu-1' !== $args->theme_location ) {
		return $classes;
	}
	$archive_page_id = auto_listings_option( 'archives_page' );
	$archive_page = get_post( $archive_page_id );
	$archive_page = $archive_page->post_title;
	if ( is_post_type_archive( 'auto-listing' ) && $item->title === $archive_page ) {
		$classes[] = 'current-menu-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'autodealer_active_autolisting_archive_on_menu', 10, 4 );
