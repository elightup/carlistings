<?php
/**
 * Welcome section.
 *
 * @package Autodealer
 */

?>
<h1>
	<?php
	// Translators: %1$s - Theme name, %2$s - Theme version.
	echo esc_html( sprintf( __( 'Welcome to %1$s', 'autodealer' ), $this->theme->name, $this->theme->version ) );
	?>
</h1>

<p class="about-rating">
	<?php
	// Translators: theme slug.
	echo wp_kses_post( sprintf( __( 'Please rate us <a href="https://wordpress.org/support/theme/%1$s/reviews/?filter=5" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="https://wordpress.org/support/theme/%1$s/reviews/?filter=5" target="_blank">WordPress.org</a> to help us spread the word. Thank you from GretaThemes!', 'autodealer' ), $this->lite_slug ) );
	?>
</p>


<div class="about-text"><?php echo esc_html( $this->theme->description ); ?></div>

<a target="_blank" href="<?php echo esc_url( 'https://gretathemes.com/' . $this->utm ); ?>" class="wp-badge"><?php esc_html_e( 'GretaThemes', 'autodealer' ); ?></a>

<p class="about-buttons">
	<a target="_blank" class="button" href="<?php echo esc_url( 'https://gretathemes.com/support/' . $this->utm ); ?>"><?php esc_html_e( 'Support', 'autodealer' ); ?></a>
	<a target="_blank" class="button" href="https://www.facebook.com/sharer/sharer.php?u=https%3A//www.facebook.com/gretathemes/"><span class="dashicons dashicons-facebook-alt"></span><?php esc_html_e( ' Share', 'autodealer' ); ?></a>
	<a target="_blank" class="button" href="https://twitter.com/home?status=Free%20and%20Premium%20WordPress%20Themes%20https%3A//gretathemes.com/%20via%20%40gretathemes"><span class="dashicons dashicons-twitter"></span><?php esc_html_e( ' Tweet', 'autodealer' ); ?></a>
</p>
