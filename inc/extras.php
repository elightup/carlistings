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

	$link = sprintf( '<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
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
	$output = preg_replace( '|\((\d+)\)|', '<span class="count">(1)</span>', $output );

	return $output;
}
add_filter( 'wp_list_categories', 'autodealer_widget_archive_count' );