<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package CarListings
 */

/**
 * The content more link.
 *
 * @param string $more More Link.
 */
function carlistings_read_more_link( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	// Translators: %s - post title.
	$text = wp_kses_post( sprintf( __( 'Read More%s', 'carlistings' ), '<span class="screen-reader-text">' . get_the_title() . '</span>' ) );
	$more = sprintf( '&hellip; <p class="link-more"><a href="%s" class="more-link">%s</a></p>', esc_url( get_permalink() ), $text );

	return $more;
}
add_filter( 'the_content_more_link', 'carlistings_read_more_link' );
add_filter( 'excerpt_more', 'carlistings_read_more_link' );

/**
 * Change excerpt length.
 *
 * @param int $length Excerpt length.
 * @return int
 */
function carlistings_custom_excerpt_length( $length ) {
	return is_admin() ? $length : 50;
}
add_filter( 'excerpt_length', 'carlistings_custom_excerpt_length' );

/**
 * Add at a glance to left section
 */
add_action( 'auto_listings_before_listings_loop_item_summary', 'auto_listings_template_loop_at_a_glance', 20 );

/**
 * Add description
 */
remove_action( 'auto_listings_listings_loop_item', 'auto_listings_template_loop_description', 50 );

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
function carlistings_tag_cloud_font_size( $args ) {
	$args['largest']  = 0.8125;
	$args['smallest'] = 0.8125;
	$args['unit']     = 'rem';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'carlistings_tag_cloud_font_size' );

/**
 * Check Plugins Activation
 */
function carlistings_is_plugin_active() {
	return defined( 'AUTO_LISTINGS_VERSION' );
}

add_filter( 'is_auto_listings', function( $condition ) {
	return $condition || is_front_page();
} );