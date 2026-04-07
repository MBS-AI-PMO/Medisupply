<?php
/*
 * All CSS and JS files are enqueued from this file
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

/**
 * Enqueue Files for FrontEnd
 */
function dotus_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'dotus' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'DM Sans:wght@400;500;700&display=swap' ), "//fonts.googleapis.com/css2" );
    }
     return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

function dotus_heading_google_font_url() {
    $font_url = '';
    if ( 'off' !== esc_html__( 'on', 'dotus' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Calistoga&display=swap' ), "//fonts.googleapis.com/css2" );
    }
     return str_replace( array("%3A","%40", "%3B", "%26", "%3D"), array(":", "@", ";", "&", "="), $font_url );
}

if ( ! function_exists( 'dotus_scripts_styles' ) ) {
  function dotus_scripts_styles() {

    // Styles
    wp_enqueue_style( 'themify-icons', DOTUS_CSS .'/themify-icons.css', array(), '4.6.3', 'all' );
    wp_enqueue_style( 'flaticon', DOTUS_CSS .'/flaticon.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'bootstrap', DOTUS_CSS .'/bootstrap.min.css', array(), '5.0.1', 'all' );
    wp_enqueue_style( 'animate', DOTUS_CSS .'/animate.css', array(), '3.5.1', 'all' );
    wp_enqueue_style( 'odometer', DOTUS_CSS .'/odometer.css', array(), '0.4.8', 'all' );
    wp_enqueue_style( 'progresscircle', DOTUS_CSS .'/progresscircle.css', array(), '1.0.0', 'all' );
    wp_enqueue_style( 'owl-carousel', DOTUS_CSS .'/owl.carousel.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'owl-theme', DOTUS_CSS .'/owl.theme.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'slick', DOTUS_CSS .'/slick.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'swiper', DOTUS_CSS .'/swiper.min.css', array(), '4.0.7', 'all' );
    wp_enqueue_style( 'slick-theme', DOTUS_CSS .'/slick-theme.css', array(), '1.6.0', 'all' );
    wp_enqueue_style( 'owl-transitions', DOTUS_CSS .'/owl.transitions.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'fancybox', DOTUS_CSS .'/fancybox.css', array(), '2.0.0', 'all' );
    wp_enqueue_style( 'dotus-style', DOTUS_CSS .'/styles.css', array(), DOTUS_VERSION, 'all' );
    wp_enqueue_style( 'element', DOTUS_CSS .'/elements.css', array(), DOTUS_VERSION, 'all' );
    if ( !function_exists('cs_framework_init') ) {
      wp_enqueue_style('dotus-default-style', get_template_directory_uri() . '/style.css', array(),  DOTUS_VERSION, 'all' );
    }
    wp_enqueue_style( 'consoel-google-fonts', esc_url( dotus_google_font_url() ), array(), DOTUS_VERSION, 'all' );
    wp_enqueue_style( 'consoel-heading-google-fonts', esc_url( dotus_heading_google_font_url() ), array(), DOTUS_VERSION, 'all' );
    // Scripts
    wp_enqueue_script( 'bootstrap', DOTUS_SCRIPTS . '/bootstrap.min.js', array( 'jquery' ), '5.0.1', true );
    wp_enqueue_script( 'imagesloaded');
    wp_enqueue_script( 'isotope', DOTUS_SCRIPTS . '/isotope.min.js', array( 'jquery' ), '2.2.2', true );
    wp_enqueue_script( 'fancybox', DOTUS_SCRIPTS . '/fancybox.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'instafeed', DOTUS_SCRIPTS . '/instafeed.min.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'circle-progress', DOTUS_SCRIPTS . '/progresscircle.js', array( 'jquery' ), '2.1.5', true );
    wp_enqueue_script( 'masonry');
    wp_enqueue_script( 'owl-carousel', DOTUS_SCRIPTS . '/owl-carousel.js', array( 'jquery' ), '2.0.0', true );
    wp_enqueue_script( 'jquery-easing', DOTUS_SCRIPTS . '/jquery-easing.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'wow', DOTUS_SCRIPTS . '/wow.min.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'odometer', DOTUS_SCRIPTS . '/odometer.min.js', array( 'jquery' ), '0.4.8', true );
    wp_enqueue_script( 'magnific-popup', DOTUS_SCRIPTS . '/magnific-popup.js', array( 'jquery' ), '1.1.0', true );
    wp_enqueue_script( 'slick-slider', DOTUS_SCRIPTS . '/slick-slider.js', array( 'jquery' ), '1.6.0', true );
    wp_enqueue_script( 'moving-animation', DOTUS_SCRIPTS . '/moving-animation.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'swiper', DOTUS_SCRIPTS . '/swiper.min.js', array( 'jquery' ), '4.0.7', true );
    wp_enqueue_script( 'wc-quantity-increment', DOTUS_SCRIPTS . '/wc-quantity-increment.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'dotus-scripts', DOTUS_SCRIPTS . '/scripts.js', array( 'jquery' ), DOTUS_VERSION, true );
    // Comments
    wp_enqueue_script( 'dotus-inline-validate', DOTUS_SCRIPTS . '/jquery.validate.min.js', array( 'jquery' ), '1.9.0', true );
    wp_add_inline_script( 'dotus-validate', 'jQuery(document).ready(function($) {$("#commentform").validate({rules: {author: {required: true,minlength: 2},email: {required: true,email: true},comment: {required: true,minlength: 10}}});});' );

    // Responsive Active
    $dotus_viewport = cs_get_option('theme_responsive');
    if( !$dotus_viewport ) {
      wp_enqueue_style( 'dotus-responsive', DOTUS_CSS .'/responsive.css', array(), DOTUS_VERSION, 'all' );
    }

    // Adds support for pages with threaded comments
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
      wp_enqueue_script( 'comment-reply' );
    }

  }
  add_action( 'wp_enqueue_scripts', 'dotus_scripts_styles' );
}

/**
 * Enqueue Files for BackEnd
 */
if ( ! function_exists( 'dotus_admin_scripts_styles' ) ) {
  function dotus_admin_scripts_styles() {

    wp_enqueue_style( 'dotus-admin-main', DOTUS_CSS . '/admin-styles.css', true );
    wp_enqueue_style( 'flaticon', DOTUS_CSS . '/flaticon.css', true );
    wp_enqueue_style( 'themify-icons', DOTUS_CSS . '/themify-icons.css', true );
    wp_enqueue_script( 'dotus-admin-scripts', DOTUS_SCRIPTS . '/admin-scripts.js', true );

  }
  add_action( 'admin_enqueue_scripts', 'dotus_admin_scripts_styles' );
}
