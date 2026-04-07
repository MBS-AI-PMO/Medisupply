<?php
/*
 * All Custom Shortcode for [theme_name] theme.
 * Author & Copyright: wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

if( ! function_exists( 'dotus_shortcodes' ) ) {
  function dotus_shortcodes( $options ) {

    $options       = array();

    /* Topbar Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Topbar Shortcodes', 'dotus'),
      'shortcodes' => array(

        // Topbar item
        array(
          'name'          => 'dotus_widget_topbars',
          'title'         => esc_html__('Topbar info', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_widget_topbar',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
            
          ),
          'clone_fields'  => array(

            array(
              'id'        => 'info_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Icon', 'dotus'),
            ),
            array(
              'id'        => 'subtitle',
              'type'      => 'text',
              'title'     => esc_html__('Sub Title', 'dotus'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'dotus'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'dotus'),
            ),
            array(
              'id'        => 'open_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'dotus'),
              'yes'     => esc_html__('Yes', 'dotus'),
              'no'     => esc_html__('No', 'dotus'),
            ),

          ),

        ),
       

      ),
    );

    /* Header Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Header Shortcodes', 'dotus'),
      'shortcodes' => array(

        // header Social
        array(
          'name'          => 'dotus_header_socials',
          'title'         => esc_html__('Header Social', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_header_social',
          'clone_title'   => esc_html__('Add New Social', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
            array(
              'id'        => 'custom_text',
              'type'      => 'text',
              'title'     => esc_html__('Custom Title', 'dotus'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'dotus')
            ),
            array(
              'id'        => 'social_icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'dotus'),
            ),
            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'title'     => esc_html__('Social Link', 'dotus')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'dotus'),
              'yes'     => esc_html__('Yes', 'dotus'),
              'no'     => esc_html__('No', 'dotus'),
            ),

          ),

        ),
        // header Social End

        // header Middle Infos
        array(
          'name'          => 'dotus_header_middle_infos',
          'title'         => esc_html__('Header Middle Info', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_header_middle_info',
          'clone_title'   => esc_html__('Add New Info', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'dotus')
            ),
            array(
              'id'        => 'social_icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'dotus'),
            ),
            array(
              'id'        => 'address_text',
              'type'      => 'text',
              'title'     => esc_html__('Address Text', 'dotus')
            ),
            array(
              'id'        => 'address_desc',
              'type'      => 'text',
              'title'     => esc_html__('Address Details', 'dotus')
            ),
          ),

        ),
        // header Middle Infos End



      ),
    );

    /* Content Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Content Shortcodes', 'dotus'),
      'shortcodes' => array(

        // Spacer
        array(
          'name'          => 'vc_empty_space',
          'title'         => esc_html__('Spacer', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'height',
              'type'      => 'text',
              'title'     => esc_html__('Height', 'dotus'),
              'attributes' => array(
                'placeholder'     => '20px',
              ),
            ),

          ),
        ),
        // Spacer

        // Social Icons
        array(
          'name'          => 'dotus_socials',
          'title'         => esc_html__('Social Icons', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_social',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),  
            array(
              'id'        => 'section_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'dotus'),
            ),

            // Colors
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Colors', 'dotus')
            ),
            array(
              'id'        => 'icon_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Color', 'dotus'),
              'wrap_class' => 'column_third',
            ),
            array(
              'id'        => 'icon_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Icon Hover Color', 'dotus'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '!=', 'style-three'),
            ),
            array(
              'id'        => 'bg_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Backrgound Color', 'dotus'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '!=', 'style-one'),
            ),
            array(
              'id'        => 'bg_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Backrgound Hover Color', 'dotus'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '==', 'style-two'),
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'dotus'),
              'wrap_class' => 'column_third',
              'dependency'  => array('social_select', '==', 'style-three'),
            ),

            // Icon Size
            array(
              'id'        => 'icon_size',
              'type'      => 'text',
              'title'     => esc_html__('Icon Size', 'dotus'),
              'wrap_class' => 'column_full',
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
              'title'     => esc_html__('Link', 'dotus')
            ),
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'dotus')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'dotus'),
              'on_text'     => esc_html__('Yes', 'dotus'),
              'off_text'     => esc_html__('No', 'dotus'),
            ),

          ),

        ),
        // Social Icons

        // Useful Links
        array(
          'name'          => 'dotus_useful_links',
          'title'         => esc_html__('Useful Links', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_useful_link',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'column_width',
              'type'      => 'select',
              'title'     => esc_html__('Column Width', 'dotus'),
              'options'        => array(
                'full-width' => esc_html__('One Column', 'dotus'),
                'half-width' => esc_html__('Two Column', 'dotus'),
                'third-width' => esc_html__('Three Column', 'dotus'),
              ),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'title_link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'dotus')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'dotus'),
              'on_text'     => esc_html__('Yes', 'dotus'),
              'off_text'     => esc_html__('No', 'dotus'),
            ),
            array(
              'id'        => 'link_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'dotus')
            ),

          ),

        ),
        // Useful Links

        // Simple Image List
        array(
          'name'          => 'dotus_image_lists',
          'title'         => esc_html__('Simple Image List', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_image_list',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'get_image',
              'type'      => 'upload',
              'title'     => esc_html__('Image', 'dotus')
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
              'title'     => esc_html__('Link', 'dotus')
            ),
            array(
              'id'    => 'open_tab',
              'type'  => 'switcher',
              'std'   => false,
              'title' => esc_html__('Open link to new tab?', 'dotus')
            ),

          ),

        ),
        // Simple Image List

        // Simple Link
        array(
          'name'          => 'dotus_simple_link',
          'title'         => esc_html__('Simple Link', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'link_style',
              'type'      => 'select',
              'title'     => esc_html__('Link Style', 'dotus'),
              'options'        => array(
                'link-underline' => esc_html__('Link Underline', 'dotus'),
                'link-arrow-right' => esc_html__('Link Arrow (Right)', 'dotus'),
                'link-arrow-left' => esc_html__('Link Arrow (Left)', 'dotus'),
              ),
            ),
            array(
              'id'        => 'link_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Icon', 'dotus'),
              'value'      => 'fa fa-caret-right',
              'dependency'  => array('link_style', '!=', 'link-underline'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link Text', 'dotus'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'dotus'),
              'attributes' => array(
                'placeholder'     => 'http://',
              ),
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'dotus'),
              'on_text'     => esc_html__('Yes', 'dotus'),
              'off_text'     => esc_html__('No', 'dotus'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),

            // Normal Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Normal Mode', 'dotus')
            ),
            array(
              'id'        => 'text_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Text Color', 'dotus'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'dotus'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),
            // Hover Mode
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Hover Mode', 'dotus')
            ),
            array(
              'id'        => 'text_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Text Hover Color', 'dotus'),
              'wrap_class' => 'column_half el-hav-border',
            ),
            array(
              'id'        => 'border_hover_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Hover Color', 'dotus'),
              'wrap_class' => 'column_half el-hav-border',
              'dependency'  => array('link_style', '==', 'link-underline'),
            ),

            // Size
            array(
              'type'    => 'notice',
              'class'   => 'info',
              'content' => esc_html__('Font Sizes', 'dotus')
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => esc_html__('Text Size', 'dotus'),
              'attributes' => array(
                'placeholder'     => 'Eg: 14px',
              ),
            ),

          ),
        ),
        // Simple Link

        // Blockquotes
        array(
          'name'          => 'dotus_blockquote',
          'title'         => esc_html__('Blockquote', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'blockquote_style',
              'type'      => 'select',
              'title'     => esc_html__('Blockquote Style', 'dotus'),
              'options'        => array(
                '' => esc_html__('Select Blockquote Style', 'dotus'),
                'style-one' => esc_html__('Style One', 'dotus'),
                'style-two' => esc_html__('Style Two', 'dotus'),
              ),
            ),
            array(
              'id'        => 'text_size',
              'type'      => 'text',
              'title'     => esc_html__('Text Size', 'dotus'),
            ),
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
            array(
              'id'        => 'content_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Content Color', 'dotus'),
            ),
            array(
              'id'        => 'left_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Left Border Color', 'dotus'),
            ),
            array(
              'id'        => 'border_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Border Color', 'dotus'),
            ),
            array(
              'id'        => 'bg_color',
              'type'      => 'color_picker',
              'title'     => esc_html__('Background Color', 'dotus'),
            ),
            // Content
            array(
              'id'        => 'content',
              'type'      => 'textarea',
              'title'     => esc_html__('Content', 'dotus'),
            ),

          ),

        ),
        // Blockquotes

      ),
    );

    /* Widget Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Widget Shortcodes', 'dotus'),
      'shortcodes' => array(

        // widget Contact info
        array(
          'name'          => 'dotus_widget_contact_info',
          'title'         => esc_html__('Service CTA', 'dotus'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
             array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('Image background', 'dotus'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'dotus'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'text',
              'title'     => esc_html__('SubTitle', 'dotus'),
            ),
            array(
              'id'        => 'number',
              'type'      => 'text',
              'title'     => esc_html__('Number', 'dotus'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link text', 'dotus'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'dotus'),
            ),

          ),
        ),

        // widget Testimonials
        array(
          'name'          => 'dotus_widget_testimonial',
          'title'         => esc_html__('Testimonial', 'dotus'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
             array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('Image background', 'dotus'),
            ),
            array(
              'id'        => 'subtitle',
              'type'      => 'text',
              'title'     => esc_html__('Sub Title', 'dotus'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'dotus'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'dotus'),
            ),

          ),
        ),

       // About widget Block
        array(
          'name'          => 'dotus_about_widget',
          'title'         => esc_html__('About Widget Block', 'dotus'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'dotus'),
            ),
            array(
              'id'        => 'image_url',
              'type'      => 'image',
              'title'     => esc_html__('About Block Image', 'dotus'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'dotus'),
            ),
            array(
              'id'        => 'link_text',
              'type'      => 'text',
              'title'     => esc_html__('Link text', 'dotus'),
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Link', 'dotus'),
            ),

          ),
        ),


      // Service Contact Widget
        array(
          'name'          => 'dotus_service_widget_contacts',
          'title'         => esc_html__('Service Feature Widget', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_service_widget_contact',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
            array(
              'id'        => 'contact_title',
              'type'      => 'text',
              'title'     => esc_html__('Title', 'dotus')
            ),
          ),
          'clone_fields'  => array(
           
             array(
              'id'        => 'info',
              'type'      => 'text',
              'title'     => esc_html__('Contact Info', 'dotus')
            ),

          ),

        ),
      // Service Contact Widget End
        // widget download-widget
        array(
          'name'          => 'dotus_download_widgets',
          'title'         => esc_html__('Download Widget', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_download_widget',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
          ),
          'clone_fields'  => array(

            array(
              'id'        => 'download_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Download Icon', 'dotus')
            ),
            array(
              'id'        => 'title',
              'type'      => 'text',
              'title'     => esc_html__('Download Title', 'dotus')
            ),
            array(
              'id'        => 'link',
              'type'      => 'text',
              'title'     => esc_html__('Download Link', 'dotus')
            ),

          ),

        ),

      ),
    );

    /* Footer Shortcodes */
    $options[]     = array(
      'title'      => esc_html__('Footer Shortcodes', 'dotus'),
      'shortcodes' => array(

        // Footer Menus
        array(
          'name'          => 'dotus_footer_menus',
          'title'         => esc_html__('Footer Menu Links', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_footer_menu',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),

          ),
          'clone_fields'  => array(

            array(
              'id'        => 'menu_title',
              'type'      => 'text',
              'title'     => esc_html__('Menu Title', 'dotus')
            ),
            array(
              'id'        => 'menu_link',
              'type'      => 'text',
              'title'     => esc_html__('Menu Link', 'dotus')
            ),
            array(
              'id'        => 'target_tab',
              'type'      => 'switcher',
              'title'     => esc_html__('Open New Tab?', 'dotus'),
              'on_text'     => esc_html__('Yes', 'dotus'),
              'off_text'     => esc_html__('No', 'dotus'),
            ),

          ),

        ),
        // Footer Menus
        array(
          'name'          => 'footer_infos',
          'title'         => esc_html__('footer logo and Text', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'footer_info',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(
            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),
            array(
              'id'        => 'footer_logo',
              'type'      => 'image',
              'title'     => esc_html__('Footer logo', 'dotus'),
            ),
            array(
              'id'        => 'desc',
              'type'      => 'textarea',
              'title'     => esc_html__('Description', 'dotus'),
            ),
            
          ),
          'clone_fields'  => array(
            array(
              'id'        => 'social_icon',
              'type'      => 'icon',
              'title'     => esc_html__('Social Icon', 'dotus')
            ),
            array(
              'id'        => 'social_link',
              'type'      => 'text',
              'title'     => esc_html__('Social Link', 'dotus')
            ),
          ),

        ),

      // footer contact info
      array(
        'name'          => 'dotus_footer_contact_infos',
        'title'         => esc_html__('Contact info', 'dotus'),
        'view'          => 'clone',
        'clone_id'      => 'dotus_footer_contact_info',
        'clone_title'   => esc_html__('Add New', 'dotus'),
        'fields'        => array(

          array(
            'id'        => 'custom_class',
            'type'      => 'text',
            'title'     => esc_html__('Custom Class', 'dotus'),
          ),
          array(
            'id'        => 'contact_title',
            'type'      => 'textarea',
            'title'     => esc_html__('Contact info title', 'dotus')
          ),
        ),
        'clone_fields'  => array(

          array(
            'id'        => 'Icon',
            'type'      => 'icon',
            'title'     => esc_html__('Contact info icon', 'dotus')
          ),
          array(
            'id'        => 'item_title',
            'type'      => 'text',
            'title'     => esc_html__('Contact info title', 'dotus')
          ),
        ),

      ),

      // footer Address
       array(
          'name'          => 'dotus_footer_address_item',
          'title'         => esc_html__('Address', 'dotus'),
          'view'          => 'clone',
          'clone_id'      => 'dotus_footer_address_items',
          'clone_title'   => esc_html__('Add New', 'dotus'),
          'fields'        => array(

            array(
              'id'        => 'custom_class',
              'type'      => 'text',
              'title'     => esc_html__('Custom Class', 'dotus'),
            ),

          ),
          'clone_fields'  => array(
            array(
              'id'        => 'item',
              'type'      => 'text',
              'title'     => esc_html__('Address item', 'dotus')
            ),
          ),
        ),

      ),
    );

  return $options;

  }
  add_filter( 'cs_shortcode_options', 'dotus_shortcodes' );
}