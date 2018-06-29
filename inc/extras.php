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
	return 25;
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
	return ' &hellip; ' . $link;
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
 */
function add_tag_the_content( $content ) {
	// Hide category and tag text for pages.
	if ( is_single() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( 'Tags: ', esc_html_x( ' ', 'list item separator', 'autodealer' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			return $content . '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
		}
		else {
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
