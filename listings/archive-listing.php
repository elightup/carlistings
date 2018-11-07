<?php
/**
 * The Template for displaying the listings archive
 *
 * This template can be overridden by copying it to yourtheme/listings/archive-listing.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Detect plugin. For use on Front End only.
 */
require_once ABSPATH . 'wp-admin/includes/plugin.php';

if ( ! carlistings_is_plugin_active() ) {
	return;
}

get_header( 'listings' );

	/**
	 * Outputs opening divs for the content
	 *
	 * @hooked auto_listings_output_content_wrapper
	 */
	do_action( 'auto_listings_before_main_content' ); ?>

		<div class="full-width upper">
			<?php
			/**
			 * Comment
			 *
			 * @hooked auto_listings_listing_archive_description (displays any content, including shortcodes, within the main content editor of your chosen listing archive page)
			 */
			do_action( 'auto_listings_archive_page_upper_full_width' );
			?>
		</div>

		<?php if ( is_active_sidebar( 'auto-listings' ) ) : ?>
			<div class="has-sidebar">
		<?php else : ?>
			<div class="listing-no-sidebar">
		<?php endif; ?>

			<?php
			if ( have_posts() ) :

				/**
				 * Comment
				 *
				 * @hooked auto_listings_ordering (the ordering dropdown)
				 * @hooked auto_listings_view_switcher (the view switcher)
				 * @hooked auto_listings_pagination (the pagination)
				 */
				do_action( 'auto_listings_before_listings_loop' );

					$cols  = auto_listings_columns();
					$count = 1;
				while ( have_posts() ) :
					the_post();

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

				/**
				 * Comment
				 *
				 * @hooked auto_listings_pagination (the pagination)
				 */
				do_action( 'auto_listings_after_listings_loop' );

			else :
			?>

				<p class="alert auto-listings-no-results"><?php esc_html_e( 'Sorry, no listings were found.', 'carlistings' ); ?></p>

			<?php endif; ?>

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
	 * Comment
	 *
	 * @hooked auto_listings_output_content_wrapper_end (outputs closing divs for the content)
	 */
	do_action( 'auto_listings_after_main_content' );


	get_footer( 'listings' );
?>
