<?php
/**
 * Bottom section
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/bottom.php.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="bottom-wrap">
	<a class="al-button" href="<?php esc_url( the_permalink() ); ?>" title="<?php _e( 'View', 'auto-listings' ); ?> <?php esc_attr( the_title() ); ?>"><?php _e( 'More Details', 'auto-listings' ); ?>
	</a>
</div>
