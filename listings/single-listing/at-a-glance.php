<?php
/**
 * Single listing at a glance
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/at-a-glance.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! carlistings_is_plugin_active() ) {
	return;
}

?>

<div class="at-a-glance">
	<h3><?php esc_html_e( 'Features Highlight', 'carlistings' ); ?></h3>
	<table>
		<tbody>
			<tr>
				<td>
					<?php if ( auto_listings_odometer() ) { ?>
						<span class="odomoter"><i class="icofont icofont-speed-meter"></i> <?php echo esc_html( auto_listings_odometer() ); ?></span>
					<?php } ?>
				</td>
				<td>
					<?php if ( auto_listings_transmission() ) { ?>
						<span class="transmission"><i class="icofont icofont-ui-settings"></i> <?php echo esc_html( auto_listings_transmission() ); ?></span>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php if ( auto_listings_body_type() ) { ?>
						<span class="body"><i class="icofont icofont-car-alt-4"></i> <?php echo auto_listings_body_type(); // WPCS: XSS OK. ?></span>
					<?php } ?>
				</td>
				<td>
					<?php if ( auto_listings_engine() ) { ?>
						<span class="vehicle"><?php echo esc_html( auto_listings_engine() ); ?></span>
					<?php } ?>
				</td>
			</tr>
		</tbody>
	</table>
</div>
