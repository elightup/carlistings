<?php
/**
 * Single listing address
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/address.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! carlistings_is_plugin_active() ) {
	return;
}

$dealer_id = auto_listings_get_dealer_ID();

if ( empty( $dealer_id ) ) {
	return;
}

$website = auto_listings_dealer_meta( 'website', $dealer_id );
$phone   = auto_listings_dealer_meta( 'phone', $dealer_id );
$address = auto_listings_dealer_meta( 'displayed_address', $dealer_id );
?>

<div class="dealer">

	<h3><?php esc_html_e( 'Dealer Details', 'carlistings' ); ?></h3>

	<div class="logo">
		<a href="<?php echo esc_url( get_the_permalink( $dealer_id ) ); ?>">
			<?php rwmb_the_value( '_al_dealer_logo', array( 'size' => 'full' ), $dealer_id ); ?>
		</a>
	</div>

	<h4 class="name">
		<a href="<?php echo esc_url( get_the_permalink( $dealer_id ) ); ?>">
			<?php echo get_the_title( $dealer_id ); ?>
		</a>
	</h4>

	<div class="address"><i class="icofont-location-pin"></i><?php echo esc_html( $address ); ?></div>

	<ul class="contact">
		<?php if ( $website ) { ?>
		<li class="website"><i class="icofont-link-alt"></i><?php echo esc_html( $website ); ?></li>
		<?php } ?>
		<?php if ( $phone ) { ?>
		<li class="phone"><i class="icofont-phone"></i><?php echo esc_html( $phone ); ?></li>
		<?php } ?>
	</ul>

</div>
