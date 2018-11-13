<?php
/**
 * Pagination
 *
 * This template can be overridden by copying it to yourtheme/listings/loop/pagination.php.
 *
 * @package CarListings
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! carlistings_is_plugin_active() ) {
	return;
}

global $wp_query;

if ( $wp_query->max_num_pages <= 1 ) {
	return;
}
?>
<nav class="auto-listings-pagination">
	<?php
	echo paginate_links(
		apply_filters(
			'auto_listings_pagination_args',
			array(
				'base'      => add_query_arg( 'paged', '%#%' ),
				'format'    => '?paged=%#%',
				'mid-size'  => 1,
				'add_args'  => false,
				'current'   => ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1,
				'total'     => $wp_query->max_num_pages,
				'prev_text' => '<i class="icofont icofont-simple-left"></i>',
				'next_text' => '<i class="icofont icofont-simple-right"></i>',
				'type'      => 'list',
				'end_size'  => 3,
			)
		)
	); // WPCS: XSS OK.
	?>
</nav>
