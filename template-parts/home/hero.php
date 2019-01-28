<?php
/**
 * Display hero section on the homepage instead of featured slider.
 *
 * @package CarListings
 */

if ( ! have_posts() ) {
	return;
}

the_post();

if ( ! has_post_thumbnail() ) {
	return;
}
?>

<div class="featured-posts">
	<section class="featured-post__content">
		<?php the_post_thumbnail( 'full' ); ?>
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
