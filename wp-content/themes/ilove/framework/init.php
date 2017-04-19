<?php
	/*
	 * Load redux  core framework
	*/
	if ( !class_exists( 'ReduxFramework' ) && file_exists( get_template_directory() . '/framework/core/reduxframework/ReduxCore/framework.php' ) ) {
	    require_once( get_template_directory() . '/framework/core/reduxframework/ReduxCore/framework.php' );
	}


	/*
	 * Be sure to rename this function to something more unique
	*/
	function removeDemoModeLink() {
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
	    }
	    if ( class_exists('ReduxFrameworkPlugin') ) {
	        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
	    }
	}
	add_action('init', 'removeDemoModeLink');

	/*
	 * Load Required/Recommended Plugins
	*/
	require_once get_template_directory() . '/framework/core/plugins_load.php';
	require_once get_template_directory() . '/framework/core/bootstrap_navwalker.php';

	/*
	 * Load theme options
	*/
	require_once get_template_directory() . '/framework/styles_scripts.php';
	require_once get_template_directory() . '/framework/register.php';
	require_once get_template_directory() . '/framework/support.php';
	require_once get_template_directory() . '/framework/functions.php';
	if ( file_exists( get_template_directory() . '/framework/options.php' ) ) {
	    require_once( get_template_directory() . '/framework/options.php' );
	}

	/*
	 * Import demo data
	*/
	$menu_name = 'main_menu';
	if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
		# code...
	} else {
		require_once get_template_directory() . '/framework/core/impoter/init.php';
	}