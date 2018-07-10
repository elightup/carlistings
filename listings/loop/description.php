<?php
/**
 * Loop description
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/description.php.
 *
 * @package autodealer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$description = auto_listings_meta( 'main_description' );

if ( empty( $description ) ) {
	return;
}
$trimmed = wp_trim_words( $description, 15, ' [...]' );
?>

<div class="description"><?php echo wp_kses_post( $trimmed ); ?></div>
