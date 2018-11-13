<?php
/**
 * Single listing address
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/address.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! carlistings_is_plugin_active() ) {
	return;
}

$address = auto_listings_meta( 'displayed_address' );
if ( empty( $address ) ) {
	return;
}

?>

<div class="address">
	<h3><?php esc_html_e( 'Listing Location:', 'carlistings' ); ?></h3>
	<i class="icofont-location-pin"></i>
	<p><?php echo esc_html( $address ); ?></p>
</div>
