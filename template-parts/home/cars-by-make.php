<?php
/**
 * The template part for displaying search form on front page
 *
 * @package CarListings
 */

$listings_archive_link = get_post_type_archive_link( 'auto-listing' );
$section_title         = get_theme_mod( 'allcar_title', __( 'Browse Cars By Make', 'carlistings' ) );
$description           = get_theme_mod( 'allcar_description', __( 'cars available in different categories', 'carlistings' ) );
$button_url            = get_theme_mod( 'allcar_button_url', esc_url( $listings_archive_link ) );
$button_text           = get_theme_mod( 'allcar_button_text', __( 'See all cars', 'carlistings' ) );

$image    = get_theme_mod( 'allcar_image' );
$image_id = attachment_url_to_postid( $image );
$alt      = ( ! empty( $image_id ) ) ? get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';

$cars = carlistings_get_car_ids();
$cars = count( $cars );

if ( ! $cars ) {
	return;
}
?>

<section class="all--car">
	<div class="container">
		<div class="all-car-left">
			<h3 class="all-car__title"><?php echo esc_html( $section_title ); ?></h3>
			<p class="all-car__description"><?php echo esc_html( $cars . ' ' . $description ); ?></p>

			<?php carlistings_get_car_lists(); ?>

			<?php if ( ! empty( $button_url ) && ! empty( $button_text ) ) : ?>
				<a href="<?php echo esc_url( $button_url ); ?>" class="all-car__button"><?php echo esc_html( $button_text ); ?></a>
			<?php endif; ?>
		</div>

		<?php if ( ! empty( $image ) ) : ?>
			<div class="all-car-right">
				<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
			</div>
		<?php endif; ?>
	</div>
</section>

