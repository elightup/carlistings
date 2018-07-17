<?php
/**
 * The template part for displaying search form on front page
 *
 * @package autodealer
 */

$title       = get_theme_mod( 'allcar_title', __( 'Browse Cars By Make', 'autodealer' ) );
$description = get_theme_mod( 'allcar_description', __( 'cars available in different categories', 'autodealer' ) );
$button_url  = get_theme_mod( 'allcar_button_url', 'https://gretathemes.com/' );
$button_text = get_theme_mod( 'allcar_button_text', __( 'See all cars', 'autodealer' ) );

$image       = get_theme_mod( 'allcar_image' );
$cars        = autodealer_get_car_ids();
$cars        = count( $cars );

if ( ! $cars ) {
	return;
}
?>

<section class="all--car">
	<div class="container">
		<div class="all-car-left" data-aos="fade-right">
			<h3 class="all-car__title"><?php echo esc_html( $title ); ?></h3>
			<p class="all-car__description"><?php echo esc_html( $cars . ' ' . $description ); ?></p>

			<?php autodealer_get_car_lists(); ?>

			<a href="<?php echo esc_url( $button_url ); ?>" class="all-car__button"><?php echo esc_html( $button_text ); ?></a>
		</div>
		<div class="all-car-right" data-aos="fade-left">
			<img src="<?php echo esc_url( $image ); ?>">
		</div>
	</div>
</section>

