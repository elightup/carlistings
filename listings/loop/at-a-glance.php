<?php
/**
 * Single listing at a glance
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/at-a-glance.php.
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
?>


<div class="at-a-glance">
	<ul>
		<li class="odomoter"><i class="icofont icofont-speed-meter"></i> <?php echo esc_html( auto_listings_odometer() ); ?></li>
	<?php if ( auto_listings_transmission() ) { ?>
		<li class="transmission"><i class="icofont icofont-ui-settings"></i> <?php echo esc_html( auto_listings_transmission() ); ?></li>
	<?php } ?>
	<?php if ( auto_listings_body_type() ) { ?>
		<li class="body"><i class="icofont icofont-car-alt-4"></i> <?php echo auto_listings_body_type(); ?></li>
	<?php } ?>
	</ul>

</div>
