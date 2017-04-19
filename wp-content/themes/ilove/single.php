<?php
	/**
	* single.php
	* The main post loop in Ilove
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/
	get_header();
	the_post();

	global $ilove;
	$format = get_post_format();
	if( false === $format ){
		$format = 'standard';
	}

	if ( $ilove['blog_single_switch_sidebar'] == 1 ) {
		$col_md = 8;
	} else {
		$col_md = 12;
	}
?>

	<!-- Single post -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr($col_md); ?>">
					<div <?php post_class(); ?>>
						<div class="blog-post wow fadeInUp" data-wow-delay="0.7s">
							<h2><?php the_title(); ?></h2>
							<?php if ( $ilove['blog_single_switch_meta'] == 1 ): ?>
								<?php get_template_part( 'templates/content/content', 'metas' ); ?>
							<?php endif; ?>

							<div class="blog-post-media">
								<?php get_template_part( 'template/post/post', $format ); ?>

								<?php the_content( ); ?>
								<?php
									wp_link_pages( array(
										'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ilove' ) . '</span>',
										'after'       => '</div>',
										'link_before' => '<span>',
										'link_after'  => '</span>',
									) );
								?>

								<?php if ( $ilove['blog_single_switch_autho'] == 1 ): ?>
									<div class="post-author clearfix">
		                            	<?php echo get_avatar( get_the_author_meta( 'user_email' ), 100 ); ?>
		                                <div class="author-details">
		                                    <h4><?php echo get_the_author(); ?></h4>
		                                    <span><?php the_author_meta( 'description' ); ?></span>
		                                </div>
		                            </div>
								<?php endif; ?>
							</div>

							<?php
								if( comments_open() ){
									comments_template();
								}
							?>
						</div>
					</div>
				</div>

				<?php if ( $ilove['blog_single_switch_sidebar'] == 1 ): ?>
					<?php get_sidebar(); ?>
				<?php endif ?>
			</div>
		</div>
	</section>
	<!-- End / Single post -->

<?php get_footer();
