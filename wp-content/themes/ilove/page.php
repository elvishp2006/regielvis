<?php
	/**
	* page.php
	* The main post loop in Ilove
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/
	get_header();
	the_post();
	global $ilove;
?>

	<section>
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<?php
						the_content();
						wp_link_pages();
					?>
					<?php if(comments_open()) comments_template(); ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</section>

<?php get_footer();