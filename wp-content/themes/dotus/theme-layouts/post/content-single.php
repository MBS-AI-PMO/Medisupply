<?php
/**
 * Single Post.
 */
$dotus_large_image =  wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'fullsize', false, '' );
$dotus_large_image = $dotus_large_image ? $dotus_large_image[0] : '';
$image_alt = get_post_meta( $dotus_large_image, '_wp_attachment_image_alt', true);
$dotus_post_type = get_post_meta( get_the_ID(), 'post_type_metabox', true );
// Single Theme Option
$dotus_post_pagination_option = cs_get_option('single_post_pagination');
$dotus_single_featured_image = cs_get_option('single_featured_image');
$dotus_single_author_info = cs_get_option('single_author_info');
$dotus_single_share_option = cs_get_option('single_share_option');
$dotus_metas_hide = (array) cs_get_option( 'theme_metas_hide' );

if ( has_tag() ) {
   $extra_class  = ' not-has-tag';
} else {
  $extra_class  = ' has-tag-share';
}

?>
  <div <?php post_class('post clearfix'); ?>>
  	<?php if ( $dotus_large_image ) { ?>
  	  <div class="entry-media">
        <img src="<?php echo esc_url( $dotus_large_image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
   		</div>
  	<?php	} ?>
    <div class="entry-meta">
      <ul>
        <li>
           <?php if ( !in_array( 'author', $dotus_metas_hide ) ) { // Author Hide
              printf(
              '<span><i class="fi ti-pencil-alt author"></i>'.esc_html__(' By: ','dotus').'<a href="%1$s" rel="author">%2$s</a></span>',
              esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author()
              );
          } ?>
        </li>
        <li>
        <i class="fi ti-comment-alt"></i>
           <a class="dotus-comment" href="<?php echo esc_url( get_comments_link() ); ?>">
            <?php printf( esc_html( _nx( 'Comments (%1$s)', 'Comments (%1$s)', get_comments_number(), 'comments title', 'dotus' ) ), '<span class="comment">'.number_format_i18n( get_comments_number() ).'</span>','<span>' . get_the_title() . '</span>' ); ?>
          </a>
        </li>
        <li><i class="fi ti-calendar"></i>
          <a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo esc_html( get_the_date() );  ?></a>
        </li>
      </ul>
    </div>
    <div class="entry-details">
	     <?php
				the_content();
				echo dotus_wp_link_pages();
			 ?>
    </div>
</div>
<?php if( has_tag() || ( $dotus_single_share_option && function_exists('dotus_wp_share_option') ) ) { ?>
  <div class="tag-share-wrap">
    <div class="tag-share clearfix <?php echo esc_attr( $extra_class ); ?>">
    <?php if( has_tag() ) { ?>
     <div class="tag">
          <?php
            echo '<span>'.esc_html__('Tags:','dotus').'</span>';
            $tag_list = get_the_tags();
            if($tag_list) {
              echo the_tags( ' <ul><li>', '</li><li>', '</li></ul>' );
           } ?>
      </div>
  </div>
  <div class="tag-share-s2 clearfix">
      <?php } 
      if ( $dotus_single_share_option && function_exists('dotus_wp_share_option') ) {
            echo dotus_wp_share_option();
        }
     ?>
  </div>
</div>
<?php
}
if( !$dotus_single_author_info ) {
	dotus_author_info();
	}
?>

