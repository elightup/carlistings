<?php
/**
 * Single listing address
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/address.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$address = auto_listings_meta( 'displayed_address' );
if( empty( $address ) )
	return;

?>

<div class="address">
	<h3><?php _e( 'Listing Location:', 'auto-listings' ); ?></h3>
	<i class="icofont icofont-social-google-map"></i>
	<p><?php echo esc_html( $address ); ?></p>
</div>