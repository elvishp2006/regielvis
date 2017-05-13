<?php

if( !function_exists( 'ilove_get_breadcrumbs' ) ) {

    /*
     * breadcrumbs
    */
    function ilove_get_breadcrumbs()
    {
        $delimiter = '<i class="fa fa-angle-right"></i>';
        $home = 'Home'; // text for the 'Home' link
        $before = '<span class="active_breadcrumbs">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        $return ='';
        $return .= '<div class="breadcrumbs">';

        global $post;
        $homeLink = get_home_url('/');
        $return .= '<a class="root" href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

        if ( is_category() ) {
            global $wp_query;
            $cat_obj = $wp_query->get_queried_object();
            $thisCat = $cat_obj->term_id;
            $thisCat = get_category($thisCat);
            $parentCat = get_category($thisCat->parent);
            if ($thisCat->parent != 0) $return .=(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
            $return .= $before .  single_cat_title('', false) . $after;
        } elseif ( is_day() ) {
            $return .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            $return .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
            $return .= $before . get_the_time('d') . $after;
        } elseif ( is_month() ) {
            $return .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
            $return .= $before . get_the_time('F') . $after;
        } elseif ( is_year() ) {
            $return .= $before . get_the_time('Y') . $after;
        } elseif ( is_single() && !is_attachment() ) {
            if ( get_post_type() != 'post' ) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                $return .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
                $return .= $before . get_the_title() . $after;
            } else {
                $cat = get_the_category(); $cat = $cat[0];
                $return .= ' ' . get_category_parents($cat, TRUE, ' ' . $delimiter . ' ') . ' ';
                $return .= $before . get_the_title() . $after;
            }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            $return .= $before . 'search' . $after;
        } elseif ( is_attachment() ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id    = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) $return .= ' ' . $crumb . ' ' . $delimiter . ' ';
            $return .= $before . get_the_title() . $after;
        } elseif ( is_page() && !$post->post_parent ) {
            $return .= $before . get_the_title() . $after;
        } elseif ( is_page() && $post->post_parent ) {
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id    = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            foreach ($breadcrumbs as $crumb) $return .= ' ' . $crumb . ' ' . $delimiter . ' ';
            $return .= $before . get_the_title() . $after;
        } elseif ( is_search() ) {
            $return .= $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif ( is_tag() ) {
            $return .= $before . 'Archive by tag "' . single_tag_title('', false) . '"' . $after;
        } elseif ( is_author() ) {
            global $author;
            $userdata = get_userdata($author);
            $return .= $before . 'Articles posted by "' . $userdata->display_name . '"' . $after;
        } elseif ( is_404() ) {
            $return .= $before . 'You got it "' . 'Error 404 not Found' . '"&nbsp;' . $after;
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ' (';
                $return .= ('Page') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $return .= ')';
        }
        $return .= '</div>';

        echo $return;
    }


}



if( !function_exists( 'ilove_favicon' ) ) {

    /*
     * favicon
    */
    function  ilove_favicon()
    {
        if ( ! function_exists( 'wp_site_icon' ) || ! has_site_icon() ) {
            global $ilove;
            $favicon = $ilove['general_favicon']['url'];
            if ( $favicon ) {
                echo '<link rel="shortcut icon" href="'.$favicon.'" />',"\n";
            }
        }
    }
    add_action('wp_head','ilove_favicon',2);

}


if( !function_exists( 'ilove_header_metas' ) ) {

    /*
     * header metas
    */
    function ilove_header_metas()
    {
        echo '<meta name="viewport" content="width=device-width">'."\n";
        echo '<link rel="apple-touch-icon-precomposed" href="apple-touch-icon.png">'."\n";
        echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-57x57.png" />'."\n";
        echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="apple-touch-icon-72x72.png" />'."\n";
        echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="apple-touch-icon-114x114.png" />'."\n";
    }
    add_action('wp_head', 'ilove_header_metas',1);

}


if( !function_exists( 'ilove_get_tracking_code' ) ) {

    /*
     * Get tracking code
    */
    function ilove_get_tracking_code()
    {
    	global $ilove;

    	$return ='';
        if( $ilove['general_js_code'] ) {
            $return .= stripslashes($ilove['general_js_code']);
        }

    	echo  '<script type="text/javascript">'.$return.'</script>';
    }
    add_action('wp_head','ilove_get_tracking_code');

}


if( !function_exists( 'ilove_ie_js' ) ) {

    /*
     * ie script
    */
    function ilove_ie_js()
    {
        preg_match('/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches);
        if ( count( $matches )>1 ){
            //Then we're using IE
            $version = $matches[1];

            switch(true){
                case ($version<=8):
                    echo '<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em>Upgrade to a different browser or install Google Chrome Frame to experience this site.</p><![endif]-->';
                break;
                case ($version<=9):
                    // Jquery html5.js
                    wp_register_script( 'html5.js.min.js', PLUTON_JS. '/html5shiv.js', false, PLUTON_THEME_VERSION ,true);
                    wp_enqueue_script('html5.js.min.js');
                break;
                case ($version=7):
                    wp_register_script( 'icons-lte-ie7', PLUTON_JS. '/fonts/Simple-Line-Icons/icons-lte-ie7.js', false, PLUTON_THEME_VERSION ,true);
                    wp_enqueue_script('icons-lte-ie7');
                break;
                case ($version=8):
            ?>
                    <!--[if lt IE 8]>
                    <style>
                    /* For IE < 8 (trigger haslayout) */
                    .clearfix {
                    zoom:1;
                    }
                    8="" (trigger="" haslayout)="" */="" .clearfix="" {="" zoom:1;="" }=""></ 8 (trigger haslayout) */
                    .clearfix {
                    zoom:1;
                    }
                    ></style>
                    <![endif]-->

            <?php
                break;
                default:
                //You get the idea
            }
        }
    }
    add_action('wp_head', 'ilove_ie_js');

}


if( !function_exists( 'ilove_wp_title' ) ) {

    /*
     * WP title
    */
    function ilove_wp_title( $title, $separator )
    {
    	if ( is_feed() )
    		return $title;

    	global $paged, $page;

    	if ( is_search() ) {
    		$title = sprintf( esc_html__( 'Search results for %s', 'ilove' ), '"' . get_search_query() . '"' );
    		if ( $paged >= 2 )
    			$title .= " $separator " . sprintf( esc_html__( 'Page %s', 'ilove' ), $paged );
    			$title .= " $separator " . get_bloginfo( 'name', 'display' );
    		return $title;
    	}

    	$title .= get_bloginfo( 'name', 'display' );

    	$site_description = get_bloginfo( 'description', 'display' );
    	if ( $site_description && ( is_home() || is_front_page() ) )
    		$title .= " $separator " . $site_description;

    	if ( $paged >= 2 || $paged >= 2 )
    		$title .= " $separator " . sprintf( esc_html__( 'Page %s', 'ilove' ), max( $paged, $page ) );

    	return $title;
    }
    add_filter( 'wp_title', 'ilove_wp_title', 10, 2 );

}


if( !function_exists( 'ilove_get_user_browser' ) ) {

    /*
     * Get User browser
    */
    function ilove_get_user_browser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $ub = '';
        if(preg_match('/MSIE/i',$u_agent)) {
            $ub = "ie";
        } elseif (preg_match('/Firefox/i',$u_agent)) {
            $ub = "firefox";
        } elseif (preg_match('/Safari/i',$u_agent)) {
            $ub = "safari";
        } elseif(preg_match('/Chrome/i',$u_agent)) {
            $ub = "chrome";
        } elseif(preg_match('/Flock/i',$u_agent)) {
            $ub = "flock";
        } elseif(preg_match('/Opera/i',$u_agent)) {
            $ub = "opera";
        }

        return $ub;
    }

}


if( !function_exists( 'ilove_search_form' ) ) {

    /*
     * Filter Search form
    */
    function ilove_search_form( $form ) {

        $form = '
            <form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '" >
                <input type="text" value="" placeholder="Search.." class="search" id="s" name="s">
                <button type="submit" id="submit_btn" class="search-submit"><i class="fi-magnifying-glass small"></i> </button>
            </form>
        ';

        return $form;
    }
    add_filter( 'get_search_form', 'ilove_search_form' );

}


if( !( function_exists('ilove_pagination') ) ){

    /*
     * function pahgination
    */
    function ilove_pagination($pages = '', $range = 2){
        $showitems = ($range * 2)+1;

        global $paged;
        if(empty($paged)) $paged = 1;

        if($pages == ''){
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages) {
                $pages = 1;
            }
        }

        $output = '';

        if( 1 != $pages ){
            $output .= '<div class="pagination">';
                $output .= '<ul class="list-inline">';
                    if ($paged > 1) {
                        $output.= '<li>'.get_previous_posts_link( '<i class="fa fa-angle-double-left"></i>' ).'</li>';
                    } else {
                        $output.= '<li class="disabled"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>';
                    }

                    for ($i=1; $i <= $pages; $i++){
                        if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
                            $output .= ($paged == $i)? "<li class='active'><a href='".get_pagenum_link($i)."'>".$i."</a></li> ":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li> ";
                        }
                    }

                    if ($paged < $pages) {
                        $output.= '<li>'.get_next_posts_link( '<i class="fa fa-angle-double-right"></i>' ).'</li>';
                    } else {
                        $output.= '<li class="disabled"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>';
                    }
                $output.= '</ul>';
            $output.= '</div>';
        }

        return $output;
    }

}


if (!function_exists('ilove_remove_excerpt_more')) {

    function ilove_remove_excerpt_more( $more ) {
        return '...';
    }
    add_filter('excerpt_more', 'ilove_remove_excerpt_more');

}


/*-----------------------------------------------------------------------------------*/
/*  Get tiwtter feed
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'ilove_get_twitter_feed' ) ) {

	function ilove_get_twitter_feed( $twitter_username, $twitter_number, $twitter_api_key, $twitter_api_secret ) {
        $ilove_rd_twitter = ilove_random_string( 20 );
		$ilove_trans_name = 'list_tweets_'.$ilove_rd_twitter;
		$ilove_cache_time = 10;

        // Get info from themeoptions
        $username         = $twitter_username;
        $number_tweet     = $twitter_number;
        $ilove_api_key    = $twitter_api_key;
        $ilove_api_secret = $twitter_api_secret;

        // Set value access token and access token secret
		$ilove_access_token = '314733893-fLpPpTolscai93ruNd5Eo4kSpquBfSFP6yXL0MV3';
		$ilove_access_token_secret = '3AghSVtzEiz9nnCR86mUMExj3EEGtgdXwWVOL3s0';

		if( false === ( $ilove_twitter_data = get_transient( $ilove_trans_name ) ) ) {

			$ilove_token = get_option('cfTwitterToken_'.$ilove_rd_twitter);

			// get a new token anyways
			delete_option( 'cfTwitterToken_'.$ilove_rd_twitter );

			// getting new auth bearer only if we don't have one
			if( !$ilove_token ) {
				// preparing credentials
				$ilove_credentials = $ilove_api_key . ':' . $ilove_api_secret;
				$ilove_to_send = base64_encode( $ilove_credentials );

				// http post arguments
				$ilove_args = array(
					'method'      => 'POST',
					'httpversion' => '1.1',
					'blocking'    => true,
					'headers'     => array(
						'Authorization' => 'Basic ' . $ilove_to_send,
						'Content-Type'  => 'application/x-www-form-urlencoded;charset=UTF-8'
					),
					'body' => array( 'grant_type' => 'client_credentials' )
				);

				add_filter('https_ssl_verify', '__return_false');
				$ilove_response = wp_remote_post('https://api.twitter.com/oauth2/token', $ilove_args);

				$ilove_keys = json_decode( wp_remote_retrieve_body( $ilove_response ) );

				if($ilove_keys) {
					// saving token to wp_options table
					update_option('cfTwitterToken_'.$ilove_rd_twitter, $ilove_keys->access_token);
					$ilove_token = $ilove_keys->access_token;
				}
			}

			// we have bearer token wether we obtained it from API or from options
			$ilove_args = array(
				'httpversion' => '1.1',
				'blocking'    => true,
				'headers'     => array(
					'Authorization' => "Bearer $ilove_token"
				)
			);

			add_filter('https_ssl_verify', '__return_false');
			$ilove_api_url  = 'https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name='.$username.'&count='.$number_tweet;
			$ilove_response = wp_remote_get($ilove_api_url, $ilove_args);

			set_transient($ilove_trans_name, wp_remote_retrieve_body($ilove_response), 60 * $ilove_cache_time);
		}
		@$ilove_twitter_feed_data = json_decode(get_transient($ilove_trans_name), true);

		return $ilove_twitter_feed_data;
	}

}

/*-----------------------------------------------------------------------------------*/
/*  Generate a random string A-Z, 0-9
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'ilove_random_string' ) ) {

	function ilove_random_string( $ilove_length = 10 ) {
		$ilove_str = "";
		$ilove_characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$ilove_max = count($ilove_characters) - 1;
		for ($i = 0; $i < $ilove_length; $i++) {
			$rand = mt_rand(0, $ilove_max);
			$ilove_str .= $ilove_characters[$rand];
		}

		return $ilove_str;
	}

}


/*-----------------------------------------------------------------------------------*/
/*  Convert time
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'ilove_time_ago' ) ) {

	function ilove_time_ago($ilove_time) {
		$ilove_periods = array(
			__( 'second', 'ilove' ),
			__( 'minute', 'ilove' ),
			__( 'hour', 'ilove' ),
			__( 'day', 'ilove' ),
			__( 'week', 'ilove' ),
			__( 'month', 'ilove' ),
			__( 'year', 'ilove' ),
			__( 'decade', 'ilove' )
		);

		$ilove_periods_plural = array(
			__( 'seconds', 'ilove' ),
			__( 'minutes', 'ilove' ),
			__( 'hours', 'ilove' ),
			__( 'days', 'ilove' ),
			__( 'weeks', 'ilove' ),
			__( 'months', 'ilove' ),
			__( 'years', 'ilove' ),
			__( 'decades', 'ilove' )
		);

		$ilove_lengths = array( '60', '60', '24', '7', '4.35', '12', '10' );
		$ilove_now = time();
		$ilove_difference = $ilove_now - $ilove_time;
		$ilove_tense = __( 'ago', 'ilove' );

		for( $j = 0; $ilove_difference >= $ilove_lengths[$j] && $j < count( $ilove_lengths )-1; $j++ ) {
			$ilove_difference /= $ilove_lengths[$j];
		}

		$ilove_difference = round( $ilove_difference );

		if( $ilove_difference != 1 ) {
			$ilove_periods[$j] = $ilove_periods_plural[$j];
		}

		return sprintf('%s %s %s', $ilove_difference, $ilove_periods[$j], $ilove_tense);
	}

}
