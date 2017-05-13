<?php
	/**
	* Template Name: Home Template 2
	*
	* @author PlutonThemes
	* @package Ilove
	* @since 1.0.0
	*/

	get_header();
	the_post();
	global $ilove;
	$style_bg = '';
	if ( !empty( $ilove['home_tem2_image']['url'] ) ) {
		$style_bg = 'background-image: url('. $ilove['home_tem2_image']['url'] .')';
	}
?>

	<!--Main Header-->
	<div class="overlay2"></div>
	<div class="wedding" style="<?php echo $style_bg ? $style_bg : ''; ?>">
		<?php if ( !empty( $ilove['home_tem2_title'] ) ): ?>
			<h2 class="slideInDown wow" data-wow-delay="0.5s"><?php echo $ilove['home_tem2_title']; ?></h2>
		<?php endif ?>
		<?php if ( !empty( $ilove['home_tem2_wedding_date'] ) ): ?>
			<?php wp_enqueue_script( 'countup' ); ?>
			<div class="time" id="time2"></div>
		<?php endif ?>
		<?php if ( !empty( $ilove['home_tem2_desc'] ) ): ?>
			<h4 class="fadeIn wow animated" data-wow-delay="1.2s"><?php echo $ilove['home_tem2_desc']; ?></h4>
		<?php endif ?>
		<?php if ( !empty( $ilove['home_tem2_button_text'] ) ): ?>
			<div class="btn-special slideInUp wow animated page-scroll" data-wow-delay="0.7s">
				<a href="<?php echo $ilove['home_tem2_button_link']; ?>"><span><?php echo $ilove['home_tem2_button_text']; ?></span></a>
			</div>
		<?php endif ?>
	</div>

	<div class="container">
		<?php
			the_content();
			wp_link_pages();
		?>
	</div>
<?php

	get_footer();