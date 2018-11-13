<?php
/**
 * The template for displaying custom search form
 *
 * @package CarListings
 */

?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php esc_html_e( 'Search for:', 'carlistings' ); ?></span>
		<input type="text" class="search-field" placeholder="<?php esc_attr_e( 'Type and hit Enter...', 'carlistings' ); ?>" value="<?php the_search_query(); ?>" name="s">
	</label>
	<button type="submit" class="search-submit">
		<i class="icofont icofont-search"></i>
		<span class="screen-reader-text"><?php esc_html_e( 'Search', 'carlistings' ); ?></span>
	</button>
</form>
