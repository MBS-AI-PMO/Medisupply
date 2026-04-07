<?php
  // Metabox
  $dotus_id    = ( isset( $post ) ) ? $post->ID : 0;
  $dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
  $dotus_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $dotus_id;
  $dotus_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $dotus_id : false;
  $dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox', true );

  // Header Style
  if ( $dotus_meta ) {
    $dotus_header_design  = $dotus_meta['select_header_design'];
    $dotus_sticky_header = isset( $dotus_meta['sticky_header'] ) ? $dotus_meta['sticky_header'] : '' ;
    $dotus_search = isset( $dotus_meta['dotus_search'] ) ? $dotus_meta['dotus_search'] : '';
  } else {
    $dotus_header_design  = cs_get_option( 'select_header_design' );
    $dotus_sticky_header  = cs_get_option( 'sticky_header' );
    $dotus_search  = cs_get_option( 'dotus_search' );
  }

  $dotus_cart_widget  = cs_get_option( 'dotus_cart_widget' );

  if ( $dotus_header_design === 'default' ) {
    $dotus_header_design_actual  = cs_get_option( 'select_header_design' );
  } else {
    $dotus_header_design_actual = ( $dotus_header_design ) ? $dotus_header_design : cs_get_option('select_header_design');
  }
  $dotus_header_design_actual = $dotus_header_design_actual ? $dotus_header_design_actual : 'style_two';

  if ( $dotus_meta && $dotus_header_design !== 'default') {
   $dotus_search = isset( $dotus_meta['dotus_search'] ) ? $dotus_meta['dotus_search'] : '';
  } else {
    $dotus_search  = cs_get_option( 'dotus_search' );
  }

  if ( $dotus_header_design_actual == 'style_two' ) { 
    $menu_container = 'container-fluid';
  } else {
    $menu_container = 'container-fluid';
  }

  if ( $dotus_cart_widget ) {
    $cart_class = 'has-cart ';
  } else {
    $cart_class = 'not-has-cart ';
  }
  if ( $dotus_search ) {
   $search_class = 'not-has-search ';
  } else {
    $search_class = 'has-search ';
  }
  if ( has_nav_menu( 'primary' ) ) {
     $menu_padding = ' has-menu ';
  } else {
     $menu_padding = ' dont-has-menu ';
  }
  if ($dotus_meta) {
    $dotus_choose_menu = isset( $dotus_meta['choose_menu'] ) ? $dotus_meta['choose_menu'] : '' ;
  } else { $dotus_choose_menu = ''; }
  $dotus_choose_menu = $dotus_choose_menu ? $dotus_choose_menu : '';

?>
<!-- Navigation & Search -->
 <div class="<?php echo esc_attr( $menu_container ); ?>">
    <div class="row align-items-center">
      <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
          <div class="mobail-menu">
              <button type="button" class="navbar-toggler open-btn">
                  <span class="sr-only"><?php echo esc_html__( 'Toggle navigation','dotus' ) ?></span>
                  <span class="icon-bar first-angle"></span>
                  <span class="icon-bar middle-angle"></span>
                  <span class="icon-bar last-angle"></span>
              </button>
          </div>
      </div>
      <div class="col-lg-2 col-md-6 col-6"><!-- Start of Logo -->
          <div class="navbar-header">
            <?php get_template_part( 'theme-layouts/header/logo' ); ?>
          </div>
      </div>
      <div class="col-lg-8 col-md-1 col-1"><!-- Start of nav-collapse -->
        <div id="navbar" class="collapse navbar-collapse navigation-holder <?php echo esc_attr( $menu_padding.$cart_class.$search_class ); ?>">
            <button class="menu-close"><i class="ti-close"></i></button>
            <?php
              wp_nav_menu(
                array(
                  'menu'              => 'primary',
                  'theme_location'    => 'primary',
                  'container'         => '',
                  'container_class'   => '',
                  'container_id'      => '',
                  'menu_class'        => 'nav navbar-nav menu nav-menu mb-2 mb-lg-0',
                  'fallback_cb'       => '__return_false',
                )
              );
            ?>
        </div><!-- end of nav-collapse -->
      </div>
      <?php get_template_part( 'theme-layouts/header/search','bar' ); ?>
    </div><!-- end of row -->
  </div><!-- end of container -->


