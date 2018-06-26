<?php
/**
 * Template part for displaying page content in page.php
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

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
