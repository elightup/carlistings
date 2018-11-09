<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CarListings
 */

/**
 * The content more link
 *
 * @param string $more More Link.
 */
function carlistings_read_more_link( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	// Translators: %s - post title.
	$text = wp_kses_post( sprintf( __( 'Read More %s', 'carlistings' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' ) );
	$more = sprintf( ' &hellip; <p class="link-more"><a href="%s" class="more-link">%s</a></p>', esc_url( get_permalink() ), $text );

	return $more;
}
add_filter( 'the_content_more_link', 'carlistings_read_more_link' );
add_filter( 'excerpt_more', 'carlistings_read_more_link' );

/**
 * Length excerpt
 */
function carlistings_custom_excerpt_length() {
	return 50;
}
add_filter( 'excerpt_length', 'carlistings_custom_excerpt_length' );

/**
 * Add tag to the content
 *
 * @param string $content Alter the output of the list categories and archives widgets.
 *
 * @return string
 */
function carlistings_add_tag_the_content( $content ) {
	// Hide category and tag text for pages.
	if ( is_single() ) {

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( 'Tags: ', ' ' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			return $content . '<span class="tags-links">' . $tags_list . '</span>'; // WPCS: XSS OK.
		} else {
			return $content;
		}
	} else {
		return $content;
	}
}
add_filter( 'the_content', 'carlistings_add_tag_the_content' );

/**
 * Demo files for importing.
 *
 * @return array List of demos configuration.
 */
function carlistings_import_files() {
	return array(
		array(
			'import_file_name'             => esc_html__( 'Demo', 'carlistings' ),
			'local_import_file'            => get_template_directory() . '/demos/content.xml',
			'local_import_widget_file'     => get_template_directory() . '/demos/widgets.wie',
			'local_import_customizer_file' => get_template_directory() . '/demos/theme-options.dat',
		),
	);
}

add_filter( 'pt-ocdi/import_files', 'carlistings_import_files' );

/**
 * Setup the theme after importing demo.
 */
function carlistings_after_import_setup() {
	// Assign menus to their locations.
	$header = get_term_by( 'slug', 'Header', 'nav_menu' );
	$footer = get_term_by( 'slug', 'Footer', 'nav_menu' );
	$social = get_term_by( 'slug', 'social-menu', 'nav_menu' );

	set_theme_mod(
		'nav_menu_locations',
		array(
			'menu-1'              => $header->term_id,
			'menu-2'              => $footer->term_id,
			'jetpack-social-menu' => $social->term_id,
		)
	);

	// Setup static front page.
	$front_page = get_page_by_title( 'Home' );
	$blog       = get_page_by_title( 'Blog' );

	$search_page = get_page_by_title( 'i am looking for' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page->ID );
	update_option( 'page_for_posts', $blog->ID );

	set_theme_mod( 'search_section', $search_page->ID );

	update_option( 'permalink_structure', '/%postname%/' );
}

add_action( 'pt-ocdi/after_import', 'carlistings_after_import_setup' );

/**
 * Add at a glance to left section
 */
add_action( 'auto_listings_before_listings_loop_item_summary', 'auto_listings_template_loop_at_a_glance', 20 );

/**
 * Add description
 */
remove_action( 'auto_listings_listings_loop_item', 'auto_listings_template_loop_description', 50 );

/**
 *
 * Filter the make in listing archive
 *
 * @param object $query query object.
 */
function carlistings_filter_make_in_archive( $query ) {
	if ( ! $query->is_main_query() || ! is_post_type_archive( 'auto-listing' ) || is_admin() ) {
		return $query;
	}
	$make = get_query_var( 'make' );
	if ( empty( $make ) ) {
		return $query;
	}
	$meta_query = array(
		array(
			'key'   => '_al_listing_make_display',
			'value' => $make,
		),
	);
	$query->set( 'meta_query', $meta_query );
}
add_action( 'pre_get_posts', 'carlistings_filter_make_in_archive' );

/**
 * Filters the CSS class(es) applied to a menu item's list item element.
 *
 * @param array    $classes The CSS classes that are applied to the menu item's `<li>` element.
 * @param WP_Post  $item    The current menu item.
 * @param stdClass $args    An object of wp_nav_menu() arguments.
 * @param int      $depth   Depth of menu item. Used for padding.
 */
function carlistings_active_autolisting_archive_on_menu( $classes, $item, $args, $depth ) {
	if ( 'menu-1' !== $args->theme_location || ! carlistings_is_plugin_active() ) {
		return $classes;
	}
	$archive_page_id = auto_listings_option( 'archives_page' );
	$archive_page    = get_post( $archive_page_id );
	$archive_page    = $archive_page->post_title;
	if ( is_post_type_archive( 'auto-listing' ) && $item->title === $archive_page ) {
		$classes[] = 'current-menu-item';
	}
	return $classes;
}
add_filter( 'nav_menu_css_class', 'carlistings_active_autolisting_archive_on_menu', 10, 4 );

add_filter( 'comment_form_default_fields', 'carlistings_modify_comment_form_default' );
/**
 * Modify default comment form.
 *
 * @param array $fields default field.
 */
function carlistings_modify_comment_form_default( $fields ) {
	$commenter = wp_get_current_commenter();
	$req       = get_option( 'require_name_email' );
	$aria_req  = ( $req ? " aria-required='true'" : '' );
	$html_req  = ( $req ? " required='required'" : '' );
	$html5     = 'html5' === current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';

	$fields['author'] = '<p class="comment-form-author">' .
				'<input id="author" name="author" placeholder="' . esc_attr__( 'Full Name *', 'carlistings' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" maxlength="245"' . $aria_req . $html_req . ' /></p>';
	$fields['email']  = '<p class="comment-form-email">' .
				'<input id="email" placeholder="' . esc_attr__( 'Mail Address *', 'carlistings' ) . '" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" maxlength="100" aria-describedby="email-notes"' . $aria_req . $html_req . ' /></p>';
	$fields['url']    = '<p class="comment-form-url">' .
				'<input id="url" placeholder="' . esc_attr__( 'Website URL', 'carlistings' ) . '" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" maxlength="200" /></p>';
	return $fields;
}

add_filter( 'comment_form_defaults', 'carlistings_modify_comment_form_args' );
/**
 * Modify default comment form args.
 *
 * @param array $defaults default args.
 */
function carlistings_modify_comment_form_args( $defaults ) {
	$defaults['label_submit']         = esc_html__( 'Submit Comment', 'carlistings' );
	$defaults['title_reply_before']   = '';
	$submit_button                    = sprintf(
		$defaults['submit_button'],
		esc_attr( $defaults['name_submit'] ),
		esc_attr( $defaults['id_submit'] ),
		esc_attr( $defaults['class_submit'] ),
		esc_attr( $defaults['label_submit'] )
	);
	$submit_field                     = sprintf(
		$defaults['submit_field'],
		$submit_button,
		get_comment_id_fields( get_the_ID() )
	);
	$defaults['submit_field']         = '';
	$defaults['comment_field']        = '<div class="comment-form-comment"><textarea id="comment" placeholder="' . esc_attr__( 'Write Your Comments Here...', 'carlistings' ) . '" name="comment" cols="45" rows="8" maxlength="65525" aria-required="true" required="required"></textarea>' . $submit_field . '</div>';
	$defaults['title_reply']          = '';
	$defaults['comment_notes_before'] = '';
	return $defaults;
}

/**
 * Change the Tag Cloud's Font Sizes
 *
 * @param array $args Widget area.
 *
 * @return array.
 */
function carlistings_lite_tag_cloud_fz( $args ) {
	$args['largest']  = 0.8125;
	$args['smallest'] = 0.8125;
	$args['unit']     = 'rem';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'carlistings_lite_tag_cloud_fz' );

/**
 * Check Plugins Activation
 */
function carlistings_is_plugin_active() {
	return defined( 'AUTO_LISTINGS_VERSION' );
}
