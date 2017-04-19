<?php
	/**
	 * Pluton Framework functions and definitions.
	 *
	 * @package WordPress
	 * @subpackage Pluton.Net
	 * @since Pluton Framework 1.0
	*/

	if ( ! isset( $content_width ) ) {
		$content_width = 1170;
	}

	/**
	 * Sets up theme defaults and registers the various WordPress features that
	 * Pluton Framework supports.
	 *
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_editor_style() To add a Visual Editor stylesheet.
	 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
	 * 	custom background, and post formats.
	 * @uses register_nav_menu() To add support for navigation menus.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since Pluton Framework 1.0
	*/
	if( !function_exists( 'ilove_setup_theme' ) ) {

		/*
		 * setup text domain and style
		*/
		function ilove_setup_theme()
		{

			load_theme_textdomain( 'ilove', get_template_directory() . '/languages' );
			add_editor_style();
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'post-formats', array(  'image', 'gallery','video','audio' ) );
			add_theme_support( 'woocommerce' );
			add_theme_support( 'title-tag' );
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'custom-background' );
			add_theme_support( 'custom-header' );

		}
		add_action( 'after_setup_theme', 'ilove_setup_theme' );

	}

	/**
	* Add more thumbnail size theme support
	*/
	if( !function_exists( 'ilove_add_thumbnail_size' ) ) {

		/*
		 * Add thumb size image when upload
		*/
		function ilove_add_thumbnail_size($thumb_size){
			foreach ($thumb_size['imgSize'] as $sizeName => $size)
			{
				if($sizeName == 'base')
				{
					set_post_thumbnail_size($thumb_size['imgSize'][$sizeName]['width'], $thumb_size[$sizeName]['height'], true);
				} else {
					add_image_size(
						$sizeName,
						$thumb_size['imgSize'][$sizeName]['width'],
						$thumb_size['imgSize'][$sizeName]['height'],
						true
					);
				}
			}
		}

		$thumb_size['imgSize']['ilove-thumb']  = array('width'=>57,  'height'=>57);
		$thumb_size['imgSize']['ilove-small']  = array('width'=>260, 'height'=>260);
		$thumb_size['imgSize']['ilove-medium'] = array('width'=>520, 'height'=>280);
		$thumb_size['imgSize']['ilove-large']  = array('width'=>319, 'height'=>319);

		ilove_add_thumbnail_size($thumb_size);

	}


	if( !function_exists( 'ilove_load_scripts_styles_default' ) ) {

		/**
		 * Enqueues scripts and styles for front-end.
		 *
		 * @since Pluton Framework 1.0
		 */
		function ilove_load_scripts_styles_default() {
			global $wp_styles;

			/*
			 * Adds JavaScript to pages with the comment form to support
			 * sites with threaded comments (when in use).
			 */
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
				wp_enqueue_script( 'comment-reply' );

			// IE style

			wp_enqueue_style( 'pluton-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'pluton-style' ), '30042013' );
			$wp_styles->add_data( 'pluton-ie', 'conditional', 'lt IE 9' );
		}
		add_action( 'wp_enqueue_scripts', 'ilove_load_scripts_styles_default' );

	}


	if(!( function_exists('ilove_comment') )){

		/*
		 * Function comment
		*/
		function ilove_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
	?>
		<div class="cf" id="comment-<?php comment_ID() ?>">
			<div class="avatar-author">

				<?php echo get_avatar( $comment->comment_author_email, 90 ); ?>

			</div>
			<div class="cmt-ct">
				<h3><?php echo get_comment_author_link() ?></h3>
				<span class="info"><?php echo get_comment_date(); ?></span>
				<?php echo wpautop( get_comment_text() ); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'ilove' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link( __( 'Edit', 'ilove' ), '<p class="edit-link">', '</p>' ); ?>
				<?php if ($comment->comment_approved == '0') : ?>
					<p><em><?php esc_html_e('Your comment is awaiting moderation.', 'ilove') ?></em></p>
				<?php endif; ?>

			</div>
		</div>
	<?php
		}

	}

	if ( ! function_exists( 'ilove_entry_meta' ) ) {

		/**
		 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
		 *
		 * Create your own ilove_entry_meta() to override in a child theme.
		 *
		 * @since Pluton Framework 1.0
		 */
		function ilove_entry_meta() {
			// Translators: used between list items, there is a space after the comma.
			$categories_list = get_the_category_list( __( ', ', 'ilove' ) );

			// Translators: used between list items, there is a space after the comma.
			$tag_list = get_the_tag_list( '', __( ', ', 'ilove' ) );

			$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
				esc_url( get_permalink() ),
				esc_attr( get_the_time() ),
				esc_attr( get_the_date( 'c' ) ),
				esc_html( get_the_date() )
			);

			$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'ilove' ), get_the_author() ) ),
				get_the_author()
			);

			// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
			if ( $tag_list ) {
				$utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'ilove' );
			} elseif ( $categories_list ) {
				$utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'ilove' );
			} else {
				$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'ilove' );
			}

			printf(
				$utility_text,
				$categories_list,
				$tag_list,
				$date,
				$author
			);
		}

	}

	// Define constant
	$get_theme = wp_get_theme();

	define('PLUTON_THEME_NAME', $get_theme);
	define('PLUTON_THEME_VERSION', '1.0');
	define('PLUTON_THEME_SLUG', 'ilove');
	define('PLUTON_BASE_URL', get_template_directory_uri());
	define('PLUTON_BASE', get_template_directory());
	define('PLUTON_LIBRARIES', PLUTON_BASE . '/framework');
	define('PLUTON_LOOP', PLUTON_BASE . '/loop/');
	define('PLUTON_WIDGET', PLUTON_BASE . '/framework/widgets/');
	define('PLUTON_FUNCTIONS', PLUTON_BASE . '/framework');
	define('PLUTON_OPTION', PLUTON_BASE . '/framework/core');
	define('PLUTON_API', PLUTON_FUNCTIONS . '/apis');
	define('PLUTON_JS', PLUTON_BASE_URL . '/assets/js');
	define('PLUTON_CSS', PLUTON_BASE_URL . '/assets/css');
	define('PLUTON_IMAGES', PLUTON_BASE_URL . '/assets/images');
	define('PLUTON_IMG', PLUTON_BASE_URL . '/assets/img');
	define('PLUTON_TEMPLATE', PLUTON_BASE_URL . '/page-templates');
	define('PLUTON_THEME_LIBS_URL', PLUTON_BASE_URL . '/framework');
	define('PLUTON_THEME_OPTION_URL', PLUTON_BASE_URL . '/framework/core');