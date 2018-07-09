<?php
/**
 * Getting started section.
 *
 * @package autodealer
 */

?>
<div id="getting-started" class="gt-tab-pane gt-is-active">
	<div class="feature-section two-col">
		<div class="col">
			<h3><?php esc_html_e( 'Step 1 - Install The Required Plugins', 'autodealer' ); ?></h3>
			<p><?php esc_html_e( 'AutoDealer needs some plugins to working properly. Please install and activate our required plugins.', 'autodealer' ); ?></p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins&plugin_status=install' ) ); ?>">Install Plugins</a>

			<h3><?php esc_html_e( 'Step 2 - Connect Your Site To Jetpack', 'autodealer' ); ?></h3>
			<p><?php esc_html_e( 'AutoDealer uses Jetpack to support testimonial. Connect to Jetpack to use these two features as well as variety of other tools.', 'autodealer' ); ?></p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=jetpack#/dashboard' ) ); ?>">Connect To Jetpack </a>

			<h3><?php esc_html_e( 'Step 3 - Import Demo Data (Optional)', 'autodealer' ); ?></h3>
			<p><?php esc_html_e( 'Import demo data if you want your website exactly the same as our demo.', 'autodealer' ); ?></p>
			<a class="button button-primary" href="<?php echo esc_url( admin_url( 'themes.php?page=pt-one-click-demo-import' ) ); ?>">Import Demo Now</a>
		</div>
		<div class="col">
			<h3><?php esc_html_e( 'Customize The Theme', 'autodealer' ); ?></h3>
			<p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'autodealer' ); ?></p>
			<p>
				<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Start Customize', 'autodealer' ); ?></a>
			</p>
			<h3><?php esc_html_e( 'Read Full Documentation', 'autodealer' ); ?></h3>
			<p class="about"><?php esc_html_e( 'Need any helps to setup and configure the theme? Please check our full documentation for detailed information on how to use it.', 'autodealer' ); ?></p>
			<p>
				<a href="<?php echo esc_url( "https://gretathemes.com/docs/autodealer/?utm_source=theme_dashboard&utm_medium=docs_link&utm_campaign={$this->slug}_dashboard" ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Read Documentation', 'autodealer' ); ?></a>
			</p>
		</div>
	</div>
</div>
