<?php
/**
 * The template part for displaying cta section on front page
 *
 * @package autodealer
 */
?>


<section class="section--cta"<?php echo $image; // WPCS: XSS OK. ?>>
	<div class="footer-info"<?php echo $image_background; // WPCS: XSS OK. ?>>
		<div class="container">
			<div class="footer-info__left">
				<h2 class="footer-title"><?php echo esc_html( $title ); ?></h2>
				<p class="footer-description"><?php echo esc_html( $description ); ?></p>
			</div>
			<div class="footer-info__right">
				<a href="<?php echo esc_url( $button_url ); ?>"><?php echo esc_html( $button_text ); ?></a>
			</div>
		</div>
	</div>
</section>