<?php
/**
 * Bottom section
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/bottom.php.
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

if ( ! is_plugin_active( 'auto-listings/auto-listings.php' ) ) {
	return;
}
?>

<div class="bottom-wrap">
	<a class="al-button" href="<?php esc_url( the_permalink() ); ?>" title="<?php esc_html_e( 'View', 'carlistings' ); ?> <?php esc_attr( the_title() ); ?>"><?php esc_html_e( 'More Details', 'carlistings' ); ?>
	</a>
</div>
