<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CarListings
 */

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function carlistings_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on"><a href="' . esc_url( get_the_permalink() ) . '"><i class="icofont icofont-clock-time"></i>' . wp_kses_post( $time_string ) . '</a></span>';
}

/**
 * Prints HTML with meta information for the comment number.
 */
function carlistings_print_comment_link() {
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="icofont icofont-speech-comments"></i>';
		comments_popup_link();
		echo '</span>';
	}
}

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

	// Post tags.
	if ( 'post' === get_post_type() ) {
		the_tags( '<span class="tags-links">', '', '</span>' );
	}
}

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function carlistings_get_category() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		echo '<span class="entry-header__category">';
		// translators: used between list items, there is a space after the comma.
		the_category( esc_html__( ', ', 'carlistings' ) );
		echo '</span>';
	}
}

/**
 * Author Box.
 */
function carlistings_author_box() {
	$description = get_the_author_meta( 'description' );
	if ( empty( $description ) ) {
		return;
	}
	?>
	<div class="entry-author">
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), 85 ); ?>
		</div><!-- .author-avatar -->
		<div class="author-info">
			<div class="author-header">
				<div class="author-heading">
					<h3 class="author-title">
						<?php echo '<span class="author-name">' . esc_html( get_the_author() ) . '</span>'; ?>
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

/**
 * Get car ids.
 */
function carlistings_get_car_ids() {
	$args  = array(
		'post_type'      => 'auto-listing',
		'posts_per_page' => 999,
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
		$make_link = add_query_arg(
			array(
				's'      => '',
				'make[]' => $make,
			),
			$archive_link
		);
		?>
		<li>
			<a href="<?php echo esc_url( $make_link ); ?>">
				<?php
				// translators: %1$s - make, %2$s number of cars.
				echo wp_kses_post( sprintf( __( '%1$s <span>(%2$s)</span>', 'carlistings' ), $make, $value ) );
				?>
			</a>
		</li>
		<?php
	}
	echo '</ul>';
}
