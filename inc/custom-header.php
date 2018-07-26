<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link    https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Autodealder
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses autodealer_header_style()
 */
function autodealer_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'autodealer_custom_header_args', array(
		'default-text-color' => 'fff',
		'width'              => 1920,
		'height'             => 260,
		'flex-width'         => true,
		'flex-height'        => true,
		'default-image'      => get_template_directory_uri() . '/images/page-header.png',
		'wp-head-callback'   => 'autodealer_header_style',
	) ) );
	register_default_headers(
		array(
			'work-space' => array(
				'url'           => '%s/images/page-header.png',
				'thumbnail_url' => '%s/images/page-header.png',
				'description'   => esc_html__( 'Work Space', 'autodealer' ),
			),
		)
	);
}
add_action( 'after_setup_theme', 'autodealer_custom_header_setup' );

if ( ! function_exists( 'autodealer_header_style' ) ) :
	/**
	 * Show the header image and optionally hide the site title, site description.
	 */
	function autodealer_header_style() {
		?>
		<style id="autodealer-header-css">
			<?php if ( has_header_image() ) : ?>
				.page-header {
					background: url(<?php echo esc_url( get_header_image() ); ?>) top center no-repeat;
				}
			<?php endif; ?>
			<?php if ( ! display_header_text() ) : ?>
				.site-title,
				.site-description {
					clip: rect(1px, 1px, 1px, 1px);
					position: absolute;
				}
			<?php else : ?>
				.page-header .page-title,
				.breadcrumbs a,
				.breadcrumbs i,
				.page-header .breadcrumbs li {
					color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
				}
			<?php endif; ?>
		</style>
		<?php
	}
endif;
