<?php
/**
 * Loop address
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/address.php.
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

$address = auto_listings_meta( 'displayed_address' );
if ( empty( $address ) ) {
	return;
}
?>

<div class="address">
	<i class="icofont icofont-social-google-map"></i>
	<?php echo esc_html( $address ); ?>
</div>
