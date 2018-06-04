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
 * @package autodealer
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses autodealer_header_style()
 */
function autodealer_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'autodealer_custom_header_args', array(
		'default-image'      => get_template_directory_uri() . '/images/page-header.png',
		'default-text-color'     => 'fff',
		'width'                  => 1920,
		'height'                 => 260,
		'flex-height'            => true,
		'wp-head-callback'       => 'autodealer_header_style',
	) ) );
	register_default_headers( array(
		'work-space' => array(
			'url'           => '%s/images/page-header.png',
			'thumbnail_url' => '%s/images/page-header.png',
			'description'   => esc_html__( 'Work Space', 'autodealer' ),
		),
	) );
}
add_action( 'after_setup_theme', 'autodealer_custom_header_setup' );

if ( ! function_exists( 'autodealer_header_style' ) ) :
	/**
	 * Show the header image and optionally hide the site title, site description.
	 */
	function autodealer_header_style() {
		$style = '';
		if ( has_header_image() ) {
			$style .= '.page-header { background: url(' . esc_url( get_header_image() ) . ') center no-repeat;}';
		}
		if ( ! display_header_text() ) {
			$style .= '.site-title, .site-description { clip: rect(1px, 1px, 1px, 1px); position: absolute; }';
		}
		if ( $style ) :
			?>
			<style id="autodealer-header-css">
				<?php echo $style; // WPCS: XSS OK. ?>
			</style>
			<?php
		endif;
	}
endif;
