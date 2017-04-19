<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?> id="page-top" data-spy="scroll" data-target=".navbar-custom">
	<?php global $ilove; ?>
	<?php if ( $ilove['style_loading']==1 ): ?>
		<!-- Preloader -->
		<div id="preloader">
			<div class="spinner">
				<div class="rect1"></div>
				<div class="rect2"></div>
				<div class="rect3"></div>
				<div class="rect4"></div>
				<div class="rect5"></div>
			</div>
		</div>
	<?php endif ?>

	<?php get_template_part('templates/header/header', 'style'); ?>