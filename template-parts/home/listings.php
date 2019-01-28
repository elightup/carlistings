<?php
/**
 * The Template for displaying the listings archive
 *
 * This template can be overridden by copying it to yourtheme/listings/archive-listing.php.
 *
 * @package CarListings
 */

if ( ! carlistings_is_plugin_active() ) {
	return;
}

$args  = array(
	'post_type' => 'auto-listing',
	'order'     => 'DESC',
);
$query = new WP_Query( $args );
if ( ! $query->have_posts() ) {
	return;
}
?>

<div id="container" class="container">
	<div id="content" class="content" role="main">

		<?php if ( is_active_sidebar( 'auto-listings' ) ) : ?>
			<div class="has-sidebar">
		<?php else : ?>
			<div class="listing-no-sidebar">
		<?php endif; ?>

			<?php
			if ( function_exists( 'auto_listings_view_switcher' ) ) {
				auto_listings_view_switcher();
			}
			$cols  = get_theme_mod( 'front_page_listings_column', 2 );
			$count = 1;

			while ( $query->have_posts() ) :
				$query->the_post();

				if ( 1 === $count % $cols ) {
					echo '<ul class="auto-listings-items">';
				}

				if ( function_exists( 'auto_listings_get_part' ) ) {
					auto_listings_get_part( 'content-listing.php' );
				}

				if ( 0 === $count % $cols ) {
					echo '</ul>';
				}
				$count++;
			endwhile;

			if ( 1 !== $count % $cols ) {
				echo '</ul>';
			}
			wp_reset_postdata();
			?>

		<?php if ( is_active_sidebar( 'auto-listings' ) ) : ?>
			</div><!-- has-sidebar -->
			<div class="sidebar">
				<?php dynamic_sidebar( 'auto-listings' ); ?>
			</div>
		<?php else : ?>
			</div>
		<?php endif; ?>
	</div>
</div>
