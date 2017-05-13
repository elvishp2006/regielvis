<?php
class Ilove_Recent_Posts extends WP_Widget {
	function Ilove_Recent_Posts() {
		$widget_ops = array('classname' => 'Ilove_Recent_Posts', 'description' => 'The recent posts with thumbnails' );
		WP_Widget::__construct('Ilove_Recent_Posts', PLUTON_THEME_NAME.' Recent Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
		$items = empty($instance['items']) ? '2' : apply_filters('widget_number', $instance['items']);
		
		if(!is_numeric($items))
		{
			$items = 2;
		}
		
		if($title){ 
			echo $before_title.$title.$after_title; 
		}
		

		echo '<ul class="recent_posts_list">';
    		
			$args = array( 
				'numberposts' => $items,
				'orderby' => 'ID',
    			'order' => 'DESC',
    		);
			$recent_posts = wp_get_recent_posts( $args );
			foreach( $recent_posts as $recent ){
				echo '<li>';
					echo '<span>';
						echo '<a href="'.get_permalink($recent["ID"]).'">';
							echo get_the_post_thumbnail( $recent["ID"], array('50','50') );
						echo '</a>';
					echo '</span>';
					echo '<a href="'.get_permalink($recent["ID"]).'">'.$recent["post_title"].'</a>';
					echo '<i>'.mysql2date('M j, Y', $recent['post_date']) .'</i>';
				echo '</li>';
			}
		
		echo '</ul>';
		
		echo $after_widget;
		wp_reset_postdata();
		wp_reset_query();
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title'=>'Recent Posts', 'items' => '') );
		$title = strip_tags($instance['title']);
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 2): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Ilove_Recent_Posts');
?>