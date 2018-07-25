<?php
/**
 * The Template for displaying listing content in the single-listing.php template
 *
 * This template can be overridden by copying it to yourtheme/listings/content-single-listing.php.
 *
 * @package autodealer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Detect plugin. For use on Front End only.
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

if ( ! is_plugin_active( 'auto-listings/auto-listings.php' ) ) {
	return;
}

$cols = auto_listings_columns();
?>

<li <?php post_class( 'col-' . $cols ); ?> data-aos='fade-up'>
	<div class="items-left">
		<?php
		/**
		 * Image and at a glance
		 *
		 * @hooked auto_listings_template_loop_image
		 */
		do_action( 'auto_listings_before_listings_loop_item_summary' );
		?>
	</div>
	<div class="summary">

	<?php
	do_action( 'auto_listings_before_listings_loop_item' );

	/**
	 * Info single listings
	 *
	 * @hooked auto_listings_template_loop_title
	 * @hooked auto_listings_template_loop_at_a_glance
	 * @hooked auto_listings_template_loop_address
	 * @hooked auto_listings_template_loop_price
	 * @hooked auto_listings_template_loop_description
	 * @hooked auto_listings_template_loop_bottom
	 */
	do_action( 'auto_listings_listings_loop_item' );

	do_action( 'auto_listings_after_listings_loop_item' );
	?>

	</div>

	<?php

	do_action( 'auto_listings_after_listings_loop_item_summary' );
	?>

</li>
