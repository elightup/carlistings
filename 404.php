<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package autodealer
 */

get_header();
?>

<section id="content" class="content-area">
	<div class="error-404">
		<p><?php esc_html_e( 'It seems like you have tried to open a page that doesn\'t exist. You are welcome to search for what you are looking for with the form below.', 'thefour' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</section>

<?php

get_footer();
