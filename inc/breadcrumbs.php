<?php
/**
 * Display breadcrumbs for posts, pages, archive page with the microdata that search engines understand
 *
 * @package CarListings
 */

/**
 * Breadcrumb at the header
 *
 * @param array|string $args argument for HTML output.
 */
function carlistings_breadcrumbs( $args = '' ) {
	if ( is_front_page() ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		array(
			'separator' => '<i class="icofont icofont-rounded-right"></i>',
			'taxonomy'  => 'category',
		)
	);

	$items = array();

	$title = '';

	// HTML template for each item.
	$item_tpl_link = '<li class="breadcrumbs-item" itemtype="http://schema.org/BreadcrumbList">
		<span itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
			<a href="%s" itemprop="url"><span itemprop="title">%s</span></a>
		</span>
	</li>';
	$item_text_tpl = '<li class="breadcrumbs-item" itemtype="http://schema.org/BreadcrumbList">
		<span itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
			<span itemprop="title">%s</span>
		</span>
	</li>';

	// Home.
	$items[] = sprintf(
		'<li class="breadcrumbs-item" itemtype="http://schema.org/BreadcrumbList">
			<span itemprop="itemListElement" itemscope="itemscope" itemtype="http://schema.org/ListItem">
				<a class="home" href="%s" itemprop="url"><span itemprop="title">%s</span></a>
			</span>
		</li>',
		esc_url( home_url( '/' ) ),
		esc_html__( 'Home', 'carlistings' )
	);

	if ( is_home() && ! is_front_page() ) {
		$page = get_option( 'page_for_posts' );
		$title = get_the_title( $page );
	} elseif ( is_post_type_archive() ) {
		// If post is a custom post type.
		$query     = get_queried_object();
		$post_type = $query->name;
		if ( 'post' !== $post_type ) {
			$post_type_object       = get_post_type_object( $post_type );
			$post_type_archive_link = get_post_type_archive_link( $post_type );
			$title                  = $post_type_object->labels->name;
		}
	} elseif ( is_single() ) {
		// If post is a custom post type.
		$post_type = get_post_type();
		if ( 'post' !== $post_type ) {
			$post_type_object       = get_post_type_object( $post_type );
			$post_type_archive_link = get_post_type_archive_link( $post_type );
			$items[]                = sprintf( $item_tpl_link, esc_url( $post_type_archive_link ), esc_html( $post_type_object->labels->name ) );
		} else {
			$blog_page = get_option( 'page_for_posts' );
			if ( ! empty( $blog_page ) ) {
				$blog_url   = get_permalink( $blog_page );
				$blog_title = get_the_title( $blog_page );
				$items[]    = sprintf( $item_tpl_link, esc_url( $blog_url ), esc_html( $blog_title ) );
			}

			$terms = get_the_terms( get_the_ID(), $args['taxonomy'] );
			if ( $terms && ! is_wp_error( $terms ) ) {
				$term    = current( $terms );
				$terms   = carlistings_get_term_parents( $term->term_id, $args['taxonomy'] );
				$terms[] = $term->term_id;
				foreach ( $terms as $term_id ) {
					$term    = get_term( $term_id, $args['taxonomy'] );
					$items[] = sprintf( $item_tpl_link, esc_url( get_term_link( $term, $args['taxonomy'] ) ), esc_html( $term->name ) );
				}
			}
		}

		$title = get_the_title();
	} elseif ( is_page() ) {
		$pages = carlistings_get_post_parents( get_queried_object_id() );
		foreach ( $pages as $page ) {
			$items[] = sprintf( $item_tpl_link, esc_url( get_permalink( $page ) ), esc_html( wp_strip_all_tags( get_the_title( $page ) ) ) );
		}
		$title = get_the_title();
	} elseif ( is_tax() || is_category() || is_tag() ) {
		$current_term = get_queried_object();
		$terms        = carlistings_get_term_parents( get_queried_object_id(), $current_term->taxonomy );
		foreach ( $terms as $term_id ) {
			$term    = get_term( $term_id, $current_term->taxonomy );
			$items[] = sprintf( $item_tpl_link, esc_url( get_category_link( $term_id ) ), esc_html( $term->name ) );
		}
		$title = $current_term->name;
	} elseif ( is_search() ) {
		/* translators: search query */
		$title = sprintf( __( 'Search results for &quot;%s&quot;', 'carlistings' ), get_search_query() );
	} elseif ( is_404() ) {
		$title = __( 'Not found', 'carlistings' );
	} elseif ( is_author() ) {
		$author_obj = get_queried_object();
		// Queue the first post, that way we know what author we're dealing with (if that is the case).
		$title = esc_html( $author_obj->display_name );
	} elseif ( is_day() ) {
		$title = get_the_date();
	} elseif ( is_month() ) {
		$title = get_the_date( 'F Y' );
	} elseif ( is_year() ) {
		$title = get_the_date( 'Y' );
	} else {
		$title = __( 'Archives', 'carlistings' );
	} // End if().

	if ( ! is_single() ) {
		$items[] = sprintf( $item_text_tpl, esc_html( $title ) );
	}

	echo '<h1 class="page-title">' . wp_kses_post( $title ) . '</h1>';

	// Already escaped above.
	//echo '<ul class="breadcrumbs">' . implode( $args['separator'], $items ) . '</ul>'; // WPCS: XSS OK.
	$link = 'slim-seo/slim-seo.php';
	if( is_plugin_active( $link ) ) :
		echo do_shortcode('[slim_seo_breadcrumbs separator="&gt;"]');
	endif;
}

/**
 * Searches for term parents' IDs of hierarchical taxonomies, including current term.
 * This function is similar to the WordPress function get_category_parents() but handles any type of taxonomy.
 * Modified from Hybrid Framework
 *
 * @param int|string    $term_id  The term ID.
 * @param object|string $taxonomy The taxonomy of the term whose parents we want.
 *
 * @return array Array of parent terms' IDs.
 */
function carlistings_get_term_parents( $term_id = '', $taxonomy = 'category' ) {
	// Set up some default arrays.
	$list = array();

	// If no term ID or taxonomy is given, return an empty array.
	if ( empty( $term_id ) || empty( $taxonomy ) ) {
		return $list;
	}

	do {
		$list[] = $term_id;

		// Get next parent term.
		$term    = get_term( $term_id, $taxonomy );
		$term_id = $term->parent;
	} while ( $term_id );

	// Reverse the array to put them in the proper order for the trail.
	$list = array_reverse( $list );
	array_pop( $list );

	return $list;
}

/**
 * Gets parent posts' IDs of any post type, include current post
 * Modified from Hybrid Framework
 *
 * @param int|string $post_id ID of the post whose parents we want.
 *
 * @return array Array of parent posts' IDs.
 */
function carlistings_get_post_parents( $post_id = '' ) {
	// Set up some default array.
	$list = array();

	// If no post ID is given, return an empty array.
	if ( empty( $post_id ) ) {
		return $list;
	}

	do {
		$list[] = $post_id;

		// Get next parent post.
		$post    = get_post( $post_id );
		$post_id = $post->post_parent;
	} while ( $post_id );

	// Reverse the array to put them in the proper order for the trail.
	$list = array_reverse( $list );
	array_pop( $list );

	return $list;
}
