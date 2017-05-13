<?php
	/**
	* search.php
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

	<section>
		<div class="container">
			<h2 class="top-title"><?php printf( __( 'Search Results for: %s', 'ilove' ), get_search_query() ); ?></h2>
			<?php if (isset($ilove['blog_switch_breadcrumbs']) && $ilove['blog_switch_breadcrumbs']=='1'): ?>
				<?php if (function_exists('ilove_get_breadcrumbs')): ?>
					<?php ilove_get_breadcrumbs(); ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</section>

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
