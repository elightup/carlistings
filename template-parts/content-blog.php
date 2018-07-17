<?php
/**
 * Template part for blog style large.
 *
 * @package autodealer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> data-aos="fade-up">

	<?php get_template_part( 'template-parts/content', 'media' ); ?>

	<div class="article__content">
		<header class="entry-header">
			<?php autodealer_get_category(); ?>
			<div class="entry-meta">
				<?php
				autodealer_posted_by();
				autodealer_print_comment_link();
				autodealer_posted_on();
				?>
			</div>
		</header><!-- .entry-header -->

		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>

		<div class="entry-content">
			<?php

			the_content('read more');

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'autodealer' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
