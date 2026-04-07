<?php
// Metabox
global $post;
$dotus_id    = ( isset( $post ) ) ? $post->ID : false;
$dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
$dotus_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $dotus_id;
$dotus_id    = ( ! is_tag() && ! is_archive() && ! is_search() && ! is_404() && ! is_singular('service') ) ? $dotus_id : false;
$dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox', true );
// Header Style

$dotus_logo = cs_get_option( 'dotus_logo' );

$logo_url = wp_get_attachment_url( $dotus_logo );
$dotus_logo_alt = get_post_meta( $dotus_logo, '_wp_attachment_image_alt', true );

if ( $logo_url ) {
  $logo_url = $logo_url;
} else {
 $logo_url = DOTUS_IMAGES.'/logo.svg';
}

if ( has_nav_menu( 'primary' ) ) {
  $logo_padding = ' has_menu ';
}
else {
   $logo_padding = ' dont_has_menu ';
}


// Logo Spacings
// Logo Spacings
$dotus_brand_logo_top = cs_get_option( 'dotus_logo_top' );
$dotus_brand_logo_bottom = cs_get_option( 'dotus_logo_bottom' );
if ( $dotus_brand_logo_top ) {
  $dotus_brand_logo_top = 'padding-top:'. dotus_check_px( $dotus_brand_logo_top ) .';';
} else { $dotus_brand_logo_top = ''; }
if ( $dotus_brand_logo_bottom ) {
  $dotus_brand_logo_bottom = 'padding-bottom:'. dotus_check_px( $dotus_brand_logo_bottom ) .';';
} else { $dotus_brand_logo_bottom = ''; }
?>
<div class="site-logo <?php echo esc_attr( $logo_padding ); ?>"  style="<?php echo esc_attr( $dotus_brand_logo_top ); echo esc_attr( $dotus_brand_logo_bottom ); ?>">
   <?php if ( $dotus_logo ) {
    ?>
      <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $logo_url ); ?>" alt=" <?php echo esc_attr( $dotus_logo_alt ); ?>">
     </a>
   <?php } elseif( has_custom_logo() ) {
      the_custom_logo();
    } else {
    ?>
    <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
       <img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo get_bloginfo('name'); ?>">
     </a>
   <?php
  } ?>
</div>