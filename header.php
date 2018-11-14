<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CarListings
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'carlistings' ); ?></a>

		<header id="masthead" class="site-header">
			<div class="header-top">
				<div class="container">
					<?php if ( is_active_sidebar( 'topbar-contact' ) ) : ?>
						<div class="topbar-contact">
							<?php dynamic_sidebar( 'topbar-contact' ); ?>
						</div>
					<?php endif; ?>
					<div class="topbar-right">
						<?php if ( function_exists( 'jetpack_social_menu' ) ) : ?>
							<div class="social-media">
								<?php jetpack_social_menu(); ?>
							</div>
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'topbar-languages' ) ) : ?>
							<div class="topbar-languages">
								<?php dynamic_sidebar( 'topbar-languages' ); ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="container">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$carlistings_description = get_bloginfo( 'description', 'display' );
					if ( $carlistings_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $carlistings_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="bar"></span><?php esc_html_e( 'Menu', 'carlistings' ); ?></button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'menu_class'     => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->

		<?php if ( is_front_page() && ! is_home() ) : ?>
			<?php get_template_part( 'template-parts/featured-content' ); ?>
		<?php endif; ?> <!-- featured-cotent -->

		<?php if ( ! is_front_page() ) : ?>
			<div class="page-header">
				<div class="container">
					<?php carlistings_breadcrumbs(); ?>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( is_front_page() && ! is_home() ) : ?>
			<div id="content" class="site-content">
		<?php else : ?>
			<div id="content" class="site-content container">
		<?php endif; ?>
