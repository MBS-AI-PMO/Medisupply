<?php
/*
 * The main template file.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
get_header();
	// Metabox
	$dotus_id    = ( isset( $post ) ) ? $post->ID : 0;
	$dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
	$dotus_id    = ( is_woocommerce_shop() ) ? wc_get_page_id( 'shop' ) : $dotus_id;
	$dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox', true );
	if ( $dotus_meta ) {
		$dotus_content_padding = isset( $dotus_meta['content_spacings'] ) ? $dotus_meta['content_spacings'] : '';
	} else { $dotus_content_padding = ''; }
	// Padding - Metabox
	if ($dotus_content_padding && $dotus_content_padding !== 'padding-default') {
		$dotus_content_top_spacings = $dotus_meta['content_top_spacings'];
		$dotus_content_bottom_spacings = $dotus_meta['content_bottom_spacings'];
		if ($dotus_content_padding === 'padding-custom') {
			$dotus_content_top_spacings = $dotus_content_top_spacings ? 'padding-top:'. dotus_check_px($dotus_content_top_spacings) .';' : '';
			$dotus_content_bottom_spacings = $dotus_content_bottom_spacings ? 'padding-bottom:'. dotus_check_px($dotus_content_bottom_spacings) .';' : '';
			$dotus_custom_padding = $dotus_content_top_spacings . $dotus_content_bottom_spacings;
		} else {
			$dotus_custom_padding = '';
		}
	} else {
		$dotus_custom_padding = '';
	}
	// Theme Options
	$dotus_sidebar_position = cs_get_option( 'blog_sidebar_position' );
	$dotus_sidebar_position = $dotus_sidebar_position ?$dotus_sidebar_position : 'sidebar-right';
	$dotus_blog_widget = cs_get_option( 'blog_widget' );
	$dotus_blog_widget = $dotus_blog_widget ? $dotus_blog_widget : 'sidebar-1';

	if (isset($_GET['sidebar'])) {
	  $dotus_sidebar_position = $_GET['sidebar'];
	}

	$dotus_sidebar_position = $dotus_sidebar_position ? $dotus_sidebar_position : 'sidebar-right';

	// Sidebar Position
	if ( $dotus_sidebar_position === 'sidebar-hide' ) {
		$layout_class = 'col col col-md-10 col-md-offset-1';
		$dotus_sidebar_class = 'hide-sidebar';
	} elseif ( $dotus_sidebar_position === 'sidebar-left' && is_active_sidebar( $dotus_blog_widget ) ) {
		$layout_class = 'col col-md-8 col-md-push-4';
		$dotus_sidebar_class = 'left-sidebar';
	} elseif( is_active_sidebar( $dotus_blog_widget ) ) {
		$layout_class = 'col col-md-8';
		$dotus_sidebar_class = 'right-sidebar';
	} else {
		$layout_class = 'col col-md-12';
		$dotus_sidebar_class = 'hide-sidebar';
	}

	?>
<div class="wpo-blog-pg-section section-padding">
	<div class="container <?php echo esc_attr( $dotus_content_padding .' '. $dotus_sidebar_class ); ?>" style="<?php echo esc_attr( $dotus_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $layout_class ); ?>">
				<div class="blog-content">
				<?php
				if ( have_posts() ) :
					/* Start the Loop */
					while ( have_posts() ) : the_post();
						get_template_part( 'theme-layouts/post/content' );
					endwhile;
				else :
					get_template_part( 'theme-layouts/post/content', 'none' );
				endif;
				dotus_posts_navigation();
		    wp_reset_postdata(); ?>
		    </div>
			</div><!-- Content Area -->
			<?php
			if ( $dotus_sidebar_position !== 'sidebar-hide' && is_active_sidebar( $dotus_blog_widget ) ) {
				get_sidebar(); // Sidebar
			} ?>
		</div>
	</div>
</div>
<?php
get_footer();