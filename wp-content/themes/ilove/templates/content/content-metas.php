<?php global $ilove; ?>
<ul>
	<li><i class="glyphicon glyphicon-time"></i> <?php the_time( 'd M Y' ); ?></li>
	<li class="text-uppercase"><?php echo __('Posted By', 'ilove'); ?> <a href="<?php echo get_author_posts_url( $post->post_author ); ?>"><?php echo get_the_author_meta('display_name' ); ?></a></li>
	<?php if ( has_category() ): ?>
		<li class="text-uppercase"><?php echo __( 'Category', 'ilove' ); ?> : <?php the_category(', '); ?></li>
	<?php endif; ?>
	<?php if ( comments_open() ): ?>
		<li class="text-uppercase"><a href="#"><a href="<?php comments_link(); ?>"><?php comments_number( __('0 Comments','ilove'), __('1 Comment','ilove'), __('% Comments','ilove') ); ?></a></a></li>
	<?php endif; ?>
</ul>
