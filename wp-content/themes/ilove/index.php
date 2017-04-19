<?php
	/**
	* index.php
	* The main post loop in Ilove
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/
	get_header();
	global $ilove;
	if ( $ilove['blog_switch_layout'] == 1 ) {
		$col_md = 8;
	} else {
		$col_md = 12;
	}
?>

	<!-- Main content -->
	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-<?php echo esc_attr($col_md); ?>">
					<?php get_template_part('templates/content/content', 'list'); ?>
					<?php echo function_exists('ilove_pagination') ? ilove_pagination() : posts_nav_link(); ?>
				</div>

				<?php if ( $ilove['blog_switch_layout'] == 1 ): ?>
					<?php get_sidebar(); ?>
				<?php endif ?>
			</div>
		</div>
	</section>
	<!-- End / Main content -->

<?php get_footer();
