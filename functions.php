<?php
/**
 * Carlistings functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package CarListings
 */

if ( ! function_exists( 'carlistings_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function carlistings_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on carlistings, use a find and replace
		 * to change 'carlistings' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'carlistings', get_template_directory() . '/languages' );

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
		set_post_thumbnail_size( 770, 420, true );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'carlistings' ),
				'menu-2' => esc_html__( 'Footer', 'carlistings' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 300,
				'width'       => 67,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_post_type_support( 'page', 'excerpt' );
	}
endif;
add_action( 'after_setup_theme', 'carlistings_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function carlistings_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'carlistings_content_width', 770 );
}
add_action( 'after_setup_theme', 'carlistings_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function carlistings_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'carlistings' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'carlistings' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Topbar Contact', 'carlistings' ),
			'id'            => 'topbar-contact',
			'description'   => esc_html__( 'Add your contact widget here.', 'carlistings' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_sidebar(
		array(
			'name'          => esc_html__( 'Topbar Languages', 'carlistings' ),
			'id'            => 'topbar-languages',
			'description'   => esc_html__( 'Add your language widget here.', 'carlistings' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	register_widget( 'Carlistings_Contact_Widget' );
}
add_action( 'widgets_init', 'carlistings_widgets_init' );

/**
 * Enqueue plugins scripts and styles first.
 */
function carlistings_plugin_scripts() {
	if ( is_front_page() ) {
		wp_enqueue_style( 'car-listings-listing-css', get_template_directory_uri() . '/css/auto-listings.css', array(), '1.0.0' );
		wp_enqueue_script( 'sumoselect', get_template_directory_uri() . '/js/sumoselect.js', array(), '3.0.3', true );
	}
}
add_action( 'wp_enqueue_scripts', 'carlistings_plugin_scripts', 0 );

/**
 * Enqueue scripts and styles.
 */
function carlistings_scripts() {
	wp_enqueue_style( 'icofont', get_template_directory_uri() . '/css/icofont.css', array(), '1.0.0' );

	wp_enqueue_style( 'carlistings-fonts', carlistings_fonts_url(), array(), '1.0.0' );
	wp_enqueue_style( 'carlistings-style', get_stylesheet_uri(), array(), '1.0.0' );

	wp_enqueue_script( 'carlistings-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'carlistings-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.js', array( 'jquery' ), '1.8.0', true );
	wp_enqueue_script( 'carlistings-script', get_template_directory_uri() . '/js/script.js', array( 'slick' ), '1.0', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$list_grid_view = array(
		'list_grid_view' => auto_listings_option( 'list_grid_view' ),
	);
	if ( is_front_page() ) {
		wp_localize_script( 'carlistings-script', 'auto_listings', $list_grid_view );
	}
}
add_action( 'wp_enqueue_scripts', 'carlistings_scripts', 99 );

/**
 * Get Google fonts URL for the theme.
 *
 * @return string Google fonts URL for the theme.
 */
function carlistings_fonts_url() {
	$fonts   = array();
	$subsets = 'latin,latin-ext';

	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'carlistings' ) ) {
		$fonts[] = 'Open Sans:300,400,600,700,800';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'carlistings' );

	if ( 'cyrillic' === $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' === $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' === $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' === $subset ) {
		$subsets .= ',vietnamese';
	}

	$fonts_url = add_query_arg(
		array(
			'family' => rawurlencode( implode( '|', $fonts ) ),
			'subset' => rawurlencode( $subsets ),
		),
		'https://fonts.googleapis.com/css'
	);

	return $fonts_url;
}

/**
 * Add editor style.
 */
function carlistings_add_editor_styles() {
	add_editor_style(
		array(
			'css/editor-style.css',
			carlistings_fonts_url(),
			get_template_directory_uri() . '/css/icofont.css',
		)
	);
}
add_action( 'init', 'carlistings_add_editor_styles' );


/**
 * Include widget file
 */
require get_template_directory() . '/inc/widgets/class-carlistings-contact-widget.php';

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

if ( is_admin() ) {
	require_once get_template_directory() . '/inc/admin/class-tgm-plugin-activation.php';
	require_once get_template_directory() . '/inc/admin/plugins.php';

	/**
	 * Dashboard.
	 */
	require get_template_directory() . '/inc/dashboard/class-carlistings-dashboard.php';
	new Carlistings_Dashboard();
}

/**
 * Customizer Pro.
 */
require get_template_directory() . '/inc/customizer-pro/class-carlistings-customizer-pro.php';
$customizer_pro = new Carlistings_Customizer_Pro();
$customizer_pro->init();
