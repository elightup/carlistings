<?php
/**
 * The template part for displaying search form on front page
 *
 * @package autodealer
 */

$search = get_theme_mod( 'search_section' );
if ( ! $search ) {
	return;
}

$post = get_post( $search );
setup_postdata( $search );

?>

<section class="section--search container">
	<h2 class="search-title"><?php the_title(); ?></h2>
	<div class="search-content">
		<?php the_content(); ?>
	</div>
</section>
