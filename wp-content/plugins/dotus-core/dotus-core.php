<?php
/*
Plugin Name: Dotus Core
Plugin URI: http://themeforest.net/user/wpoceans
Description: Plugin to contain shortcodes and custom post types of the dotus theme.
Author: wpoceans
Author URI: http://themeforest.net/user/wpoceans/portfolio
Version: 1.0.1
Text Domain: dotus-core
*/

if( ! function_exists( 'dotus_block_direct_access' ) ) {
	function dotus_block_direct_access() {
		if( ! defined( 'ABSPATH' ) ) {
			exit( 'Forbidden' );
		}
	}
}

// Plugin URL
define( 'DOTUS_PLUGIN_URL', plugins_url( '/', __FILE__ ) );

// Plugin PATH
define( 'DOTUS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'DOTUS_PLUGIN_ASTS', DOTUS_PLUGIN_URL . 'assets' );
define( 'DOTUS_PLUGIN_IMGS', DOTUS_PLUGIN_ASTS . '/images' );
define( 'DOTUS_PLUGIN_INC', DOTUS_PLUGIN_PATH . 'include' );

// DIRECTORY SEPARATOR
define ( 'DS' , DIRECTORY_SEPARATOR );

// Dotus Elementor Shortcode Path
define( 'DOTUS_EM_SHORTCODE_BASE_PATH', DOTUS_PLUGIN_PATH . 'elementor/' );
define( 'DOTUS_EM_SHORTCODE_PATH', DOTUS_EM_SHORTCODE_BASE_PATH . 'widgets/' );

/**
 * Check if Codestar Framework is Active or Not!
 */
function dotus_framework_active() {
  return ( defined( 'CS_VERSION' ) ) ? true : false;
}

/* DOTUS_THEME_NAME_PLUGIN */
define('DOTUS_THEME_NAME_PLUGIN', 'Dotus' );

// Initial File
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('dotus-core/dotus-core.php')) {

	// Custom Post Type
  require_once( DOTUS_PLUGIN_INC . '/custom-post-type.php' );

  if ( is_plugin_active('kingcomposer/kingcomposer.php') ) {

    define( 'DOTUS_KC_SHORTCODE_BASE_PATH', DOTUS_PLUGIN_PATH . 'kc/' );
    define( 'DOTUS_KC_SHORTCODE_PATH', DOTUS_KC_SHORTCODE_BASE_PATH . 'shortcodes/' );
    // Shortcodes
    require_once( DOTUS_KC_SHORTCODE_BASE_PATH . '/kc-setup.php' );
    require_once( DOTUS_KC_SHORTCODE_BASE_PATH . '/library.php' );
  }

  // Theme Custom Shortcode
  require_once( DOTUS_PLUGIN_INC . '/custom-shortcodes/theme-shortcodes.php' );
  require_once( DOTUS_PLUGIN_INC . '/custom-shortcodes/custom-shortcodes.php' );

  // Importer
  require_once( DOTUS_PLUGIN_INC . '/demo/importer.php' );


  if (class_exists('WP_Widget') && is_plugin_active('codestar-framework/cs-framework.php') ) {
    // Widgets

    require_once( DOTUS_PLUGIN_INC . '/widgets/nav-widget.php' );
    require_once( DOTUS_PLUGIN_INC . '/widgets/recent-posts.php' );
    require_once( DOTUS_PLUGIN_INC . '/widgets/recent-case.php' );
    require_once( DOTUS_PLUGIN_INC . '/widgets/text-widget.php' );
    require_once( DOTUS_PLUGIN_INC . '/widgets/widget-extra-fields.php' );

    // Elementor
    if(file_exists( DOTUS_EM_SHORTCODE_BASE_PATH . '/em-setup.php' ) ){
      require_once( DOTUS_EM_SHORTCODE_BASE_PATH . '/em-setup.php' );
      require_once( DOTUS_EM_SHORTCODE_BASE_PATH . 'lib/fields/icons.php' );
      require_once( DOTUS_EM_SHORTCODE_BASE_PATH . 'lib/icons-manager/icons-manager.php' );
    }
  }

  add_action('wp_enqueue_scripts', 'dotus_plugin_enqueue_scripts');
  function dotus_plugin_enqueue_scripts() {
    wp_enqueue_script('plugin-scripts', DOTUS_PLUGIN_ASTS.'/plugin-scripts.js', array('jquery'), '', true);
  }

}

// Extra functions
require_once( DOTUS_PLUGIN_INC . '/theme-functions.php' );