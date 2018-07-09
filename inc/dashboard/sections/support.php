<?php
/**
 * Support section.
 *
 * @package autodealer
 */

?>
<div id="support" class="gt-tab-pane">
	<div class="feature-section two-col">
		<div class="col">
			<h3><?php esc_html_e( 'Contact Support', 'autodealer' ); ?></h3>
			<p><?php esc_html_e( 'Still need help with autodealer? We offer excellent support for you. Open up a ticket and we will get back to you as soon as possible.', 'autodealer' ); ?></p>
			<a class="button button-primary" href="<?php echo esc_url( "https://gretathemes.com/support/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>">Open a ticket</a>
		</div>
		<div class="col">
			<h3><?php esc_html_e( 'More Themes From Us', 'autodealer' ); ?></h3>
			<p>
				<?php
					// Translators: theme name.
					echo esc_html( sprintf( __( 'If you like %s, you might want to see another beautiful themes from ', 'autodealer' ), $this->theme->name ) );
				?>
				<a href="<?php echo esc_url( "https://gretathemes.com/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>">GretaThemes.</a>
				<?php echo esc_html__( ' We build high quality WordPress Themes that are well designed and simple to set up. Check them out here!', 'autodealer' ); ?>
			</p>
			<a class="button button-primary" href="<?php echo esc_url( 'https://gretathemes.com/wordpress-themes/' ); ?>">Visit GretaThemes</a>
		</div>
	</div>
	<h2><?php esc_html_e( 'You Might Also Like', 'autodealer' ); ?></h2>
	<div class="feature-section products three-col">
		<div class="col product">
			<a href="<?php echo esc_url( "https://gretathemes.com/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>" title="<?php echo esc_attr( 'GretaThemes' ); ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/gretathemes.png' ); ?>" alt="gretathemes" width="96" height="96">
			</a>
			<div class="product__body">
				<h3 class="product__title">
					<a href="<?php echo esc_url( "https://gretathemes.com/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>" title="<?php echo esc_attr( 'GretaThemes' ); ?>">GretaThemes</a>
				</h3>
				<p class="product__description">
				<?php
					/* translators: placeholder for HTML */
					printf( esc_html__( 'Modern, clean, responsive %s for all your needs. Fast loading, easy to use and optimized for SEO.', 'autodealer' ), '<strong>premium WordPress themes</strong>' )
				?>
			</div>
		</div>
		<div class="col product">
			<a href="<?php echo esc_url( "https://metabox.io/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>" title="<?php echo esc_attr( 'Meta Box' ); ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/meta-box.png' ); ?>" alt="metabox" width="96" height="96">
			</a>
			<div class="product__body">
				<h3 class="product__title"><a href="<?php echo esc_url( "https://metabox.io/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>" title="<?php echo esc_attr( 'Meta Box' ); ?>">Meta Box</a></h3>
				<p class="product__description">
				<?php
					/* translators: placeholder for HTML */
					printf( esc_html__( 'The lightweight %1$s feature-rich WordPress plugin that helps developers to save time building %2$s.', 'autodealer' ), '&amp;', '<strong>custom meta boxes and custom fields</strong>' )
				?>
			</div>
		</div>
		<div class="col product">
			<a href="<?php echo esc_url( "https://prowcplugins.com/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>" title="<?php echo esc_attr( 'Professional WooCommerce Plugins' ); ?>">
				<img class="product__image" src="<?php echo esc_url( get_template_directory_uri() . '/inc/dashboard/images/prowcplugins.png' ); ?>" alt="prowcplugins" width="96" height="96">
			</a>
			<div class="product__body">
				<h3 class="product__title">
					<a href="<?php echo esc_url( "https://prowcplugins.com/?utm_source=theme_dashboard&utm_medium=product_links&utm_campaign={$this->slug}_dashboard" ); ?>" title="<?php echo esc_attr( 'Professional WooCommerce Plugins' ); ?>">ProWCPlugins</a>
				</h3>
				<p class="product__description">
				<?php
					/* translators: placeholder for HTML */
					printf( esc_html__( 'Professional %s that help you empower your e-commerce sites and grow your business.', 'autodealer' ), '<strong>WordPress plugins for WooCommerce</strong>' )
				?>
			</div>
		</div>
	</div>
</div>
