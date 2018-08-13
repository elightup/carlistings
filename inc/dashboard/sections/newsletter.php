<?php
/**
 * Newsletter form
 *
 * @package CarListings
 */

?>

<form method="post" action="https://app.zetamail.vn/form.php?form=80" target="_blank" class="newsletter">
	<h3><span class="dashicons dashicons-email-alt"></span> <?php esc_html_e( 'Newsletter', 'carlistings' ); ?></h3>
	<input name="format" value="h" type="hidden">
	<p><?php esc_html_e( 'Subscribe to our newsletter to receive news and tutorials about our themes, our plugins and WordPress. We will never spam you.', 'carlistings' ); ?></p>
	<input name="email" value="" placeholder="joe@gmail.com" required type="email">
	<button class="button button-primary"><?php esc_html_e( 'Subscribe', 'carlistings' ); ?></button>
</form>
