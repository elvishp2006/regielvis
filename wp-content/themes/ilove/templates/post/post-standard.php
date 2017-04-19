<?php if ( has_post_thumbnail() ): ?>
	<div class="media-overlay">
		<span class="fa fa-photo"></span>
	</div>
	<?php the_post_thumbnail( 'full', array( 'class' => 'img-responsive' ) ); ?>
<?php endif;