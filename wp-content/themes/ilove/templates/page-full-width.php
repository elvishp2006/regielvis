<?php
	/**
	* Template Name: Fullwidth Template
	*
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/

	get_header();
		the_post();

?>
	<div class="container">
		<?php
			the_content();
			wp_link_pages();
		?>
	</div>
<?php

	get_footer();