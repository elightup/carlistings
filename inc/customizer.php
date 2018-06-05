<?php
/**
 * AutoDealer Theme Customizer
 *
 * @package autodealer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function autodealer_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Add theme options panel.
	$wp_customize->add_panel( 'autodealer', array(
		'title'           => esc_html__( 'Theme Options', 'autodealer' ),
		// 'active_callback' => 'is_front_page',
	) );

	/**
	 * Header.
	 */
	$wp_customize->add_section( 'header', array(
		'title' => esc_html__( 'Header', 'autodealer' ),
		'panel' => 'autodealer',
	) );

	$wp_customize->add_setting( 'header_time', array(
		'default'           => wp_kses_post( __( '10:00 AM To 5:00 PM', 'autodealer' ) ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'header_time', array(
		'label'           => esc_html__( 'Header Time', 'autodealer' ),
		'section'         => 'header',
		'type'            => 'text',
	) );

	$wp_customize->add_setting( 'header_mail', array(
		'default'           => wp_kses_post( __( 'autodealer@no-reply.com', 'autodealer' ) ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'header_mail', array(
		'label'           => esc_html__( 'Header Time', 'autodealer' ),
		'section'         => 'header',
		'type'            => 'text',
	) );

	/**
	 * Footer.
	 */
	$wp_customize->add_section( 'footer', array(
		'title' => esc_html__( 'Footer', 'autodealer' ),
		'panel' => 'autodealer',
	) );

	/**
	 * Footer section.
	 */

	$wp_customize->add_setting( 'footer_title', array(
		'default'           => wp_kses_post( __( 'You Want To Have Your Favorite Car?', 'autodealer' ) ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer_title', array(
		'label'           => esc_html__( 'Footer Title', 'autodealer' ),
		'section'         => 'footer',
		'type'            => 'textarea',
	) );

	$wp_customize->add_setting( 'footer-description', array(
		'default'           => esc_html__( 'We’ve a big list of modern & classic cars in both used and new categories.', 'autodealer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer-description', array(
		'label'           => esc_html__( 'Footer Description', 'autodealer' ),
		'section'         => 'footer',
		'type'            => 'textarea',
	) );

	$wp_customize->add_setting( 'footer-button-text', array(
		'default'           => esc_html__( 'go to car listings', 'autodealer' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer-button-text', array(
		'label'           => esc_html__( 'Footer Button Text', 'autodealer' ),
		'section'         => 'footer',
		'type'            => 'text',
	) );

	$wp_customize->add_setting( 'footer_button_url', array(
		'default'           => esc_url( 'https://gretathemes.com/' ),
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'footer_button_url', array(
		'label'   => esc_html__( 'Footer Button URL', 'autodealer' ),
		'section' => 'footer',
		'type'    => 'text',
	) );

	// Footer background.
	$wp_customize->add_setting( 'footer_background', array(
		'sanitize_callback' => 'autodealer_sanitize_image',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'footer',
		array(
			'label'    => esc_html__( 'Footer Image', 'autodealer' ),
			'section'  => 'footer',
			'settings' => 'footer_background',
		)
	) );

	// Footer logo.
	$wp_customize->add_setting( 'footer_logo', array(
		'sanitize_callback' => 'autodealer_sanitize_image',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control(
		$wp_customize,
		'footer',
		array(
			'label'    => esc_html__( 'Footer Logo', 'autodealer' ),
			'section'  => 'footer',
			'settings' => 'footer_logo',
		)
	) );
}
add_action( 'customize_register', 'autodealer_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function autodealer_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function autodealer_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function autodealer_customize_preview_js() {
	wp_enqueue_script( 'autodealer-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'autodealer_customize_preview_js' );

/**
 * Sanitizes Image Upload.
 *
 * @param string $input potentially dangerous data.
 *
 * @return string
 */
function autodealer_sanitize_image( $input ) {
	$filetype = wp_check_filetype( $input );
	if ( $filetype['ext'] && wp_ext2type( $filetype['ext'] ) === 'image' ) {
		return esc_url( $input );
	}

	return '';
}
