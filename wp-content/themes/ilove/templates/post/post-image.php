<?php
	global $post;
	$url = '';
	$url = get_post_meta( $post->ID, 'vm_image', true );
	if ($url == '') {
		$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	}
?>
<?php if ( !empty( $url ) ): ?>
	<div class="media-overlay">
		<span class="fa fa-photo"></span>
	</div>
	<img src="<?php echo esc_url($url); ?>" class="img-responsive" alt="<?php the_title(); ?>">
<?php else: ?>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="media-overlay">
			<span class="fa fa-photo"></span>
		</div>
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
	<?php endif; ?>
<?php endif;