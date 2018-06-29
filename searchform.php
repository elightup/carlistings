<?php
/**
 * The template for displaying custom search form
 *
 * @package autodealer
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'autodealer' ); ?></span>
		<input type="text" class="search-field" placeholder="<?php esc_attr_e( 'Type and Hit Enter ...', 'autodealer' ); ?>" value="<?php the_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit">
		<i class="icofont icofont-search"></i>
		<span class="screen-reader-text"><?php esc_attr_e( 'Search', 'autodealer' ); ?></span>
	</button>
</form>
