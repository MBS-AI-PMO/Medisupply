<?php
/*
 * All Metabox related options for Dotus theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function dotus_metabox_options( $options ) {


  $header = get_posts( 'post_type="headerbuilder"&numberposts=-1' );
  $headers = array( 'theme' => esc_html__( 'Default', 'dotus' ) );
  if ( $header ) {
    foreach ( $header as $head ) {
      $headers[ $head->ID ] = $head->post_title;
    }
  }
  $footer = get_posts( 'post_type="footerbuilder"&numberposts=-1' );
  $footers = array( 'theme' => esc_html__( 'Default', 'dotus' ));
  if ( $footer ) {
    foreach ( $footer as $foot ) {
      $footers[ $foot->ID ] = $foot->post_title;
    }
  }


  $options      = array();

  // -----------------------------------------
  // Post Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_type_metabox',
    'title'     => esc_html__('Post Options', 'dotus'),
    'post_type' => 'post',
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_post_formats',
        'fields' => array(

          // Standard, Image
          array(
            'title' => 'Standard Image',
            'type'  => 'subheading',
            'content' => esc_html__('There is no Extra Option for this Post Format!', 'dotus'),
            'wrap_class' => 'dotus-minimal-heading hide-title',
          ),
          // Standard, Image

          // Gallery
          array(
            'type'    => 'notice',
            'title'   => 'Gallery Format',
            'wrap_class' => 'hide-title',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Gallery Format', 'dotus')
          ),
          array(
            'id'          => 'gallery_post_format',
            'type'        => 'gallery',
            'title'       => esc_html__('Add Gallery', 'dotus'),
            'add_title'   => esc_html__('Add Image(s)', 'dotus'),
            'edit_title'  => esc_html__('Edit Image(s)', 'dotus'),
            'clear_title' => esc_html__('Clear Image(s)', 'dotus'),
          ),
          array(
            'type'    => 'text',
            'title'   => esc_html__('Add Video URL', 'dotus' ),
            'id'   => 'video_post_format',
            'desc' => esc_html__('Add youtube or vimeo video link', 'dotus' ),
            'wrap_class' => 'video_post_format',
          ),
          array(
            'type'    => 'icon',
            'title'   => esc_html__('Add Quote Icon', 'dotus' ),
            'id'   => 'quote_post_format',
            'desc' => esc_html__('Add Quote Icon here', 'dotus' ),
            'wrap_class' => 'quote_post_format',
          ),
          // Gallery

        ),
      ),

    ),
  );

  // -----------------------------------------
  // Page Metabox Options                    -
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_type_metabox',
    'title'     => esc_html__('Page Custom Options', 'dotus'),
    'post_type' => array('post', 'page'),
    'context'   => 'normal',
    'priority'  => 'default',
    'sections'  => array(

      // Title Section
      array(
        'name'  => 'page_topbar_section',
        'title' => esc_html__('Top Bar', 'dotus'),
        'icon'  => 'fa fa-minus',

        // Fields Start
        'fields' => array(

          array(
            'id'           => 'topbar_options',
            'type'         => 'image_select',
            'title'        => esc_html__('Topbar', 'dotus'),
            'options'      => array(
              'default'     => DOTUS_CS_IMAGES .'/topbar-default.png',
              'custom'      => DOTUS_CS_IMAGES .'/topbar-custom.png',
              'hide_topbar' => DOTUS_CS_IMAGES .'/topbar-hide.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'hide_topbar_select',
            ),
            'radio'     => true,
            'default'   => 'default',
          ),
          array(
            'id'          => 'top_left',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Left', 'dotus'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'          => 'top_right',
            'type'        => 'textarea',
            'title'       => esc_html__('Top Right', 'dotus'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
            'shortcode'       => true,
          ),
          array(
            'id'    => 'topbar_bg',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Background Color', 'dotus'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),
          array(
            'id'    => 'topbar_border',
            'type'  => 'color_picker',
            'title' => esc_html__('Topbar Border Color', 'dotus'),
            'dependency'  => array('hide_topbar_select', '==', 'custom'),
          ),

        ), // End : Fields

      ), // Title Section

      // Header
      array(
        'name'  => 'header_section',
        'title' => esc_html__('Header & Footer', 'dotus'),
        'icon'  => 'fa fa-bars',
        'fields' => array(
          array(
            'id'           => 'select_header_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Header Design', 'dotus'),
            'options'      => $headers,
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'dotus'),
          ),
          array(
            'id'           => 'select_footer_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Footer Design', 'dotus'),
            'options'      => $footers,
            'attributes' => array(
              'data-depend-id' => 'footer_design',
            ),
            'radio'     => true,
            'default'   => 'default',
            'info'      => esc_html__('Select your footer design, following options will may differ based on your selection of footer design.', 'dotus'),
          ),
        ),
      ),
      // Header

      // Banner & Title Area
      array(
        'name'  => 'banner_title_section',
        'title' => esc_html__('Banner & Title Area', 'dotus'),
        'icon'  => 'fa fa-bullhorn',
        'fields' => array(

          array(
            'id'        => 'banner_type',
            'type'      => 'select',
            'title'     => esc_html__('Choose Banner Type', 'dotus'),
            'options'   => array(
              'default-title'    => 'Default Title',
              'revolution-slider' => 'Shortcode [Rev Slider]',
              'hide-title-area'   => 'Hide Title/Banner Area',
            ),
          ),
          array(
            'id'    => 'page_revslider',
            'type'  => 'textarea',
            'title' => esc_html__('Revolution Slider or Any Shortcodes', 'dotus'),
            'desc' => __('Enter any shortcodes that you want to show in this page title area. <br />Eg : Revolution Slider shortcode.', 'dotus'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your shortcode...', 'dotus'),
            ),
            'dependency'   => array('banner_type', '==', 'revolution-slider'),
          ),
          array(
            'id'    => 'page_custom_title',
            'type'  => 'text',
            'title' => esc_html__('Custom Title', 'dotus'),
            'attributes' => array(
              'placeholder' => esc_html__('Enter your custom title...', 'dotus'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'        => 'title_area_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Title Area Spacings', 'dotus'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'dotus'),
              'padding-custom' => esc_html__('Custom Padding', 'dotus'),
            ),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'dotus'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'dotus'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('banner_type|title_area_spacings', '==|==', 'default-title|padding-custom'),
          ),
          array(
            'id'    => 'title_area_bg',
            'type'  => 'background',
            'title' => esc_html__('Background', 'dotus'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'titlebar_bg_overlay_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Overlay Color', 'dotus'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'dotus'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

        ),
      ),
      // Banner & Title Area

      // Content Section
      array(
        'name'  => 'page_content_options',
        'title' => esc_html__('Content Options', 'dotus'),
        'icon'  => 'fa fa-file',

        'fields' => array(

          array(
            'id'        => 'content_spacings',
            'type'      => 'select',
            'title'     => esc_html__('Content Spacings', 'dotus'),
            'options'   => array(
              'padding-default' => esc_html__('Default Spacing', 'dotus'),
              'padding-custom' => esc_html__('Custom Padding', 'dotus'),
            ),
            'desc' => esc_html__('Content area top and bottom spacings.', 'dotus'),
          ),
          array(
            'id'    => 'content_top_spacings',
            'type'  => 'text',
            'title' => esc_html__('Top Spacing', 'dotus'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
          array(
            'id'    => 'content_bottom_spacings',
            'type'  => 'text',
            'title' => esc_html__('Bottom Spacing', 'dotus'),
            'attributes'  => array( 'placeholder' => '100px' ),
            'dependency'  => array('content_spacings', '==', 'padding-custom'),
          ),
        ), // End Fields
      ), // Content Section

      // Enable & Disable
      array(
        'name'  => 'hide_show_section',
        'title' => esc_html__('Enable & Disable', 'dotus'),
        'icon'  => 'fa fa-toggle-on',
        'fields' => array(

          array(
            'id'    => 'hide_header',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Header', 'dotus'),
            'label' => esc_html__('Yes, Please do it.', 'dotus'),
          ),
          array(
            'id'    => 'hide_breadcrumbs',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Breadcrumbs', 'dotus'),
            'label' => esc_html__('Yes, Please do it.', 'dotus'),
          ),
          array(
            'id'    => 'hide_footer',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Footer', 'dotus'),
            'label' => esc_html__('Yes, Please do it.', 'dotus'),
          ),
       
        ),
      ),
      // Enable & Disable

    ),
  );

  // -----------------------------------------
  // Page Layout
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'page_layout_options',
    'title'     => esc_html__('Page Layout', 'dotus'),
    'post_type' => 'page',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'page_layout_section',
        'fields' => array(

          array(
            'id'        => 'page_layout',
            'type'      => 'image_select',
            'options'   => array(
              'full-width'    => DOTUS_CS_IMAGES . '/page-1.png',
              'extra-width'   => DOTUS_CS_IMAGES . '/page-2.png',
              'left-sidebar'  => DOTUS_CS_IMAGES . '/page-3.png',
              'right-sidebar' => DOTUS_CS_IMAGES . '/page-4.png',
            ),
            'attributes' => array(
              'data-depend-id' => 'page_layout',
            ),
            'default'    => 'full-width',
            'radio'      => true,
            'wrap_class' => 'text-center',
          ),
          array(
            'id'            => 'page_sidebar_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'dotus'),
            'options'        => dotus_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'dotus'),
            'dependency'   => array('page_layout', 'any', 'left-sidebar,right-sidebar'),
          ),

        ),
      ),

    ),
  );


// -----------------------------------------
  // Project
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'project_options',
    'title'     => esc_html__('Project Extra Options', 'dotus'),
    'post_type' => 'project',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'project_option_section',
        'fields' => array(
          array(
            'id'           => 'project_title',
            'type'         => 'text',
            'title'        => esc_html__('Project title', 'dotus'),
            'add_title' => esc_html__('Add Project title', 'dotus'),
            'attributes' => array(
              'placeholder' => esc_html__('Project Title', 'dotus'),
            ),
            'info'    => esc_html__('Write Project Title.', 'dotus'),
          ),   
          array(
            'id'           => 'project_image',
            'type'         => 'image',
            'title'        => esc_html__('Project Image', 'dotus'),
            'add_title' => esc_html__('Add Project Image', 'dotus'),
          ),
           // Start fields
        ),
      ),

    ),
  );



 // -----------------------------------------
  // Service
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'service_options',
    'title'     => esc_html__('Service Meta', 'dotus'),
    'post_type' => 'service',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'service_infos',
        'fields' => array(
         array(
            'id'           => 'service_icon',
            'type'         => 'icon',
            'title'        => esc_html__('Service Icon', 'dotus'),
            'add_title' => esc_html__('Service Icon', 'dotus'),
            'info'    => esc_html__('Attached Icon.', 'dotus'),
          ),

        ),
      ),
    ),
  );


if (class_exists( 'WooCommerce' )){ 
   // -----------------------------------------
    // Product
    // -----------------------------------------
    $options[]    = array(
      'id'        => 'dotus_woocommerce_section',
      'title'     => esc_html__('Product Title', 'dotus'),
      'post_type' => 'product',
      'context'   => 'normal',
      'priority'  => 'high',
      'sections'  => array(

        // All Post Formats
        array(
          'name'   => 'dotus_single_title',
          'fields' => array(
            array(
              'id'          => 'dotus_product_title',
              'type'        => 'text',
              'title'       => esc_html__('Single Title', 'dotus'),
              'attributes' => array(
                'placeholder' => 'The Title Gose Here'
              ),
            ),

          ),
        ),

      ),
    );
}
// -----------------------------------------
  // Donation Forms
  // -----------------------------------------
  $options[]    = array(
    'id'        => '_donation_form_metabox',
    'title'     => esc_html__('Donation Deadline', 'dotus'),
    'post_type' => 'give_forms',
    'context'   => 'normal',
    'priority'  => 'high',
    'sections'  => array(

      // All Post Formats
      array(
        'name'   => 'section_deadline',
        'fields' => array(
          array(
            'id'          => 'donation_deadline',
            'type'        => 'text',
            'title'       => esc_html__('Deadline Date', 'dotus'),
            'attributes' => array(
              'placeholder' => 'DD/MM/YYYY'
            ),
          ),
          // Gallery

        ),
      ),

    ),
  );
  

   // -----------------------------------------
  // Team
  // -----------------------------------------

  $options[]    = array(
    'id'        => 'team_options',
    'title'     => esc_html__('Team Meta', 'dotus'),
    'post_type' => 'team',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'team_infos',
        'fields' => array(
          array(
            'title'   => esc_html__('Team Sub Title', 'dotus'),
            'id'      => 'team_subtitle',
            'type'    => 'text',
            'attributes' => array(
              'placeholder' => esc_html__('Councilor, District', 'dotus'),
            ),
            'info'    => esc_html__('Write Team Sub Title.', 'dotus'),
          ),
          // Start fields
          array(
            'id'                  => 'team_socials',
            'title'   => esc_html__('Team Social', 'dotus'),
            'type'                => 'group',
            'fields'              => array(
              array(
                'id'              => 'social_icon',
                'type'            => 'icon',
                'attributes' => array(
                    'placeholder' => esc_html__('Facebook', 'dotus'),
                  ),
                'title'           => esc_html__('Social Icon', 'dotus'),
              ),
              array(
                'id'              => 'social_link',
                'type'            => 'text',
                'attributes' => array(
                    'placeholder' => esc_html__('#', 'dotus'),
                  ),
                'title'           => esc_html__('Socail Link', 'dotus'),
              ),
            ),
            'button_title'        => esc_html__('Add Social', 'dotus'),
            'accordion_title'     => esc_html__('Team Social ', 'dotus'),
          ),
         array(
            'id'           => 'team_image',
            'type'         => 'image',
            'title'        => esc_html__('Team Grid Image', 'dotus'),
            'add_title' => esc_html__('Team Image', 'dotus'),
            'info'    => esc_html__('Attached Team Grid Image.', 'dotus'),
          ),

        ),
      ),
    ),
  );


  // -----------------------------------------
  // Causes
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'causes_options',
    'title'     => esc_html__('Causes Extra Options', 'dotus'),
    'post_type' => 'give_forms',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(

      array(
        'name'   => 'causes_option_section',
        'fields' => array(
         array(
            'id'           => 'causes_image',
            'type'         => 'image',
            'title'        => esc_html__('Causes Image', 'dotus'),
            'add_title' => esc_html__('Add Causes Image', 'dotus'),
          ),
         array(
            'id'           => 'causes_slide_image',
            'type'         => 'image',
            'title'        => esc_html__('Carousel Image', 'dotus'),
            'add_title' => esc_html__('Add Carousel Image', 'dotus'),
          ),
         array(
            'id'           => 'case_type',
            'type'         => 'text',
            'default'    => 'Conference',
            'title'        => esc_html__('Case Type', 'dotus'),
            'add_title' => esc_html__('Add Case type here', 'dotus'),
          ),
         array(
            'id'           => 'case_date_time',
            'type'         => 'text',
            'default'    => 'July 2, 2023 @ 15:00 - 19:00',
            'title'        => esc_html__('Case date', 'dotus'),
            'add_title' => esc_html__('Add Case date here', 'dotus'),
          ),
         array(
            'id'           => 'case_location',
            'type'         => 'text',
            'default'    => '85 Preston Rd. Inglewood',
            'title'        => esc_html__('Case location', 'dotus'),
            'add_title' => esc_html__('Add Case location here', 'dotus'),
          ),
        ),
      ),

    ),
  );

  // -----------------------------------------
  // post options
  // -----------------------------------------
  $options[]    = array(
    'id'        => 'post_options',
    'title'     => esc_html__('Grid Image', 'dotus'),
    'post_type' => 'post',
    'context'   => 'side',
    'priority'  => 'default',
    'sections'  => array(
      array(
        'name'   => 'post_option_section',
        'fields' => array(
          array(
            'id'           => 'grid_image',
            'type'         => 'image',
            'title'        => esc_html__('Grid Image', 'dotus'),
            'add_title' => esc_html__('Add Grid Image', 'dotus'),
          ),
          array(
            'id'           => 'widget_post_title',
            'type'         => 'text',
            'title'        => esc_html__('Widget Post Title', 'dotus'),
            'add_title' => esc_html__('Add Widget Post Title here', 'dotus'),
          ),
        ),
      ),

    ),
  );


  return $options;

}
add_filter( 'cs_metabox_options', 'dotus_metabox_options' );