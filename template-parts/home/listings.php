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

$args      = array(
	'post_type' => 'auto-listing',
	'order'     => 'DESC',
);
$query = new WP_Query( $args );
if ( ! $query->have_posts() ) {
	return;
}

/**
* Outputs opening divs for the content
*
* @hooked auto_listings_output_content_wrapper (outputs opening divs for the content)
*/
do_action( 'auto_listings_before_main_content' ); ?>

<?php if ( is_active_sidebar( 'auto-listings' ) ) : ?>
	<div class="has-sidebar">
<?php else : ?>
	<div class="listing-no-sidebar">
<?php endif; ?>

	<?php
	/**
	 * Before listings
	 *
	 * @hooked auto_listings_ordering (the ordering dropdown)
	 * @hooked auto_listings_view_switcher (the view switcher)
	 * @hooked auto_listings_pagination (the pagination)
	 */
	do_action( 'auto_listings_before_listings_loop' );

	$cols  = auto_listings_columns();
	$count = 1;

	while ( $query->have_posts() ) :
		$query->the_post();

		if ( 1 === $count % $cols ) {
			echo '<ul class="auto-listings-items">';
		}
			auto_listings_get_part( 'content-listing.php' );

		if ( 0 === $count % $cols ) {
			echo '</ul>';
		}
		$count++;
	endwhile;

	if ( 1 !== $count % $cols ) {
		echo '</ul>';
	}
	wp_reset_postdata();

	/**
	 * The pagination
	 *
	 * @hooked auto_listings_pagination (the pagination)
	 */
	do_action( 'auto_listings_after_listings_loop' );
	?>

<?php if ( is_active_sidebar( 'auto-listings' ) ) : ?>

	</div><!-- has-sidebar -->

	<div class="sidebar">
		<?php dynamic_sidebar( 'auto-listings' ); ?>
	</div>

<?php else : ?>

	</div>

<?php endif; ?>

<div class="full-width lower">
	<?php do_action( 'auto_listings_archive_page_lower_full_width' ); ?>
</div>

<?php
/**
 * Outputs closing divs for the content
 *
 * @hooked auto_listings_output_content_wrapper_end (outputs closing divs for the content)
 */
do_action( 'auto_listings_after_main_content' );
