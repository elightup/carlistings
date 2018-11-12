<?php
/**
 * Display featured content on the homepage.
 *
 * @package CarListings
 */

if ( ! defined( 'JETPACK__VERSION' ) ) {
	return;
}
$featured_posts = carlistings_get_featured_posts();
if ( empty( $featured_posts ) ) {
	return;
}
$speed = get_theme_mod( 'slider_speed', 3000 );
?>

<div class="featured-posts is-hidden">
	<div class="featured-post__content" data-speed="<?php echo esc_attr( $speed ); ?>">
		<?php
		foreach ( $featured_posts as $post ) :
			setup_postdata( $post );
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_post_thumbnail( 'full' ); ?>
				<div class="featured-content">
					<div class="container">
						<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
						<?php the_content(); ?>
					</div>
				</div>
			</article>
		<?php endforeach; ?>
	</div>
</div>
<?php
wp_reset_postdata();
