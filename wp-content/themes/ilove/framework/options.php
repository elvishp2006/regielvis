<?php
/**
 *ReduxFramework Sample Config File
 *For full documentation, please visit: https://docs.reduxframework.com
**/

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
         *This is a test function that will let you see when the compiler hook occurs.
         *It only runs if a field   set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
        }

        /**
         *Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         *Simply include this function in the child themes functions.php file.
         *NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         *so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
         *Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
         *Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
            }
        }

        public function setSections() {

            /**
             *Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns        = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct             = wp_get_theme();
            $this->theme    = $ct;
            $item_name      = $this->theme->get('Name');
            $tags           = $this->theme->Tags;
            $screenshot     = $this->theme->get_screenshot();
            $class          = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework'), $this->theme->display('Name'));

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'ilove'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'ilove'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'ilove') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();

                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            /*--General Settings--*/
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Settings', 'ilove'),
                'fields' => array(
                    array(
                        'id'    => 'general_introduction',
                        'type'  => 'info',
                        'style' => 'success',
                        'title' => __('Welcome to Ilove Theme Option Panel', 'ilove'),
                        'icon'  => 'el-icon-info-sign',
                        'desc'  => __( 'From here you can config Ilove theme in the way you need.', 'ilove')
                    ),
                    array(
                        'id' => 'general_logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Logo Upload', 'ilove'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('Upload your logo image', 'ilove'),
                        'subtitle' => __('Upload your custom logo image', 'ilove'),
                        'default' => array('url' => get_template_directory_uri().'/assets/images/logo.png'),
                        'hint' => array(
                            'title'     => 'Hint Title',
                            'content'   => 'This is a <b>hint</b> for the media field with a Title.',
                        )
                    ),
                    array(
                        'id' => 'general_favicon',
                        'type' => 'media',
                        'title' => __('Upload favicon', 'ilove'),
                        'desc' => __('Upload a 16px x 16px .png or .gif image that will be your favicon.', 'ilove'),
                        'subtitle' => __('Upload your custom favicon image', 'ilove'),
                        'default' => array('url' => get_template_directory_uri().'/assets/images/favicon.ico'),

                    ),
                    array(
                        'id' => 'general_css_code',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS', 'ilove'),
                        'subtitle' => __('Paste your custom CSS code here.', 'ilove'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => 'Custom css code.',
                        'default' => ""
                    ),
                    array(
                        'id' => 'general_js_code',
                        'type' => 'ace_editor',
                        'title' => __('Custom JS ', 'ilove'),
                        'subtitle' => __('Paste your custom JS code here.', 'ilove'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'desc' => 'Custom javascript code',
                        'default' => "jQuery(document).ready(function(){\n\n});"
                    ),
                )
            );


            /*
             * Home Template 1 Settings
            */
            $this->sections[] = array(
                'title' => __('Home Template 1 Settings', 'ilove'),
                'icon' => 'el-icon-website',
                'fields' => array(
                    array(
                        'id' => 'home_tem1_title',
                        'type' => 'textarea',
                        'title' => __('Title', 'ilove'),
                        'desc' => __('Insert title on slide', 'ilove'),
                        'default' => 'Adam <span class="heart pulsing fa fa-heart"></span> Eve'
                    ),
                    array(
                        'id'          => 'home_tem1_wedding_date',
                        'type'        => 'text',
                        'title'       => __('Wedding Day', 'ilove'),
                        'desc'        => __('Insert wedding day same type (month/day/year H:m:s) example: 05/24/2016 15:00:00', 'ilove'),
                        'default'     => '05/24/2016 13:00:00'
                    ),
                    array(
                        'id'          => 'home_tem1_desc',
                        'type'        => 'text',
                        'title'       => __('Description', 'ilove'),
                        'desc'        => __('Insert description on slide', 'ilove'),
                        'default'     => 'In love and counting'
                    ),
                    array(
                        'id'          => 'home_tem1_button_text',
                        'type'        => 'text',
                        'title'       => __('Text Button', 'ilove'),
                        'desc'        => __('Insert text button on slide', 'ilove'),
                        'default'     => 'Discover More'
                    ),
                    array(
                        'id'          => 'home_tem1_button_link',
                        'type'        => 'text',
                        'title'       => __('Link Button', 'ilove'),
                        'desc'        => __('Insert link button on slide', 'ilove'),
                        'default'     => '#about'
                    ),
                    array(
                        'id'       => 'home_tem1_gallery',
                        'type'     => 'gallery',
                        'title'    => __('Add/Edit Slide Gallery', 'ilove'),
                        'desc'     => __('Upload gallery for slide', 'ilove')
                    ),
                    array(
                        'id'       => 'home_tem1_switch_animate',
                        'type'     => 'switch',
                        'title'    => __('Switch On Animate Slide', 'ilove'),
                        'default'  => true
                    )
                ),
            );


            /*
             * Home Template 2 Settings
            */
            $this->sections[] = array(
                'title' => __('Home Template 2 Settings', 'ilove'),
                'icon' => 'el-icon-website',
                'fields' => array(
                    array(
                        'id' => 'home_tem2_title',
                        'type' => 'textarea',
                        'title' => __('Title', 'ilove'),
                        'desc' => __('Insert title on slide', 'ilove'),
                        'default' => 'Getting Married in'
                    ),
                    array(
                        'id'          => 'home_tem2_wedding_date',
                        'type'        => 'text',
                        'title'       => __('Wedding Day', 'ilove'),
                        'desc'        => __('Insert wedding day same type (month/day/year H:m:s) example: 05/24/2016 15:00:00', 'ilove'),
                        'default'     => '05/24/2016 13:00:00'
                    ),
                    array(
                        'id'          => 'home_tem2_desc',
                        'type'        => 'text',
                        'title'       => __('Description', 'ilove'),
                        'desc'        => __('Insert description on slide', 'ilove'),
                        'default'     => 'You Are Invited'
                    ),
                    array(
                        'id'          => 'home_tem2_button_text',
                        'type'        => 'text',
                        'title'       => __('Text Button', 'ilove'),
                        'desc'        => __('Insert text button on slide', 'ilove'),
                        'default'     => 'Discover More'
                    ),
                    array(
                        'id'          => 'home_tem2_button_link',
                        'type'        => 'text',
                        'title'       => __('Link Button', 'ilove'),
                        'desc'        => __('Insert link button on slide', 'ilove'),
                        'default'     => '#our-story'
                    ),
                    array(
                        'id'       => 'home_tem2_image',
                        'type'     => 'media',
                        'url'      => true,
                        'title'    => __('Image Background', 'redux-framework-demo'),
                        'subtitle' => __('Upload image background for main header using the WordPress native uploader', 'ilove'),
                        'default'  => array(
                            'url' => get_template_directory_uri() . '/assets/images/wedding-1.jpg'
                        ),
                    ),
                    array(
                        'id'       => 'home_tem2_switch_nav',
                        'type'     => 'switch',
                        'title'    => __('Switch On Right Menu', 'ilove'),
                        'default'  => true
                    )
                ),
            );


            $this->sections[] = array(
                'title' => __('Style Settings', 'ilove'),
                'icon' => 'el-icon-magic',
                'fields' => array(
                    array(
                        'id'        => 'style_loading',
                        'type'      => 'switch',
                        'title'     => __('Enable Loading Effect', 'ilove'),
                        'subtitle'  => __('Loading Effect', 'ilove'),
                        'default'   => true,
                    ),
                    array(
                        'id'       => 'style_theme_view_color',
                        'type'     => 'select',
                        'title'    => __('Select Theme Color', 'ilove'),
                        'desc'     => __('Select theme Color.', 'ilove'),
                        'options'  => array(
                            'default'    => 'Default',
                            'blue'      => 'Blue',
                            'asparagus' => 'Aspara',
                            'green'     => 'Green',
                            'orange'    => 'Orange',
                            'purple'    => 'Purple',
                            'yellow'    => 'Yellow',
                            'tomato'    => 'Tomato',
                            'teal'      => 'Teal',
                            'pink'      => 'Pink',
                            'lima'      => 'Lima',
                            'turquoise' => 'Turquoise'
                        ),
                        'default'    => 'default',
                    ),
                    array(
                        'id' => 'style_body_background',
                        'type' => 'background',
                        'output' => array('body'),
                        'title' => __('Body Background', 'ilove'),
                        'subtitle' => __('Body background with image, color, etc.', 'ilove'),
                        'default' => array(
                            'background-color' => '#FFFFFF',
                        ),
                    ),
                )
            );


            /*--Typograply Options--*/
            $this->sections[] = array(
                'icon' => 'el-icon-font',
                'title' => __('Typography Options', 'ilove'),
                'fields' => array(
                    array(
                        'id' => 'typograply_body_font',
                        'type' => 'typography',
                        'title' => __('Body Font Setting', 'ilove'),
                        'subtitle' => __('Specify the body font properties.', 'ilove'),
                        'google' => true,
                        'output' => 'body',
                        'default' => array(
                            'font-family' => 'Lato',
                        ),
                    ),
                    array(
                        'id' => 'typograply_menu_font',
                        'type' => 'typography',
                        'title' => __('Menu Item Font Setting', 'ilove'),
                        'subtitle' => __('Specify the menu font properties.', 'ilove'),
                        'output' => array('nav'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                        ),
                    ),
                    array(
                        'id' => 'typograply_h1_font',
                        'type' => 'typography',
                        'title' => __('Heading 1(H1) Font Setting', 'ilove'),
                        'subtitle' => __('Specify the H1 tag font properties.', 'ilove'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Great Vibes',
                        ),
                        'output' => 'h1',
                    ),
                    array(
                        'id' => 'typograply_h2_font',
                        'type' => 'typography',
                        'title' => __('Heading 2(H2) Font Setting', 'ilove'),
                        'subtitle' => __('Specify the H2 tag font properties.', 'ilove'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Great Vibes',
                        ),
                        'output' => 'h2',
                    ),
                    array(
                        'id' => 'typograply_h3_font',
                        'type' => 'typography',
                        'title' => __('Heading 3(H3) Font Setting', 'ilove'),
                        'subtitle' => __('Specify the H3 tag font properties.', 'ilove'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                        ),
                        'output' => 'h3',
                    ),
                    array(
                        'id' => 'typograply_h4_font',
                        'type' => 'typography',
                        'title' => __('Heading 4(H4) Font Setting', 'ilove'),
                        'subtitle' => __('Specify the H4 tag font properties.', 'ilove'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                        ),
                        'output' => 'h4',
                    ),
                    array(
                        'id' => 'typograply_h5_font',
                        'type' => 'typography',
                        'title' => __('Heading 5(H5) Font Setting', 'ilove'),
                        'subtitle' => __('Specify the H5 tag font properties.', 'ilove'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                        ),
                        'output' => 'h5',
                    ),
                    array(
                        'id' => 'typograply_h6_font',
                        'type' => 'typography',
                        'title' => __('Heading 6(H6) Font Setting', 'ilove'),
                        'subtitle' => __('Specify the H6 tag font properties.', 'ilove'),
                        'google' => true,
                        'default' => array(
                            'font-family' => 'Lato',
                        ),
                        'output' => 'h6',
                    ),
                )
            );

            /*--Footer setting--*/
            $this->sections[] = array(
                'title'     => __('Footer Settings', 'ilove'),
                'icon'      => 'el-icon-credit-card',
                'fields'    => array(
                    array(
                        'id' => 'footer_twitter',
                        'type' => 'switch',
                        'title' => __('Footer Twitter Section', 'ilove'),
                        'subtitle' => __('Display footer twitter slide feed', 'ilove'),
                        'default' => true,
                    ),
                    array(
                        'id'        => 'footer_twitter_api_key',
                        'type'      => 'text',
                        'title'     => __('Twitter API Key', 'ilove'),
                        'default'   => '',
                        'required'  => array( 'footer_twitter', 'equals', '1' )
                    ),
                    array(
                        'id'        => 'footer_twitter_api_secret',
                        'type'      => 'text',
                        'title'     => __('Twitter API Secret', 'ilove'),
                        'default'   => '',
                        'required'  => array( 'footer_twitter', 'equals', '1' )
                    ),
                    array(
                        'id'        => 'footer_twitter_username',
                        'type'      => 'text',
                        'title'     => __('Twitter User Name', 'ilove'),
                        'desc'      => __('Insert user name twitter', 'ilove'),
                        'default'   => '',
                        'required'  => array( 'footer_twitter', 'equals', '1' )
                    ),
                    array(
                        'id'        => 'footer_twitter_number',
                        'type'      => 'text',
                        'title'     => __('Twitter Number Feed', 'ilove'),
                        'desc'      => __('Insert number twitter feed display', 'ilove'),
                        'validate' => 'numeric',
                        'default'   => '3',
                        'required'  => array( 'footer_twitter', 'equals', '1' )
                    ),
                    array(
                        'id'        => 'footer_copyright',
                        'type'      => 'editor',
                        'title'     => __('Footer Copyright', 'ilove'),
                        'subtitle'  => __('Insert footer copyright text', 'ilove'),
                        'default'   => __('Plutonthemes - Copyright 2015. Developed by plutonthemes.com', 'ilove')
                    ),
                    array(
                        'id'       => 'footer_social',
                        'type'     => 'switch',
                        'title'    => __('Switch On Footer Socials', 'ilove'),
                        'default'  => true,
                    ),
                    array(
                        'id'          => 'footer_social_list',
                        'type'        => 'slides',
                        'title'       => __('Footer Socials List', 'ilove'),
                        'subtitle'    => __('Unlimited slides with drag and drop sortings.', 'ilove'),
                        'desc'        => __('Insert class icon font awesome.', 'ilove'),
                        'placeholder' => array(
                            'title'           => __('This is a class icon font awesome.', 'ilove'),
                            'description'     => '',
                            'url'             => __('Give us a link!', 'ilove'),
                        ),
                        'default'     => array(
                            array(
                                'title'           => 'fa-twitter',
                                'description'     => '',
                                'url'             => 'http://twitter.com',
                            ),
                            array(
                                'title'           => 'fa-facebook',
                                'description'     => '',
                                'url'             => 'http://facebook.com',
                            ),
                            array(
                                'title'           => 'fa-youtube',
                                'description'     => '',
                                'url'             => 'http://youtube.com',
                            ),
                            array(
                                'title'           => 'fa-google-plus',
                                'description'     => '',
                                'url'             => 'https://plus.google.com/',
                            ),
                            array(
                                'title'           => 'fa-pinterest',
                                'description'     => '',
                                'url'             => 'http://pinterest.com',
                            ),
                            array(
                                'title'           => 'fa-linkedin',
                                'description'     => '',
                                'url'             => 'http://linkedin.com',
                            )
                        ),
                        'required' => array('footer_social', 'equals','1' ),
                    )
                )
            );

            /*-- Category --*/
            $this->sections[] = array(
                'title' => __('Category Settings', 'ilove'),
                'desc' => __('Category Settings', 'ilove'),
                'icon' => 'el-icon-th-list',
                'fields' => array(
                    array(
                        'id'        => 'blog_switch_layout',
                        'type'      => 'switch',
                        'title'     => __('Enable Sidebar', 'ilove'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'blog_switch_meta',
                        'type'      => 'switch',
                        'title'     => __('Enable Meta Posts', 'ilove'),
                        'default'   => true,
                    ),
                    array(
                        'id'            => 'blog_continue_reading',
                        'type'          => 'text',
                        'title'         => __('Continue reading', 'ilove'),
                        'default'       => __('Read More', 'ilove'),
                    ),
                ),
            );


            /*--Single Post--*/
            $this->sections[] = array(
                'title' => __('Single Post Settings', 'ilove'),
                'desc'  => __('Single Post Settings', 'ilove'),
                'icon'  => 'el-icon-file-edit',
                'fields' => array(
                    array(
                        'id'        => 'blog_single_switch_sidebar',
                        'type'      => 'switch',
                        'title'     => __('Enable Sidebar', 'ilove'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'blog_single_switch_meta',
                        'type'      => 'switch',
                        'title'     => __('Enable Meta Post', 'ilove'),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'blog_single_switch_autho',
                        'type'      => 'switch',
                        'title'     => __('Enable Bio Author', 'ilove'),
                        'default'   => true,
                    )
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'redux-framework'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }


            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework'),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );


            $this->sections[] = array(
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'redux-framework'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'redux-framework'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework');
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'ilove', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => false, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'ilove'),
                'page_title' => __('Theme Options', 'ilove'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBnxzHttO52IQDpDkbZNbT48HL3o8YNb-k', // Must be defined to add google fonts to the typography module
                //'async_typography' => true, // Use a asynchronous font on the front end or font string
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => 'ilove', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => get_template_directory_uri().'/assets/images/theme_icon.png', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'ilove_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );
                'hints' => array(
                    'icon'              => 'icon-question-sign',
                    'icon_position'     => 'right',
                    'icon_color'        => 'lightgray',
                    'icon_size'         => 'normal',

                    'tip_style'         => array(
                        'color'     => 'light',
                        'shadow'    => true,
                        'rounded'   => false,
                        'style'     => '',
                    ),
                    'tip_position'      => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );

            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/PlutonThemes',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://twitter.com/PlutonThemes',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                // $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'ilove'), $v);
            } else {
                // $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'ilove');
            }

            // Add content after the form.
            // $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'ilove');
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
 *Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
 *Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
