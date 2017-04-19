<?php
	global $post;
	$attachments = get_post_meta( $post->ID, 'vm_gallery', true );
	if ( !empty( $attachments ) ) :
?>
	<div class="media-overlay">
		<span class="icon icolove-gallery"></span>
	</div>
	<div class="owl-blog-post-gallery owl-carousel">
		<?php foreach ( $attachments as $attachment ){ ?>
			<div class="owl-item"><img src="<?php echo esc_url($attachment); ?>" class="img-responsive" alt="<?php get_the_title() ?>"></div>
  		<?php } ?>
    </div>
<?php else: ?>
	<?php if ( has_post_thumbnail() ): ?>
		<div class="media-overlay">
			<span class="fa fa-photo"></span>
		</div>
		<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
	<?php endif; ?>
<?php endif;