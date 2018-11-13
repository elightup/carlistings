<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package CarListings
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-media">
		<?php the_post_thumbnail(); ?>
	</div>

	<div class="article__content">

		<div class="entry-content">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'carlistings' ),
					'after'  => '</div>',
				)
			);
			?>
		</div><!-- .entry-content -->

	</div>
</article><!-- #post-<?php the_ID(); ?> -->
