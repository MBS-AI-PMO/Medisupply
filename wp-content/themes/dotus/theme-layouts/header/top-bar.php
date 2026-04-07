<?php
// Metabox
global $post;
$dotus_id    = ( isset( $post ) ) ? $post->ID : false;
$dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
$dotus_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $dotus_id;
$dotus_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('testimonial') ) ? $dotus_id : false;
$dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox', true );
  if ($dotus_meta) {
    $dotus_topbar_options = $dotus_meta['topbar_options'];
  } else {
    $dotus_topbar_options = '';
  }

  if ( $dotus_meta ) {
    $dotus_header_design  = $dotus_meta['select_header_design'];
  } else {
    $dotus_header_design  = cs_get_option( 'select_header_design' );
  }

 if ( $dotus_header_design === 'default' ) {
    $dotus_header_design_actual  = cs_get_option( 'select_header_design' );
  } else {
    $dotus_header_design_actual = ( $dotus_header_design ) ? $dotus_header_design : cs_get_option('select_header_design');
  }
  
$dotus_header_design_actual = $dotus_header_design_actual ? $dotus_header_design_actual : 'style_two';

// Define Theme Options and Metabox varials in right way!
if ($dotus_meta) {
  if ($dotus_topbar_options === 'custom' && $dotus_topbar_options !== 'default') {
    $dotus_top_left          = $dotus_meta['top_left'];
    $dotus_top_right          = $dotus_meta['top_right'];
    $dotus_hide_topbar        = $dotus_topbar_options;
    $dotus_topbar_bg          = $dotus_meta['topbar_bg'];
    if ($dotus_topbar_bg) {
      $dotus_topbar_bg = 'background-color: '. $dotus_topbar_bg .';';
    } else {$dotus_topbar_bg = '';}
  } else {
    $dotus_top_left          = cs_get_option('top_left');
    $dotus_top_right          = cs_get_option('top_right');
    $dotus_hide_topbar        = cs_get_option('top_bar');
    $dotus_topbar_bg          = '';
  }
} else {
  // Theme Options fields
  $dotus_top_left         = cs_get_option('top_left');
  $dotus_top_right          = cs_get_option('top_right');
  $dotus_hide_topbar        = cs_get_option('top_bar');
  $dotus_topbar_bg          = '';
}
// All options
if ( $dotus_meta && $dotus_topbar_options === 'custom' && $dotus_topbar_options !== 'default' ) {
  $dotus_top_right = ( $dotus_top_right ) ? $dotus_meta['top_right'] : cs_get_option('top_right');
  $dotus_top_left = ( $dotus_top_left ) ? $dotus_meta['top_left'] : cs_get_option('top_left');
} else {
  $dotus_top_right = cs_get_option('top_right');
  $dotus_top_left = cs_get_option('top_left');
}
if ( $dotus_meta && $dotus_topbar_options !== 'default' ) {
  if ( $dotus_topbar_options === 'hide_topbar' ) {
    $dotus_hide_topbar = 'hide';
  } else {
    $dotus_hide_topbar = 'show';
  }
} else {
  $dotus_hide_topbar_check = cs_get_option( 'top_bar' );
  if ( $dotus_hide_topbar_check === true ) {
     $dotus_hide_topbar = 'hide';
  } else {
     $dotus_hide_topbar = 'show';
  }
}
if ( $dotus_meta ) {
  $dotus_topbar_bg = ( $dotus_topbar_bg ) ? $dotus_meta['topbar_bg'] : '';
} else {
  $dotus_topbar_bg = '';
}
if ( $dotus_topbar_bg ) {
  $dotus_topbar_bg = 'background-color: '. $dotus_topbar_bg .';';
} else { $dotus_topbar_bg = ''; }

if( $dotus_hide_topbar === 'show' && ( $dotus_top_left || $dotus_top_right ) ) {
?>
 <div class="topbar" style="<?php echo esc_attr( $dotus_topbar_bg ); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col col-md-7 col-sm-12 col-12">
               <?php echo do_shortcode( $dotus_top_left ); ?>
            </div>
            <div class="col col-md-5 col-sm-12 col-12">
                <?php echo do_shortcode( $dotus_top_right ); ?>
            </div>
        </div>
    </div>
</div> <!-- end topbar -->
<?php } // Hide Topbar - From Metabox