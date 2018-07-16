<?php
/**
 * Ordering
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/orderby.php.
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

global $wp_query;

if ( 1 === $wp_query->found_posts ) {
	return;
}

$orderby         = isset( $_GET['orderby'] ) ? esc_html( $_GET['orderby'] ) : 'date';
$orderby_options = apply_filters(
	'auto_listings_listings_orderby', array(
		'date'       => __( '- New Listings -', 'autodealer' ),
		'date-old'   => __( '- Oldest Listings -', 'autodealer' ),
		'price'      => __( '- Price (Low to High) -', 'autodealer' ),
		'price-high' => __( '- Price (High to Low) -', 'autodealer' ),
	)
);

?>
<form class="auto-listings-ordering" method="get" >

	<div class="select-wrap">
		<select name="orderby" class="orderby">
			<?php foreach ( $orderby_options as $id => $name ) : ?>
				<option value="<?php echo esc_attr( $id ); ?>" <?php selected( $orderby, $id ); ?>><?php echo esc_html( $name ); ?></option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php

	foreach ( $_GET as $key => $val ) {

		if ( 'orderby' === $key || 'submit' === $key ) {
			continue;
		}
		if ( is_array( $val ) ) {
			foreach ( $val as $innerVal ) {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $innerVal ) . '" />';
			}
		} else {
			echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
		}
	}
	?>

</form>
