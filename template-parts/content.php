<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package autodealer
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-media">
		<?php the_post_thumbnail( 'autodealer-blog-thumbnail' ); ?>
	</div>

	<div class="article__content">
		<header class="entry-header">
			<?php autodealer_get_category(); ?>
			<div class="entry-meta">
				<?php autodealer_posted_on(); ?>
			</div>
		</header><!-- .entry-header -->

		<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>

		<div class="entry-content">
			<?php

			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'autodealer' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->
		<?php autodealer_author_box(); ?>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
