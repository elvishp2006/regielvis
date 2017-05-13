<?php
	global $ilove;
	if ( is_page_template( 'templates/page-template1.php' ) ) {
		get_template_part( 'templates/header/slide', 'template1' );
	}

	if ( is_page_template( 'templates/page-template2.php' ) ) {
		wp_enqueue_style( 'vertical-nav' );
		get_template_part( 'templates/header/slide', 'template2' );
	}
?>

<!--Navbar-->
<div class="topbar-nav">
	<nav class="navbar navbar-default navbar-custom" role="navigation">
		<div class="container">
			<div class="navbar-header page-scroll">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
					<i class="fa fa-bars"></i>
				</button>
				<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
					<img src="<?php echo esc_url($ilove['general_logo']['url']); ?>" alt="<?php bloginfo('name'); ?>">
				</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-right navbar-main-collapse">
				<?php
					wp_nav_menu(array(
						'theme_location'	=> 'onepage_menu',
						'depth'				=> 3,
						'container'			=> false,
						'items_wrap'		=> '<ul class="nav navbar-nav">%3$s</ul>',
						'fallback_cb'		=> 'ilove_bootstrap_navwalker::fallback',
						'walker'			=> new ilove_bootstrap_navwalker(),
					));
				?>
			</div>
			<!-- /.navbar-collapse -->
		</div>
	</nav>
</div>