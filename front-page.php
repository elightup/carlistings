<?php
/**
 * Template Name: Front-page
 *
 * @package autodealer
 */



get_header();
do_action( 'auto_listings_before_listings_loop' );
echo do_shortcode( '[auto_listings_listings]' );

get_footer();
