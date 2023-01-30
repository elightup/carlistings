<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package CarListings
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses carlistings_header_style()
 */
function carlistings_custom_header_setup() {
	add_theme_support( 'custom-header',
		apply_filters(
			'carlistings_custom_header_args',
			array(
				'default-image'      => get_template_directory_uri() . '/images/page-header.png',
				'default-text-color' => '000000',
				'width'              => 1000,
				'height'             => 250,
				'flex-height'        => true,
				'wp-head-callback'   => 'carlistings_header_style',
			)
		)
	);
	register_default_headers( array(
		'linux-server' => array(
			'url'           => '%s/images/page-header.png',
			'thumbnail_url' => '%s/images/page-header.png',
			'description'   => esc_html__( 'Linux Server', 'carlistings' ),
		),
	) );
}
add_action( 'after_setup_theme', 'carlistings_custom_header_setup' );

if ( ! function_exists( 'carlistings_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see carlistings_custom_header_setup().
	 */
	function carlistings_header_style() {
		$header_text_color = get_header_textcolor();
		$header_image      = get_header_image();

		// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">
		<?php
		if ( has_header_image() ) :
			?>
			.page-header {
				background-image: url( <?= esc_url( $header_image ); ?> );
			}
			<?php
		endif;
		// Has the text been hidden?
		if ( ! display_header_text() ) :
			?>
			.site-title,
			.site-description {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
			}
			<?php
			// If the user has set a custom color for the text use that.
		else :
			?>
			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
		<?php endif; ?>
		</style>
		<?php
	}
endif;
