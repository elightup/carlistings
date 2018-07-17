<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package autodealer
 */

if ( ! function_exists( 'autodealer_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function autodealer_posted_on() {
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

		$byline = sprintf(
			/* translators: the author name */
			esc_html_x( '%s', 'post author', 'autodealer' ),
			'<span class="author vcard"><i class="icofont icofont-user-male"></i><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

			echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link"><i class="icofont icofont-speech-comments"></i>';
			/* translators: %s: post title */
			comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'autodealer' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
			echo '</span>';
		}
			echo '<span class="posted-on"><i class="icofont icofont-clock-time"></i>' . $time_string . '</span>';
	}
	endif;

if ( ! function_exists( 'autodealer_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function autodealer_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'autodealer' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'autodealer_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function autodealer_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'autodealer' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tags: %1$s', 'autodealer' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'autodealer' ),
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

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'autodealer' ),
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
	}
endif;

/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function autodealer_get_category() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		/* translators: used between list items, there is a space after the comma */
		$cate_list = get_the_category_list( esc_html__( ', ', 'autodealer' ) );
		if ( $cate_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="entry-header__category">' . esc_html__( '%1$s', 'autodealer' ) . '</span>', $cate_list ); // WPCS: XSS OK.
		}
	}
}

if ( ! function_exists( 'autodealer_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function autodealer_post_thumbnail() {
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
				<?php
				the_post_thumbnail(
					'post-thumbnail', array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

/**
 * Socials author bio.
 *
 * @param string $id user id.
 */
function autodealer_user_social_links( $id ) {
	$socials        = array( 'facebook', 'twitter', 'google-plus', 'dribbble', 'instagram', 'youtube-play', 'pinterest' );
	$author_website = get_the_author_meta( 'user_url', $id );
	$output         = '';

	if ( ! empty( $author_website ) ) {
		$output = sprintf(
			'<li class="author-website"><a href="%s" class="tag-alike-style ">%s</a>',
			esc_url( $author_website ),
			esc_html__( "visit author's website", 'autodealer' )
		);
	}

	foreach ( $socials as $social ) {
		$social_value = get_the_author_meta( $social, $id );

		if ( 'twitter' === $social ) {
			$social_value = 'https://twitter.com/' . get_the_author_meta( 'twitter', $id );
		}

		if ( empty( $social_value ) ) {
			continue;
		}

		$output .= sprintf(
			'<li><a class="social-links" href="%s"><i class="icofont icofont-social-%s"></i></a></li>',
			esc_url( $social_value ),
			esc_html( $social )
		);
	}

	if ( empty( $output ) ) {
		return '';
	}

	echo '<ul class="author-social">' . wp_kses_post( $output ) . '</ul>';
}

/**
 * Author Box.
 */
function autodealer_author_box() {
	if ( ! empty( get_the_author_meta( 'description' ) ) ) {
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
						<div class="author-twitter">
							<?php
							$twitter = get_the_author_meta( 'twitter' );
							if ( $twitter ) {
								/* translators: author twitter name. */
								printf( wp_kses_post( '<a href="https://twitter.com/%s">@%s</a>', 'autodealer' ), esc_html( $twitter ), esc_html( get_the_author_meta( 'twitter' ) ) );
							}
							?>
						</div>
					</div>
					<?php autodealer_user_social_links( get_the_author_meta( 'ID' ) ); ?>
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
 * Getter function for section car by make.
 */
function autodealer_get_list_cars() {
	$args = array(
		'post_type'      => 'auto-listing',
		'posts_per_page' => -1,
		'post_status'    => array( 'publish' ),
		'fields'         => 'ids',
	);
	$items = get_posts( $args );
	$makes = array();
	$sum   = 0;
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
			<a href="<?php echo esc_url( $archive_link . '?make=' . $make ) ?>">
				<?php
				// translators: make and number of modals.
				echo wp_kses_post( sprintf( __( '%1$s <span>(%2$s)</span>', 'autodealer' ), $make, $value ) );
				?>
			</a>
		</li>
	<?php
		$sum += $value;
	}
	echo '</ul>';
}
