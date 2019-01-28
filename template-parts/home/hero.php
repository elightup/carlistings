<?php
/**
 * Display hero section on the homepage instead of featured slider.
 *
 * @package CarListings
 */

$post_thumbnail = get_the_post_thumbnail( get_the_ID(), 'full' );
if ( empty( $post_thumbnail ) ) {
	return;
}

if ( have_posts() ) :
	while ( have_posts() ) :
		the_post();
		?>

		<div class="featured-posts">
			<section class="featured-post__content">
				<?php echo wp_kses_post( $post_thumbnail ); ?>
				<div class="featured-content">
					<div class="container">
						<?php
						the_title( '<h3 class="entry-title">', '</h3>' );
						the_content();
						?>
					</div>
				</div>
			</section>
		</div>

		<?php
	endwhile;
endif;
