<?php
	// Logo Image
	// Metabox - Header Transparent
	$dotus_id    = ( isset( $post ) ) ? $post->ID : 0;
	$dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
	$dotus_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $dotus_id;
	$dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox'. true );
    $dotus_preloader_image  = cs_get_option( 'preloader_image' );

    $dotus_preloader_url = wp_get_attachment_url( $dotus_preloader_image );
    $dotus_preloader_alt = get_post_meta( $dotus_preloader_image, '_wp_attachment_image_alt', true );

    if ( $dotus_preloader_url ) {
        $dotus_preloader_url = $dotus_preloader_url;
    } else {
        $dotus_preloader_url = DOTUS_IMAGES.'/preloader.png';
    }

?>
<!-- start preloader -->
<div class="preloader">
    <div class="vertical-centered-box">
        <div class="content">
            <div class="loader-circle"></div>
            <div class="loader-line-mask">
                <div class="loader-line"></div>
            </div>
           <img src="<?php echo esc_url( $dotus_preloader_url ); ?>" alt="<?php echo esc_attr( $dotus_preloader_alt ); ?>">
        </div>
    </div>
</div>
<!-- end preloader -->