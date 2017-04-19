<?php

	if( !function_exists( 'ilove_load_scripts' ) ) {

		/*
		 * Load jQuery
		*/
		function ilove_load_scripts()
		{
			if(!is_admin())
			{
				wp_enqueue_script('jquery');

				$scripts = array(
					'jquery-ui.min',
					'modernizr.custom',
					'bootstrap.min',
					'jquery.easing.min',
					'jquery.sticky',
					'wow.min',
					'custom'
				);

				foreach($scripts as $script){
					wp_enqueue_script( $script, PLUTON_JS . '/'.$script.'.js', false, PLUTON_THEME_VERSION, true );
				}

				if ( !empty( $ilove['home_tem1_wedding_date'] ) ) {
					$wedding_date1 = $ilove['home_tem1_wedding_date'];
				} else {
					$wedding_date1 = '04/24/2016 17:00:00';
				}
				if ( !empty( $ilove['home_tem2_wedding_date'] ) ) {
					$wedding_date2 = $ilove['home_tem2_wedding_date'];
				} else {
					$wedding_date2 = '04/24/2016 17:00:00';
				}
				wp_localize_script( 'custom', 'Ilove', array(
					'wedding_date1' => $wedding_date1,
					'wedding_date2' => $wedding_date2
				));

				wp_register_script( 'jquery.fitvids', PLUTON_JS . '/jquery.fitvids.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'jquery.validate', PLUTON_JS . '/jquery.validate.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'imagesloaded.pkgd.min', PLUTON_JS . '/imagesloaded.pkgd.min.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'masonry.pkgd.min', PLUTON_JS . '/masonry.pkgd.min.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'waypoints.min', PLUTON_JS . '/waypoints.min.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'fss', PLUTON_JS . '/fss.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'geo', PLUTON_JS . '/geo.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'countup', PLUTON_JS . '/countup.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'jquery.countTo', PLUTON_JS . '/jquery.countTo.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'owl.carousel.min', PLUTON_JS . '/owl.carousel.min.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'jquery.magnific-popup.min', PLUTON_JS . '/jquery.magnific-popup.min.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'modernizr.hover', PLUTON_JS . '/modernizr.hover.js', array( 'jquery' ), PLUTON_THEME_VERSION, true );
				wp_register_script( 'map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAw4zoMhjBovBpFofL610c27FI92dOuEs8', array( 'jquery' ), PLUTON_THEME_VERSION, true );

				wp_register_style( 'vertical-nav', PLUTON_CSS.'/vertical-nav.css', false, PLUTON_THEME_VERSION, 'screen');

			}
		}
		add_action('wp_enqueue_scripts','ilove_load_scripts');

	}


	if( !function_exists( 'ilove_load_styles' ) ) {

		/*
		 * Load CSS
		*/
		function ilove_load_styles()
		{

			global $ilove;
			$styles = array(
				'bootstrap.min',
				'font-awesome.min',
				'sample-style',
				'font-ilove',
				'animate',
				'magnific-popup',
				'owl.carousel',
				'owl.theme',
				'style',
				'custom'
			);

			wp_enqueue_style( 'ilove-style', get_stylesheet_uri() );

			foreach($styles as $style){
				$txt_style = str_replace('/', '-', $style);
				wp_enqueue_style( $txt_style, PLUTON_CSS.'/'.$style.'.css', false, PLUTON_THEME_VERSION, 'screen');
			}

		}
		add_action("wp_enqueue_scripts",'ilove_load_styles');

	}


	if(!function_exists('ilove_load_custom_style')){

		/*
		 * Get CSS Custom
		*/
		function ilove_load_custom_style()
		{

			global $ilove;

			$return ='';
			if(isset($ilove['general_css_code'])) {
				$custom_css = $ilove['general_css_code'];
			} else {
				$custom_css = '';
			}
			$return.= $custom_css;

			if ( is_user_logged_in() ) {
				$return.='.fixed-header .navbar-default { top: 32px; }';
			}

			wp_add_inline_style( 'ilove-style', $return );
		}
		add_action( 'wp_enqueue_scripts', 'ilove_load_custom_style' );

	}


	if ( !function_exists('ilove_fonts_url') ) {

		/*
		 * Register Google Fonts
		*/
		function ilove_fonts_url() {
			$fonts_url = '';

			$lato = _x( 'on', 'Lato font: on or off', 'ilove' );

			$great_vibes = _x( 'on', 'Great Vibes font: on or off', 'ilove' );

			if ( 'off' !== $lato || 'off' !== $great_vibes ) {
				$font_families = array();

				if ( 'off' !== $lato ) {
					$font_families[] = 'Lato:400,700';
				}

				if ( 'off' !== $great_vibes ) {
					$font_families[] = 'Great Vibes';
				}

				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) ),
					'subset' => urlencode( 'latin,latin-ext' ),
				);

				$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
			}

			return esc_url_raw( $fonts_url );
		}

	}


	if ( !function_exists('ilove_scripts_styles') ) {

		/*
		 * Enqueue Scripts And Styles.
		*/
		function ilove_scripts_styles() {
			wp_enqueue_style( 'ilove-fonts', ilove_fonts_url(), array(), null );
		}
		add_action( 'wp_enqueue_scripts', 'ilove_scripts_styles' );

	}
