<?php
/**
 * Template Name: Front-page
 *
 * @package CarListings
 */

if ( 'posts' === get_option( 'show_on_front' ) ) {
	get_template_part( 'index' );
	return;
}

get_header();

	get_template_part( 'template-parts/home/search-form' );
	get_template_part( 'template-parts/home/cars-by-make' );
	get_template_part( 'template-parts/home/listings' );


get_footer();
