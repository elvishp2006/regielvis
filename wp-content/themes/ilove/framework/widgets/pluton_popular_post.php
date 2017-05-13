<?php
class Ilove_Popular_Posts extends WP_Widget {
	function Ilove_Popular_Posts() {
		$widget_ops = array('classname' => 'Ilove_Popular_Posts', 'description' => 'The popular posts with thumbnails' );
		WP_Widget::__construct('Ilove_Popular_Posts', PLUTON_THEME_NAME.' Popular Posts', $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
		$items = empty($instance['items']) ? 3 :  $instance['items'];

		echo $before_title.$title.$after_title;

		echo '<ul class="recent_posts_list">';

		$popPosts = new WP_Query();
		$popPosts->query('caller_get_posts=1&showposts='.$items.'&orderby=comment_count');
		while ($popPosts->have_posts()) : $popPosts->the_post(); 
		?>
            <li> 
            	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) : /* if post has post thumbnail */ ?>
            		<span>
            			<a href="<?php the_permalink(); ?>">
                			<?php the_post_thumbnail(array('50', '50')); ?>
                		</a>
            		</span>
            	<?php endif; ?>
            	<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> <i><?php the_time( get_option('date_format') ); ?></i> 
            </li>
            
        <?php endwhile; ?>
        <?php wp_reset_query();

        echo '</ul>';
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array('title'=>'Popular Posts', 'items' => '') );
		$title = strip_tags($instance['title']);
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>">Widget title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('items'); ?>">Items (default 2): <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

register_widget('Ilove_Popular_Posts');
?>