<?php
/*
 * The template for displaying all pages.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */
$dotus_id    = ( isset( $post ) ) ? $post->ID : 0;
$dotus_id    = ( is_home() ) ? get_option( 'page_for_posts' ) : $dotus_id;
$dotus_meta  = get_post_meta( $dotus_id, 'page_type_metabox', true );
if ( $dotus_meta ) {
	$dotus_content_padding = $dotus_meta['content_spacings'];
} else { $dotus_content_padding = 'section-padding'; }
// Top and Bottom Padding
if ( $dotus_content_padding && $dotus_content_padding !== 'padding-default' ) {
	$dotus_content_top_spacings = isset( $dotus_meta['content_top_spacings'] ) ? $dotus_meta['content_top_spacings'] : '';
	$dotus_content_bottom_spacings = isset( $dotus_meta['content_bottom_spacings'] ) ? $dotus_meta['content_bottom_spacings'] : '';
	if ( $dotus_content_padding === 'padding-custom' ) {
		$dotus_content_top_spacings = $dotus_content_top_spacings ? 'padding-top:'. dotus_check_px( $dotus_content_top_spacings ) .';' : '';
		$dotus_content_bottom_spacings = $dotus_content_bottom_spacings ? 'padding-bottom:'. dotus_check_px($dotus_content_bottom_spacings) .';' : '';
		$dotus_custom_padding = $dotus_content_top_spacings . $dotus_content_bottom_spacings;
	} else {
		$dotus_custom_padding = '';
	}
	$padding_class = '';
} else {
	$dotus_custom_padding = '';
	$padding_class = '';
}

// Page Layout
$page_layout_options = get_post_meta( get_the_ID(), 'page_layout_options', true );
if ( $page_layout_options ) {
	$dotus_page_layout = $page_layout_options['page_layout'];
	$page_sidebar_widget = $page_layout_options['page_sidebar_widget'];
} else {
	$dotus_page_layout = 'right-sidebar';
	$page_sidebar_widget = '';
}
$page_sidebar_widget = $page_sidebar_widget ? $page_sidebar_widget : 'sidebar-1';
if ( $dotus_page_layout === 'extra-width' ) {
	$dotus_page_column = 'extra-width';
	$dotus_page_container = 'container-fluid';
} elseif ( $dotus_page_layout === 'full-width' ) {
	$dotus_page_column = 'col-md-12';
	$dotus_page_container = 'container ';
} elseif( ( $dotus_page_layout === 'left-sidebar' || $dotus_page_layout === 'right-sidebar' ) && is_active_sidebar( $page_sidebar_widget ) ) {
	if( $dotus_page_layout === 'left-sidebar' ){
		$dotus_page_column = 'col-md-8 order-12';
	} else {
		$dotus_page_column = 'col-md-8';
	}
	$dotus_page_container = 'container ';
} else {
	$dotus_page_column = 'col-md-12';
	$dotus_page_container = 'container ';
}
$dotus_theme_page_comments = cs_get_option( 'theme_page_comments' );
get_header();
?>
<div class="page-wrap <?php echo esc_attr( $padding_class.''.$dotus_content_padding ); ?>">
	<div class="<?php echo esc_attr( $dotus_page_container.''.$dotus_page_layout ); ?>" style="<?php echo esc_attr( $dotus_custom_padding ); ?>">
		<div class="row">
			<div class="<?php echo esc_attr( $dotus_page_column ); ?>">
				<div class="page-wraper clearfix">
				<?php
				while ( have_posts() ) : the_post();
					the_content();
					if ( !$dotus_theme_page_comments && ( comments_open() || get_comments_number() ) ) :
						comments_template();
					endif;
				endwhile; // End of the loop.
				?>
				</div>
				<div class="page-link-wrap">
					<?php dotus_wp_link_pages(); ?>
				</div>
			</div>
			<?php
			// Sidebar
			if( ($dotus_page_layout === 'left-sidebar' || $dotus_page_layout === 'right-sidebar') && is_active_sidebar( $page_sidebar_widget )  ) {
				get_sidebar();
			}
			?>
		</div>
	</div>
</div>
<?php
get_footer();