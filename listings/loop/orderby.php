<?php
/**
 * Ordering
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/orderby.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! carlistings_is_plugin_active() ) {
	return;
}

global $wp_query;

if ( 1 === $wp_query->found_posts ) {
	return;
}

$by = $_GET['orderby'] ?? 'date';
$by = htmlspecialchars( trim( $by ), ENT_QUOTES, 'UTF-8' );

$options = apply_filters(
	'auto_listings_listings_orderby',
	array(
		'date'       => __( '- Newest Listings -', 'carlistings' ),
		'date-old'   => __( '- Oldest Listings -', 'carlistings' ),
		'price'      => __( '- Price (Low to High) -', 'carlistings' ),
		'price-high' => __( '- Price (High to Low) -', 'carlistings' ),
	)
);

?>
<form class="auto-listings-ordering" method="get">

	<div class="select-wrap">
		<select name="orderby" class="orderby">
			<?php foreach ( $options as $value => $label ) : ?>
				<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $by, $value ); ?>>
					<?php echo esc_html( $label ); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</div>
	<?php
	foreach ( $_GET as $key => $val ) {
		if ( 'orderby' === $key || 'submit' === $key ) {
			continue;
		}
		if ( is_array( $val ) ) {
			foreach ( $val as $inner_val ) {
				echo '<input type="hidden" name="' . esc_attr( $key ) . '[]" value="' . esc_attr( $inner_val ) . '" />';
			}
		} else {
			echo '<input type="hidden" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" />';
		}
	}
	?>

</form>