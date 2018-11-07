<?php
/**
 * Single listing contact-form
 *
 * This template can be overridden by copying it to yourtheme/listings/single-listing/contact-form.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Detect plugin. For use on Front End only.
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

if ( ! carlistings_is_plugin_active() ) {
	return;
}

?>
<div class="contact-form">
	<h3><?php esc_html_e( 'Quick Contact', 'carlistings' ); ?></h3>
	<div id="auto-listings-contact">
		<?php echo do_shortcode( '[auto_listings_contact_form]' ); ?>
	</div>
</div>
