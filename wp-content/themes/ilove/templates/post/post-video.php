<?php $link_video = get_post_meta( $post->ID, "vm_video", true ); ?>
<?php if ( !empty( $link_video ) ) : ?>
	<div class="media-overlay">
		<span class="fa fa-file-video-o"></span>
	</div>
	<div class="blog-post-video embed-container">
		<?php echo apply_filters('the_content', $link_video); ?>
	</div>
<?php else: ?>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="media-overlay">
			<span class="fa fa-photo"></span>
		</div>
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
	<?php endif; ?>
<?php endif;