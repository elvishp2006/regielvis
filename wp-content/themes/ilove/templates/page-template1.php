<?php
	/**
	* Template Name: Home Template 1
	*
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/

	get_header();
		the_post();
		global $post;
?>
	<div class="container">
		<?php
			echo do_shortcode( $post->post_content );
			wp_link_pages();
		?>
	</div>
<?php
	get_footer();