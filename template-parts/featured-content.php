<?php
/**
 * Display featured content on the homepage.
 *
 * @package autodealer
 */

$featured_posts = autodealer_get_featured_posts();

if ( empty( $featured_posts ) ) {
	return;
}
$speed = 3000;
?>

<div class="clearfix featured-posts">
	<div class="featured-post__content" data-speed="<?php echo esc_html( $speed ); ?>">
		<?php
		foreach ( $featured_posts as $index => $post ) :
			setup_postdata( $post );
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$url_image = get_the_post_thumbnail_url( $post, 'full' );
				echo '<img src="' . esc_url( $url_image ) . '" data-lazy="' . esc_url( $url_image ) . '" alt="' . get_the_title() . '"/>';
				?>
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
