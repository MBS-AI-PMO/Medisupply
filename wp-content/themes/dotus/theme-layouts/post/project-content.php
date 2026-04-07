<?php
/**
 * Single Event.
 */
$dotus_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$dotus_large_image = $dotus_large_image ? $dotus_large_image[0] : '';
$image_alt = get_post_meta( $dotus_large_image, '_wp_attachment_image_alt', true);
$project_options = get_post_meta( get_the_ID(), 'project_options', true );
$project_page_options = get_post_meta( get_the_ID(), 'project_page_options', true );

$dotus_prev_pro = cs_get_option('prev_service');
$dotus_next_pro = cs_get_option('next_servic');
$dotus_prev_pro = ($dotus_prev_pro) ? $dotus_prev_pro : esc_html__('Previous project', 'dotus');
$dotus_next_pro = ($dotus_next_pro) ? $dotus_next_pro : esc_html__('Next project', 'dotus');
$dotus_prev_post = get_previous_post( '', false);
$dotus_next_post = get_next_post( '', false);

?>        
<div class="content-area">
			<div class="project-article">
     		<?php the_content(); ?>
     </div>
</div> 

 