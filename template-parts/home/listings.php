<?php
/**
 * The Template for displaying the listings archive
 *
 * This template can be overridden by copying it to yourtheme/listings/archive-listing.php.
 *
 * @package autodealer
 */

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( ! is_plugin_active( 'auto-listings/auto-listings.php' ) ) {
	return;
}

$args      = array(
	'post_type' => 'auto-listing',
	'order'     => 'DESC',
);
$the_query = new WP_Query( $args );
get_header( 'listings' );

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
			if ( $the_query->have_posts() ) :

				/**
				 * Before listings
				 *
				 * @hooked auto_listings_ordering (the ordering dropdown)
				 * @hooked auto_listings_view_switcher (the view switcher)
				 * @hooked auto_listings_pagination (the pagination)
				 */
				do_action( 'auto_listings_before_listings_loop' );

				$cols   = auto_listings_columns();
				$count  = 1;

				while ( $the_query->have_posts() ) :
					$the_query->the_post();

					if ( $count % $cols == 1 )
						echo '<ul class="auto-listings-items">';

						auto_listings_get_part( 'content-listing.php' );

					if ( $count % $cols == 0 )
						echo '</ul>';

					$count++;
					endwhile;

					if ( $count % $cols != 1 ) echo '</ul>';

				wp_reset_postdata();

				/**
				 * The pagination
				 *
				 * @hooked auto_listings_pagination (the pagination)
				 */
				do_action( 'auto_listings_after_listings_loop' );

			else :
				?>

				<p class="alert auto-listings-no-results"><?php esc_html_e( 'Sorry, no listings were found.', 'autodealer' ); ?></p>

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
		 * Outputs closing divs for the content
		 *
		 * @hooked auto_listings_output_content_wrapper_end (outputs closing divs for the content)
		 */
		do_action( 'auto_listings_after_main_content' );


		get_footer( 'listings' ); ?>
