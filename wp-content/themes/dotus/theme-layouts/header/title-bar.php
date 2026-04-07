<?php
	// Metabox
	$dotus_id    = ( isset( $post ) ) ? $post->ID : 0;
	$dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
	$dotus_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $dotus_id;
	$dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox', true );
	if ($dotus_meta && is_page()) {
		$dotus_title_bar_padding = $dotus_meta['title_area_spacings'];
	} else { $dotus_title_bar_padding = ''; }
	// Padding - Theme Options
	if ($dotus_title_bar_padding && $dotus_title_bar_padding !== 'padding-default') {
		$dotus_title_top_spacings = $dotus_meta['title_top_spacings'];
		$dotus_title_bottom_spacings = $dotus_meta['title_bottom_spacings'];
		if ($dotus_title_bar_padding === 'padding-custom') {
			$dotus_title_top_spacings = $dotus_title_top_spacings ? 'padding-top:'. dotus_check_px($dotus_title_top_spacings) .';' : '';
			$dotus_title_bottom_spacings = $dotus_title_bottom_spacings ? 'padding-bottom:'. dotus_check_px($dotus_title_bottom_spacings) .';' : '';
			$dotus_custom_padding = $dotus_title_top_spacings . $dotus_title_bottom_spacings;
		} else {
			$dotus_custom_padding = '';
		}
	} else {
		$dotus_title_bar_padding = cs_get_option('title_bar_padding');
		$dotus_titlebar_top_padding = cs_get_option('titlebar_top_padding');
		$dotus_titlebar_bottom_padding = cs_get_option('titlebar_bottom_padding');
		if ($dotus_title_bar_padding === 'padding-custom') {
			$dotus_titlebar_top_padding = $dotus_titlebar_top_padding ? 'padding-top:'. dotus_check_px($dotus_titlebar_top_padding) .';' : '';
			$dotus_titlebar_bottom_padding = $dotus_titlebar_bottom_padding ? 'padding-bottom:'. dotus_check_px($dotus_titlebar_bottom_padding) .';' : '';
			$dotus_custom_padding = $dotus_titlebar_top_padding . $dotus_titlebar_bottom_padding;
		} else {
			$dotus_custom_padding = '';
		}
	}
	// Banner Type - Meta Box
	if ($dotus_meta && is_page()) {
		$dotus_banner_type = $dotus_meta['banner_type'];
	} else { $dotus_banner_type = ''; }
	// Header Style
	if ($dotus_meta) {
	  $dotus_header_design  = $dotus_meta['select_header_design'];
	  $dotus_hide_breadcrumbs  = $dotus_meta['hide_breadcrumbs'];
	} else {
	  $dotus_header_design  = cs_get_option('select_header_design');
	  $dotus_hide_breadcrumbs = cs_get_option('need_breadcrumbs');
	}
	if ( $dotus_header_design === 'default') {
	  $dotus_header_design_actual  = cs_get_option('select_header_design');
	} else {
	  $dotus_header_design_actual = ( $dotus_header_design ) ? $dotus_header_design : cs_get_option('select_header_design');
	}
	if ( $dotus_header_design_actual == 'style_two') {
		$overly_class = ' overly';
	} else {
		$overly_class = ' ';
	}
	// Overlay Color - Theme Options
		if ($dotus_meta && is_page()) {
			$dotus_bg_overlay_color = $dotus_meta['titlebar_bg_overlay_color'];
			$title_color = isset($dotus_meta['title_color']) ? $dotus_meta['title_color'] : '';
		} else { $dotus_bg_overlay_color = ''; }
		if (!empty($dotus_bg_overlay_color)) {
			$dotus_bg_overlay_color = $dotus_bg_overlay_color;
			$title_color = $title_color;
		} else {
			$dotus_bg_overlay_color = cs_get_option('titlebar_bg_overlay_color');
			$title_color = cs_get_option('title_color');
		}
		$e_uniqid        = uniqid();
		$inline_style  = '';
		if ( $dotus_bg_overlay_color ) {
		 $inline_style .= '.page-title-'.$e_uniqid .'.page-title {';
		 $inline_style .= ( $dotus_bg_overlay_color ) ? 'background-color:'. $dotus_bg_overlay_color.';' : '';
		 $inline_style .= '}';
		}
		if ( $title_color ) {
		 $inline_style .= '.page-title-'.$e_uniqid .'.page-title h2, .page-title-'.$e_uniqid .'.page-title .breadcrumb li, .page-title-'.$e_uniqid .'.page-title .breadcrumbs ul li a {';
		 $inline_style .= ( $title_color ) ? 'color:'. $title_color.';' : '';
		 $inline_style .= '}';
		}
		// add inline style
		add_inline_style( $inline_style );
		$styled_class  = ' page-title-'.$e_uniqid;
	// Background - Type
	if( $dotus_meta ) {
		$title_bar_bg = $dotus_meta['title_area_bg'];
	} else {
		$title_bar_bg = '';
	}
	$dotus_custom_header = get_custom_header();
	$header_text_color = get_theme_mod( 'header_textcolor' );
	$background_color = get_theme_mod( 'background_color' );
	if( isset( $title_bar_bg['image'] ) && ( $title_bar_bg['image'] ||  $title_bar_bg['color'] ) ) {
	  extract( $title_bar_bg );
	  $dotus_background_image       = ( ! empty( $image ) ) ? 'background-image: url(' . esc_url($image) . ');' : '';
	  $dotus_background_repeat      = ( ! empty( $image ) && ! empty( $repeat ) ) ? ' background-repeat: ' . esc_attr( $repeat) . ';' : '';
	  $dotus_background_position    = ( ! empty( $image ) && ! empty( $position ) ) ? ' background-position: ' . esc_attr($position) . ';' : '';
	  $dotus_background_size    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-size: ' . esc_attr($size) . ';' : '';
	  $dotus_background_attachment    = ( ! empty( $image ) && ! empty( $size ) ) ? ' background-attachment: ' . esc_attr( $attachment ) . ';' : '';
	  $dotus_background_color       = ( ! empty( $color ) ) ? ' background-color: ' . esc_attr( $color ) . ';' : '';
	  $dotus_background_style       = ( ! empty( $image ) ) ? $dotus_background_image . $dotus_background_repeat . $dotus_background_position . $dotus_background_size . $dotus_background_attachment : '';
	  $dotus_title_bg = ( ! empty( $dotus_background_style ) || ! empty( $dotus_background_color ) ) ? $dotus_background_style . $dotus_background_color : '';
	} elseif( $dotus_custom_header->url ) {
		$dotus_title_bg = 'background-image:  url('. esc_url( $dotus_custom_header->url ) .');';
	} else {
		$dotus_title_bg = '';
	}
	if($dotus_banner_type === 'hide-title-area') { // Hide Title Area
	} elseif($dotus_meta && $dotus_banner_type === 'revolution-slider') { // Hide Title Area
		echo do_shortcode($dotus_meta['page_revslider']);
	} else {
	?>
 <!-- start page-title -->
  <section class="wpo-page-title <?php echo esc_attr( $overly_class.$styled_class.' '.$dotus_banner_type ); ?>" style="<?php echo esc_attr( $dotus_title_bg.' '.$dotus_custom_padding ); ?>">
	    <div class="container">
	        <div class="row">
	            <div class="col col-xs-12">
	                <div class="wpo-breadcumb-wrap">
	                    <h2><?php echo dotus_title_area(); ?></h2>
	                    <?php if ( !$dotus_hide_breadcrumbs && function_exists( 'breadcrumb_trail' )) { breadcrumb_trail();  } ?>
	                </div>
	            </div>
	        </div> <!-- end row -->
	    </div> <!-- end container -->
	</section>
  <!-- end page-title -->
<?php } ?>