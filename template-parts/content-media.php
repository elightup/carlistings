<?php
/**
 * Display an optional post thumbnail, video, gallery in according to post formats
 * above the post excerpt in the archive page.
 *
 * @package autodealer
 */

if ( has_post_format( array( 'video', 'audio' ) ) ) {
	$main_content = apply_filters( 'the_content', get_the_content() );
	$media        = get_media_embedded_in_content(
		$main_content, array(
			'video',
			'audio',
			'object',
			'embed',
			'iframe',
		)
	);

	if ( $media ) {
		echo '<div class="entry-media">' . reset( $media ) . '</div>'; /* WPCS: xss ok. */

		return;
	}
}

if ( get_post_gallery() ) {
	$gallery = get_post_gallery( get_the_id(), false );
	if ( $gallery['ids'] ) {
		$gallery_id = explode( ',', $gallery['ids'] );
		?>
		<div class="entry-media">
			<div class="grid-gallery owl-carousel">
				<?php
				foreach ( $gallery_id as $id ) :
				?>
					<?php echo wp_get_attachment_image( $id, 'post-thumbnail' ); ?>
				<?php
				endforeach;
				?>
			</div>
		</div>
		<?php
	}
	return;
}

if ( ! has_post_thumbnail() ) {
	return;
}
?>

<div class="entry-media">
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'autodealer-blog-thumbnail' ); ?>
	</a>
</div>
