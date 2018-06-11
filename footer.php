<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package autodealer
 */

?>

</div><!-- #content -->

<?php

$title       = get_theme_mod( 'footer_title', __( 'You Want To Have Your Favorite Car?', 'business-lander' ) );
$description = get_theme_mod( 'footer-description', __( 'We’ve a big list of modern & classic cars in both used and new categories.', 'business-lander' ) );
$button_url  = get_theme_mod( 'footer_button_url', 'https://gretathemes.com/' );
$button_text = get_theme_mod( 'footer-button-text', __( 'go to car listings', 'business-lander' ) );

$image_background = get_theme_mod( 'footer_background' );
if ( $image_background ) {
	$image_background = ' style="background-image: url(' . esc_url( $image_background ) . ')"';
}

$logo = get_theme_mod( 'footer_logo' );
if ( $logo ) {
	$logo = esc_url( $logo );
}
?>

<footer id="colophon" class="site-footer">

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
	</div><!-- .footer-info -->

	<div class="footer-bottom">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
				<img src="<?php echo $logo; ?>">
			</a>
			<nav id="footer-site-navigation" class="footer-navigation">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-2',
					'menu_id'        => 'footer-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
		</div>
	</div>

</footer><!-- #colophon -->

</div><!-- #page -->

<nav class="mobile-navigation" role="navigation">
	<?php
	wp_nav_menu( array(
		'container_class' => 'mobile-menu',
		'menu_class'      => 'mobile-menu clearfix',
		'theme_location'  => 'menu-1',
		'items_wrap'      => '<ul>%3$s</ul>',
	) );
	?>
</nav>
<?php wp_footer(); ?>
<!-- <a href="#" class="scroll-to-top hidden"><i class="icofont icofont-rounded-up"></i></a> -->

</body>
</html>
