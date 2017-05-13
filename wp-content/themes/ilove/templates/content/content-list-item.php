<?php
	global $ilove;
	$format = get_post_format();
	if( false === $format ){
		$format = 'standard';
	}
?>
<div <?php post_class(); ?>>
	<div class="blog-post wow fadeInUp" data-wow-delay="0.7s">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php if ( $ilove['blog_switch_meta'] == 1 ): ?>
			<?php get_template_part('template/content/content', 'metas'); ?>
		<?php endif; ?>

		<div class="blog-post-media">
			<?php get_template_part( 'template/post/post', $format ); ?>
			<?php the_excerpt(); ?>
			<?php if ( !empty( $ilove['blog_continue_reading'] ) ): ?>
				<div class="btn-normal">
					<a href="<?php the_permalink(); ?>"><span><?php echo $ilove['blog_continue_reading']; ?></span></a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
