<?php global $ilove; ?>
<!--Navbar-->
<nav id="cd-vertical-nav">
	<?php
		$menu_name = 'onepage_menu';
		if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			$menu       = wp_get_nav_menu_object( $locations[ $menu_name ] );
			$menu_items = wp_get_nav_menu_items($menu->term_id);
			$menu_list  = '<ul>';

			$dem = 1;
			foreach ( (array) $menu_items as $key => $menu_item ) {
				$title = $menu_item->title;
				$url   = $menu_item->url;
				$menu_list .= '<li class="page-scroll">';
					$menu_list .= '<a href="' . $url . '" data-number="' . $dem . '">';
						$menu_list .= '<span class="cd-dot"></span>';
						$menu_list .= '<span class="cd-label">' . $title . '</span>';
					$menu_list .= '</a>';
				$menu_list .= '</li>';
				$dem++;
			}
			$menu_list .= '</ul>';
		} else {
			$menu_list = '<ul><li>Menu "' . $menu_name . '" not defined.</li></ul>';
		}

		echo $menu_list;
	?>
</nav>
<a class="cd-nav-trigger cd-img-replace"><?php _e( 'Open navigation', 'ilove' ); ?><span></span></a>