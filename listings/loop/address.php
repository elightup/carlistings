<?php
/**
 * loop address
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/address.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
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
