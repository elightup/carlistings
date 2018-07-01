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

$logo = get_theme_mod( 'footer_logo' );
if ( $logo ) {
	$logo = esc_url( $logo );
}
?>

<?php
	get_template_part( 'template-parts/cta' );
?>

<footer id="colophon" class="site-footer">

	<div class="footer-bottom">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="footer-logo">
				<img src="<?php echo esc_url( $logo ); ?>">
			</a>
			<nav id="footer-site-navigation" class="footer-navigation">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'footer-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
		</div>
	</div>

</footer><!-- #colophon -->

</div><!-- #page -->

<nav class="mobile-navigation" role="navigation">
	<?php
	wp_nav_menu(
		array(
			'container_class' => 'mobile-menu',
			'menu_class'      => 'mobile-menu clearfix',
			'theme_location'  => 'menu-1',
			'items_wrap'      => '<ul>%3$s</ul>',
		)
	);
	?>
</nav>

<script type="text/javascript">
	AOS.init({
		offset: 10,
		duration: 1000,
		once: true,
	})
</script>
<?php wp_footer(); ?>
<a href="#" class="scroll-to-top hidden"><i class="icofont icofont-rounded-up"></i></a>
</body>
</html>
