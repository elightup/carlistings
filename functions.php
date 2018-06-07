<?php
/**
 * autodealer functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package autodealer
 */

if ( ! function_exists( 'autodealer_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function autodealer_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on autodealer, use a find and replace
		 * to change 'autodealer' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'autodealer', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'autodealer-blog-thumbnail', 770, 450, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'autodealer' ),
			'menu-2' => esc_html__( 'Footer', 'autodealer' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'autodealer_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'autodealer_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function autodealer_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'autodealer_content_width', 640 );
}
add_action( 'after_setup_theme', 'autodealer_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function autodealer_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'autodealer' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'autodealer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Topbar Languages', 'autodealer' ),
		'id'            => 'topbar-languages',
		'description'   => esc_html__( 'Add your languages widget here.', 'autodealer' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'autodealer_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function autodealer_scripts() {

	/**
	 * Register ico font
	 */
	wp_enqueue_style( 'ico-font', get_template_directory_uri() . '/css/icofont.css', array() );

	wp_enqueue_style( 'autodealer-fonts', autodealer_fonts_url() );
	wp_enqueue_style( 'autodealer-style', get_stylesheet_uri() );

	wp_enqueue_script( 'autodealer-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'autodealer-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'script', get_template_directory_uri() . '/js/script.js', array(), '20180506', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'autodealer_scripts' );

/**
 * Get Google fonts URL for the theme.
 *
 * @return string Google fonts URL for the theme.
 */
function autodealer_fonts_url() {
	$fonts   = array();
	$subsets = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'autodealer' ) ) {
		$fonts[] = 'Open Sans:100,300,400,500,700';
	}

	if ( 'off' !== _x( 'on', 'Source Sans Pro font: on or off', 'autodealer' ) ) {
		$fonts[] = 'Source Sans Pro:100,300,400,500,700';
	}

	$fonts_url = add_query_arg( array(
		'family' => rawurlencode( implode( '|', $fonts ) ),
		'subset' => rawurlencode( $subsets ),
	), 'https://fonts.googleapis.com/css' );

	return $fonts_url;
}

/**
 * Implement the Breadcrumbs.
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Implement the extras.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

