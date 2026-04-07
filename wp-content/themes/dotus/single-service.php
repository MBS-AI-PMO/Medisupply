<?php
/*
 * The template for displaying all single posts.
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
		$dotus_content_padding = $dotus_meta['content_spacings'];
	} else { $dotus_content_padding = ''; }
	// Padding - Metabox
	if ( $dotus_content_padding && $dotus_content_padding !== 'padding-default' ) {
		$dotus_content_top_spacings = $dotus_meta['content_top_spacings'];
		$dotus_content_bottom_spacings = $dotus_meta['content_bottom_spacings'];
		if ( $dotus_content_padding === 'padding-custom' ) {
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
	$dotus_sidebar_position = cs_get_option( 'service_sidebar_position' );
	$dotus_single_comment = cs_get_option( 'service_comment_form' );
	$dotus_sidebar_position = $dotus_sidebar_position ? $dotus_sidebar_position : 'sidebar-hide';
	// Sidebar Position
	if ( $dotus_sidebar_position === 'sidebar-hide' ) {
		$dotus_layout_class = 'col-md-12 col col-xs-12';
		$dotus_sidebar_class = 'hide-sidebar';
	} elseif ( $dotus_sidebar_position === 'sidebar-left' ) {
		$dotus_layout_class = 'col col-lg-8 col-lg-push-4';
		$dotus_sidebar_class = 'left-sidebar';
	} else {
		$dotus_layout_class = 'col-lg-8';
		$dotus_sidebar_class = 'right-sidebar';
	} ?>
<div class="service-single-section section-padding <?php echo esc_attr( $dotus_content_padding .' '. $dotus_sidebar_class ); ?>" style="<?php echo esc_attr( $dotus_custom_padding ); ?>">
	<div class="container">
		<div class="row">
			<div class="<?php echo esc_attr( $dotus_layout_class ); ?>">
				<div class="service-single-content">
					<?php
					if ( have_posts() ) :
						/* Start the Loop */
						while ( have_posts() ) : the_post();
							if ( post_password_required() ) {
									echo '<div class="password-form">'.get_the_password_form().'</div>';
								} else {
									get_template_part( 'theme-layouts/post/service', 'content' );
									$dotus_single_comment = !$dotus_single_comment ? comments_template() : '';

								}
						endwhile;
					else :
						get_template_part( 'theme-layouts/post/content', 'none' );
					endif; ?>
				</div><!-- Blog Div -->
				<?php
		    wp_reset_postdata(); ?>
			</div><!-- Content Area -->
				<?php
				if ( $dotus_sidebar_position !== 'sidebar-hide' ) {
					get_sidebar(); // Sidebar
				} ?>
		</div>
	</div>
</div>
<?php
get_footer();