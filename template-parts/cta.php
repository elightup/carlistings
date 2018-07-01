<?php
/**
 * The template part for displaying cta section
 *
 * @package autodealer
 */

$title       = get_theme_mod( 'cta_title', __( 'You Want To Have Your Favorite Car?', 'autodealer' ) );
$description = get_theme_mod( 'cta_description', __( 'We’ve a big list of modern & classic cars in both used and new categories.', 'autodealer' ) );
$button_url  = get_theme_mod( 'cta_button_url', 'https://gretathemes.com/' );
$button_text = get_theme_mod( 'cta_button_text', __( 'go to car listings', 'autodealer' ) );

$image_background = get_theme_mod( 'cta_background', get_template_directory_uri() . '/images/footer.png' );
if ( $image_background ) {
	$image_background = ' style="background-image: url(' . esc_url( $image_background ) . ')"';
}
?>

<section class="section--cta"<?php echo $image_background; // WPCS: XSS OK. ?>>
	<div class="container">
		<div class="section-cta__left">
			<h2 class="cta-title"><?php echo esc_html( $title ); ?></h2>
			<p class="cta-description"><?php echo esc_html( $description ); ?></p>
		</div>
		<div class="section-cta__right">
			<a href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_text ); ?></a>
		</div>
	</div>
</section>
