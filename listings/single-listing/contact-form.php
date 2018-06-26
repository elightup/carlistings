<?php
/**
 * Single listing contact-form
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/contact-form.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="contact-form">
	<h3><?php echo __( 'Quick Contact', 'auto-listings' ); ?></h3>
	<div id="auto-listings-contact">
		<?php echo do_shortcode( '[auto_listings_contact_form]' ); ?>
	</div>
</div>
