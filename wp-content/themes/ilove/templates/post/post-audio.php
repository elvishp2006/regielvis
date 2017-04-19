<?php $link_audio = get_post_meta( $post->ID, "vm_audio", true ); ?>
<?php if ( !empty( $link_audio ) ) : ?>
	<div class="media-overlay">
		<span class="fa fa-music"></span>
	</div>
	<div class="blog-post-audio">
		<?php echo apply_filters('the_content', $link_audio); ?>
	</div>
<?php else: ?>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="media-overlay">
			<span class="fa fa-photo"></span>
		</div>
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
	<?php endif; ?>
<?php endif;