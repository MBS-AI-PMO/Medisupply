<?php
/*
 * Dotus Theme's Functions
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Define - Folder Paths
 */

define( 'DOTUS_THEMEROOT_URI', get_template_directory_uri() );
define( 'DOTUS_CSS', DOTUS_THEMEROOT_URI . '/assets/css' );
define( 'DOTUS_IMAGES', DOTUS_THEMEROOT_URI . '/assets/images' );
define( 'DOTUS_SCRIPTS', DOTUS_THEMEROOT_URI . '/assets/js' );
define( 'DOTUS_FRAMEWORK', get_template_directory() . '/includes' );
define( 'DOTUS_LAYOUT', get_template_directory() . '/theme-layouts' );
define( 'DOTUS_CS_IMAGES', DOTUS_THEMEROOT_URI . '/includes/theme-options/framework-extend/images' );
define( 'DOTUS_CS_FRAMEWORK', get_template_directory() . '/includes/theme-options/framework-extend' ); // Called in Icons field *.json
define( 'DOTUS_ADMIN_PATH', get_template_directory() . '/includes/theme-options/cs-framework' ); // Called in Icons field *.json

/**
 * Define - Global Theme Info's
 */
if (is_child_theme()) { // If Child Theme Active
	$dotus_theme_child = wp_get_theme();
	$dotus_get_parent = $dotus_theme_child->Template;
	$dotus_theme = wp_get_theme($dotus_get_parent);
} else { // Parent Theme Active
	$dotus_theme = wp_get_theme();
}
define('DOTUS_NAME', $dotus_theme->get( 'Name' ));
define('DOTUS_VERSION', $dotus_theme->get( 'Version' ));
define('DOTUS_BRAND_URL', $dotus_theme->get( 'AuthorURI' ));
define('DOTUS_BRAND_NAME', $dotus_theme->get( 'Author' ));


/**
* All Main Files Include
*/
 
add_action( 'after_setup_theme', 'dotus_theme_options_setup', 20 );
  function dotus_theme_options_setup() {
	require_once(DOTUS_FRAMEWORK . '/init.php');
 }

/**
 * thumbnail size
 */
add_image_size( 'dotus-post-image-one', 415, 450, true );

/**
 * Respect ZBMTech language switcher before locale is finalized.
 */
add_filter('pre_determine_locale', 'dotus_zbmtech_pre_determine_locale', 10, 1);
function dotus_zbmtech_pre_determine_locale($locale) {
	$supported = array(
		'en' => 'en_US',
		'es' => 'es_ES',
	);

	if (!empty($_GET['zbm_lang'])) {
		$lang = strtolower(sanitize_text_field(wp_unslash($_GET['zbm_lang'])));
		if (isset($supported[$lang])) {
			return $supported[$lang];
		}
	}

	if (!empty($_COOKIE['zbmtech_lang'])) {
		$lang = strtolower(sanitize_text_field(wp_unslash($_COOKIE['zbmtech_lang'])));
		if (isset($supported[$lang])) {
			return $supported[$lang];
		}
	}

	return $locale;
}