<?php
	global $ilove;
	wp_enqueue_script( 'countup' );
?>
<!--Carousel-->
<div class="myCarousel carousel slide carousel-fade">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php if ( !empty( $ilove['home_tem1_gallery'] ) ): ?>
			<?php $home_tem1_gallery = explode(",", $ilove['home_tem1_gallery']); ?>
			<?php for ($i=0; $i < count($home_tem1_gallery); $i++) {
				$active_slide = ($i==0) ? 'active' : '';
			?>
				<li data-target=".myCarousel" data-slide-to="<?php echo esc_attr( $i ); ?>" class="<?php echo esc_attr( $active_slide ); ?>"></li>
			<?php } ?>
		<?php else: ?>
			<li data-target=".myCarousel" data-slide-to="0" class="active"></li>
			<li data-target=".myCarousel" data-slide-to="1"></li>
			<li data-target=".myCarousel" data-slide-to="2"></li>
		<?php endif ?>
	</ol>
	<div class="progressbar"></div>
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<div class="messages">
			<?php if ( !empty( $ilove['home_tem1_title'] ) ): ?>
				<h1 class="slideInDown wow animated" data-wow-delay="0.5s"><?php echo wp_kses_post( $ilove['home_tem1_title'] ); ?></h1>
			<?php endif ?>

			<?php if ( !empty( $ilove['home_tem1_wedding_date'] ) ): ?>
				<div id="time1"></div>
			<?php endif ?>

			<?php if ( !empty( $ilove['home_tem1_desc'] ) ): ?>
				<h4 class="fadeIn wow animated" data-wow-delay="1.2s"><?php echo wp_kses_post( $ilove['home_tem1_desc'] ); ?></h4>
			<?php endif ?>

			<?php if ( !empty( $ilove['home_tem1_button_text'] ) ): ?>
				<div class="btn-special slideInUp wow animated page-scroll" data-wow-delay="0.7s">
					<a href="<?php echo $ilove['home_tem1_button_link']; ?>"><span><?php echo wp_kses_post( $ilove['home_tem1_button_text'] ); ?></span></a>
				</div>
			<?php endif ?>
		</div>

		<?php if ( !empty( $ilove['home_tem1_gallery'] ) ): ?>
			<?php $home_tem1_gallery = explode(",", $ilove['home_tem1_gallery']); ?>
			<?php for ($i=0; $i < count($home_tem1_gallery); $i++) {
				$link_img = wp_get_attachment_image_src( $home_tem1_gallery[$i], 'full' );
				$active_slide = ($i==0) ? ' active' : '';
			?>
				<div class="item<?php echo esc_attr( $active_slide ); ?>">
					<div class="carousel-img" style="background-image:url(<?php echo esc_url( $link_img[0] ); ?>)"></div>
				</div>
			<?php } ?>
		<?php else: ?>
			<div class="item active">
				<div class="carousel-img" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/images/bg-1.jpg)"></div>
			</div>
			<div class="item">
				<div class="carousel-img" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/images/bg-2.jpg)"></div>
			</div>
			<div class="item">
				<div class="carousel-img" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/images/bg-3.jpg)"></div>
			</div>
		<?php endif ?>
	</div>
	<div class="overlay2"></div>

	<?php if ( $ilove['home_tem1_switch_animate'] == 1 ): ?>
		<?php
			wp_enqueue_script( 'fss' );
			wp_enqueue_script( 'geo' );
		?>
		<div id="geo" class="geo"><div id="output" class="geo"></div></div>
	<?php endif ?>

</div>