<?php
/**
 * Welcome section.
 *
 * @package CarListings
 */

?>
<h1>
	<?php
	// Translators: %1$s - Theme name, %2$s - Theme version.
	echo esc_html( sprintf( __( 'Welcome to %1$s', 'carlistings' ), $this->theme->name, $this->theme->version ) );
	?>
</h1>

<p class="about-rating">
	<?php
	// Translators: theme slug.
	echo wp_kses_post( sprintf( __( 'Please rate us <a href="https://wordpress.org/support/theme/%1$s/reviews/" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> on <a href="https://wordpress.org/support/theme/%1$s/reviews/" target="_blank">WordPress.org</a> to help us spread the word.', 'carlistings' ), $this->slug ) );
	?>
</p>


<div class="about-text"><?php echo esc_html( $this->theme->description ); ?></div>

<a target="_blank" href="<?php echo esc_url( 'https://wpautolistings.com/' . $this->utm ); ?>" class="wp-badge"><?php esc_html_e( 'WP Auto Listings', 'carlistings' ); ?></a>

<p class="about-buttons">
	<a target="_blank" class="button" href="<?php echo esc_url( 'https://wpautolistings.com/support/' . $this->utm ); ?>"><?php esc_html_e( 'Support', 'carlistings' ); ?></a>
</p>
