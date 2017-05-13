<?php
	/*
	 * Register Navigation Menus
	*/
	register_nav_menus(
		array(
			'main_menu'     => __('Main Menu','ilove'),
			'onepage_menu'  => __('Onepage Menu','ilove'),
		)
	);

	if ( !function_exists('ilove_widgets_init')){

		function ilove_widgets_init(){
			/*
			 * Register sidebar
			*/
			register_sidebar(
				array(
					'name'			=> str_replace("_"," ",'Primary Sidebar'),
					'id'			=> 'primary',
					'description'	=> esc_html__( 'This is land of page sidebar','ilove' ),
					'before_title'	=> '<h3 class="widget-title">',
					'after_title'	=> '</h3>',
					'before_widget'	=> '<div  id="%1$s" class="widget %2$s">',
					'after_widget'	=> '</div>',
				)
			);
		}
		add_action( 'widgets_init', 'ilove_widgets_init' );

	}
