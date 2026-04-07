<?php
/*
 * The template for displaying the footer.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

$dotus_id    = ( isset( $post ) ) ? $post->ID : 0;
$dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
$dotus_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $dotus_id;
$dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox', true );
$dotus_ft_bg = cs_get_option('dotus_ft_bg');
$dotus_attachment = wp_get_attachment_image_src( $dotus_ft_bg , 'full' );
$dotus_attachment = $dotus_attachment ? $dotus_attachment[0] : '';
if ( $dotus_meta ) {
	$dotus_footer_design  = $dotus_meta['select_footer_design'];
	if ($dotus_footer_design != 'theme') {
	  $dotus_footer_design = $dotus_footer_design;
	} else {
	  $dotus_footer_design = cs_get_option( 'select_footer_design' );
	}
} else {
	$dotus_footer_design  = cs_get_option( 'select_footer_design' );
}

if (is_numeric($dotus_footer_design)) {
	$footer_class = 'footer-builder';
} else {
	$footer_class = 'wpo-site-footer clearfix';
}

if ( $dotus_attachment && !is_numeric($dotus_footer_design) ) {
	$bg_url = ' style="';
	$bg_url .= ( $dotus_attachment ) ? 'background-image: url( '. esc_url( $dotus_attachment ) .' );' : '';
	$bg_url .= '"';
} else {
	$bg_url = '';
}

if ( $dotus_meta ) {
	$dotus_hide_footer  = $dotus_meta['hide_footer'];
} else { $dotus_hide_footer = ''; }
if ( !$dotus_hide_footer ) { // Hide Footer Metabox
	$hide_copyright = cs_get_option('hide_copyright');
	
?>
	<!-- Footer -->
	<footer class="<?php echo esc_attr($footer_class); ?>"  <?php echo wp_kses( $bg_url, array('img' => array('src' => array(), 'alt' => array()),) ); ?>>
		 <div class="f-shape-1">
          <svg width="887" height="757" viewBox="0 0 887 757" fill="none">
              <g opacity="0.6" filter="url(#filter0_f_235_142)">
                  <circle cx="353" cy="223" r="234" />
              </g>
              <defs>
                  <filter id="filter0_f_235_142" x="-181" y="-311" width="1068" height="1068"
                      filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                      <feFlood flood-opacity="0" result="BackgroundImageFix" />
                      <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                      <feGaussianBlur stdDeviation="150" result="effect1_foregroundBlur_235_142" />
                  </filter>
              </defs>
          </svg>
      </div>
      <div class="f-shape-2">
          <svg width="696" height="606" viewBox="0 0 696 606" fill="none">
              <g opacity="0.6" filter="url(#filter0_f_235_143)">
                  <circle cx="534" cy="534" r="234" />
              </g>
              <defs>
                  <filter id="filter0_f_235_143" x="0" y="0" width="1068" height="1068"
                      filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                      <feFlood flood-opacity="0" result="BackgroundImageFix" />
                      <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                      <feGaussianBlur stdDeviation="150" result="effect1_foregroundBlur_235_143" />
                  </filter>
              </defs>
          </svg>
      </div>
      <?php  if (is_numeric($dotus_footer_design)) {
        $footer_builder = new WP_Query(
          array(
            'post_type' => 'footerbuilder',
            'posts_per_page' => 1,
            'p' => $dotus_footer_design,
            'orderby' => 'none',
            'order' => 'DESC'
          )
        );

        if ($footer_builder->have_posts()) {
          while ($footer_builder->have_posts()) {
            $footer_builder->the_post();
            the_content();
          }
        }
        wp_reset_postdata();
      } else { 
		$footer_widget_block = cs_get_option( 'footer_widget_block' );
		if ( $footer_widget_block ) {
	      	get_template_part( 'theme-layouts/footer/footer', 'widgets' );
	    }
		if ( !$hide_copyright ) {
      		get_template_part( 'theme-layouts/footer/footer', 'copyright' );
	    }
      } ?>
	</footer>
	<!-- Footer -->
<?php } // Hide Footer Metabox ?>
</div><!--dotus-theme-wrapper -->
<?php wp_footer(); ?>
</body>
</html>
