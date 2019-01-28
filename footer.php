<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CarListings
 */

?>

</div><!-- #content -->

<?php get_template_part( 'template-parts/cta' ); ?>

<footer id="colophon" class="site-footer">

	<div class="footer-bottom">
		<div class="container">
			<div class="footer-copyright">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'carlistings' ) ); ?>">
					<?php
					/* translators: placeholder replaced with string */
					printf( esc_html__( 'Proudly powered by %s', 'carlistings' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
				/* translators: placeholder replaced with string */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'carlistings' ), 'Carlistings', '<a href="' . esc_url( __( 'https://wpautolistings.com/', 'carlistings' ) ) . '" rel="designer">WP Auto Listings</a>' );
				?>
			</div><!-- .site-info -->
			<nav id="footer-site-navigation" class="footer-navigation">
				<?php
				if ( has_nav_menu( 'menu-2' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_id'        => 'footer-menu',
						)
					);
				}
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

<?php wp_footer(); ?>
<a href="#" class="scroll-to-top hidden"><i class="icofont icofont-rounded-up"></i></a>
</body>
</html>
