<?php
/**
 * Loop description
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/description.php.
 *
 * @package autodealer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! is_plugin_active( 'auto-listings/auto-listings.php' ) ) {
	return;
}

$description = auto_listings_meta( 'main_description' );

if ( empty( $description ) ) {
	return;
}
$trimmed = wp_trim_words( $description, 15, ' [...]' );
?>

<div class="description"><?php echo wp_kses_post( $trimmed ); ?></div>
