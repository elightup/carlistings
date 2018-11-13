<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CarListings
 */

if ( ! function_exists( 'carlistings_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function carlistings_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">Date: %2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="updated" datetime="%3$s">Date: %4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date( 'j F Y' ) ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on"><a href="' . esc_url( get_the_permalink() ) . '"><i class="icofont icofont-clock-time"></i>' . wp_kses_post( $time_string ) . '</a></span>';

	}
	endif;

if ( ! function_exists( 'carlistings_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function carlistings_posted_by() {
		$byline = '<span class="author vcard"><i class="icofont icofont-user-male"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

			echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
	}
endif;

/**
 * Prints HTML with meta information for the comment number.
 */
function carlistings_print_comment_link() {
	$comment_number = get_comments_number();
	if ( in_the_loop() && ! is_single() && ! $comment_number ) {
		return;
	}
	if ( ! post_password_required() && ( comments_open() || $comment_number ) ) {
		$comment_number_output = 'Comments: ' . $comment_number;
		echo '<span class="comments-link"><i class="icofont icofont-speech-comments"></i>';
		comments_popup_link( $comment_number_output, $comment_number_output, $comment_number_output );
		echo '</span>';
	}
}

if ( ! function_exists( 'carlistings_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function carlistings_entry_footer() {
		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'carlistings' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', '' );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				echo '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'carlistings' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
	}
endif;

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function carlistings_get_category() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'carlistings' ) );
		if ( $categories_list ) {
			/* translators: 1: list of tags. */
			echo '<span class="entry-header__category">' . $categories_list . '</span>'; // WPCS: XSS OK.
		}
	}
}

if ( ! function_exists( 'carlistings_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function carlistings_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php the_post_thumbnail(); ?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

/**
 * Author Box.
 */
function carlistings_author_box() {
	$description = get_the_author_meta( 'description' );
	if ( ! empty( $description ) ) {
		?>
		<div class="entry-author">
			<div class="author-avatar">
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), 85 ); ?>
			</div><!-- .author-avatar -->
			<div class="author-info">
				<div class="author-header">
					<div class="author-heading">
						<h3 class="author-title">
							<?php
							echo wp_kses_post( '<span class="author-name">' . get_the_author() . '</span>' );
							?>
						</h3>
					</div>
				</div>

				<div class="author-bio">
					<?php the_author_meta( 'description' ); ?>
				</div><!-- .author-bio -->
			</div><!-- .author-info -->
		</div><!-- .entry-author -->
		<?php
	}
}

/**
 * Get car ids.
 */
function carlistings_get_car_ids() {
	$args  = array(
		'post_type'      => 'auto-listing',
		'posts_per_page' => -1,
		'post_status'    => array( 'publish' ),
		'fields'         => 'ids',
	);
	$items = new WP_Query( $args );
	return $items->posts;
}

/**
 * Getter function for section car by make.
 */
function carlistings_get_car_lists() {
	$items = carlistings_get_car_ids();
	$makes = array();

	if ( $items ) {
		foreach ( $items as $id ) {
			$makes[] = get_post_meta( $id, '_al_listing_make_display', true );
		}
	}
	$makes        = array_count_values( $makes );
	$archive_link = get_post_type_archive_link( 'auto-listing' );

	echo '<ul>';
	foreach ( $makes as $make => $value ) {
		?>
		<li>
			<a href="<?php echo esc_url( $archive_link . '?make=' . $make ); ?>">
				<?php
				// translators: make and number of modals.
				echo wp_kses_post( sprintf( __( '%1$s <span>(%2$s)</span>', 'carlistings' ), $make, $value ) );
				?>
			</a>
		</li>
		<?php
	}
	echo '</ul>';
}
