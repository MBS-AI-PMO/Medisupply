<?php
/*
 * All Theme Options for Dotus theme.
 * Author & Copyright:wpoceans
 * URL: http://themeforest.net/user/wpoceans
 */

function dotus_settings( $settings ) {

  $settings           = array(
    'menu_title'      => DOTUS_NAME . esc_html__(' Options', 'dotus'),
    'menu_slug'       => sanitize_title(DOTUS_NAME) . '_options',
    'menu_type'       => 'theme',
    'menu_icon'       => 'dashicons-awards',
    'menu_position'   => '4',
    'ajax_save'       => false,
    'show_reset_all'  => true,
    'framework_title' => DOTUS_NAME .' <small>V-'. DOTUS_VERSION .' by <a href="'. DOTUS_BRAND_URL .'" target="_blank">'. DOTUS_BRAND_NAME .'</a></small>',
  );

  return $settings;

}
add_filter( 'cs_framework_settings', 'dotus_settings' );

// Theme Framework Options
function dotus_options( $options ) {

  $header = get_posts( 'post_type="headerbuilder"&numberposts=-1' );
  $headers = array( 'default' => esc_html__( 'Default', 'dotus' ) );
  if ( $header ) {
    foreach ( $header as $head ) {
      $headers[ $head->ID ] = $head->post_title;
    }
  }
  $footer = get_posts( 'post_type="footerbuilder"&numberposts=-1' );
  $footers = array( 'default' => esc_html__( 'Default', 'dotus' ));
  if ( $footer ) {
    foreach ( $footer as $foot ) {
      $footers[ $foot->ID ] = $foot->post_title;
    }
  }

  $options      = array(); // remove old options

  // ------------------------------
  // Branding
  // ------------------------------
  $options[]   = array(
    'name'     => 'dotus_theme_branding',
    'title'    => esc_html__('Site Brand', 'dotus'),
    'icon'     => 'fa fa-address-book-o',
    'sections' => array(

      // brand logo tab
      array(
        'name'     => 'brand_logo',
        'title'    => esc_html__('Logo', 'dotus'),
        'icon'     => 'fa fa-picture-o',
        'fields'   => array(

          // Site Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Site Logo', 'dotus')
          ),
          array(
            'id'    => 'dotus_logo',
            'type'  => 'image',
            'title' => esc_html__('Default Logo', 'dotus'),
            'info'  => esc_html__('Upload your default logo here. If you not upload, then site title will load in this logo location.', 'dotus'),
            'add_title' => esc_html__('Add Logo', 'dotus'),
          ),
          array(
            'id'          => 'dotus_logo_top',
            'type'        => 'number',
            'title'       => esc_html__('Logo Top Space', 'dotus'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          array(
            'id'          => 'dotus_logo_bottom',
            'type'        => 'number',
            'title'       => esc_html__('Logo Bottom Space', 'dotus'),
            'attributes'  => array( 'placeholder' => 5 ),
            'unit'        => 'px',
          ),
          // WordPress Admin Logo
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('WordPress Admin Logo', 'dotus')
          ),
          array(
            'id'    => 'brand_logo_wp',
            'type'  => 'image',
            'title' => esc_html__('Login logo', 'dotus'),
            'info'  => esc_html__('Upload your WordPress login page logo here.', 'dotus'),
            'add_title' => esc_html__('Add Login Logo', 'dotus'),
          ),
        ) // end: fields
      ), // end: section
    ),
  );

  // ------------------------------
  // Layout
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_layout',
    'title'  => esc_html__('Theme Layout', 'dotus'),
    'icon'   => 'fa fa-th-large'
  );

  $options[]      = array(
    'name'        => 'theme_general',
    'title'       => esc_html__('General Settings', 'dotus'),
    'icon'        => 'fa fa-cog',

    // begin: fields
    'fields'      => array(

      // -----------------------------
      // Begin: Responsive
      // -----------------------------
       array(
        'id'    => 'theme_responsive',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Responsive', 'dotus'),
        'info' => esc_html__('Turn on if you don\'t want your site to be responsive.', 'dotus'),
        'default' => false,
      ),
      array(
        'id'    => 'theme_preloder',
        'off_text'  => 'No',
        'on_text'  => 'Yes',
        'type'  => 'switcher',
        'title' => esc_html__('Preloder', 'dotus'),
        'info' => esc_html__('Turn off if you don\'t want your site to be Preloder.', 'dotus'),
        'default' => true,
      ),
       array(
        'id'    => 'preloader_image',
        'type'  => 'image',
        'title' => esc_html__('Preloader Logo', 'dotus'),
        'info'  => esc_html__('Upload your preoader logo here. If you not upload, then site preoader will load in this preloader location.', 'dotus'),
        'add_title' => esc_html__('Add Logo', 'dotus'),
        'dependency' => array( 'theme_preloder', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_width',
        'type'  => 'image_select',
        'title' => esc_html__('Full Width & Extra Width', 'dotus'),
        'info' => esc_html__('Boxed or Fullwidth? Choose your site layout width. Default : Full Width', 'dotus'),
        'options'      => array(
          'container'    => DOTUS_CS_IMAGES .'/boxed-width.jpg',
          'container-fluid'    => DOTUS_CS_IMAGES .'/full-width.jpg',
        ),
        'default'      => 'container-fluid',
        'radio'      => true,
      ),
       array(
        'id'    => 'theme_page_comments',
        'type'  => 'switcher',
        'title' => esc_html__('Hide Page Comments?', 'dotus'),
        'label' => esc_html__('Yes! Hide Page Comments.', 'dotus'),
        'on_text' => esc_html__('Yes', 'dotus'),
        'off_text' => esc_html__('No', 'dotus'),
        'default' => false,
      ),
      array(
        'type'    => 'notice',
        'class'   => 'info cs-dotus-heading',
        'content' => esc_html__('Background Options', 'dotus'),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'             => 'theme_layout_bg_type',
        'type'           => 'select',
        'title'          => esc_html__('Background Type', 'dotus'),
        'options'        => array(
          'bg-image' => esc_html__('Image', 'dotus'),
          'bg-pattern' => esc_html__('Pattern', 'dotus'),
        ),
        'dependency' => array( 'theme_layout_width_container', '==', 'true' ),
      ),
      array(
        'id'    => 'theme_layout_bg_pattern',
        'type'  => 'image_select',
        'title' => esc_html__('Background Pattern', 'dotus'),
        'info' => esc_html__('Select background pattern', 'dotus'),
        'options'      => array(
          'pattern-1'    => DOTUS_CS_IMAGES . '/pattern-1.png',
          'pattern-2'    => DOTUS_CS_IMAGES . '/pattern-2.png',
          'pattern-3'    => DOTUS_CS_IMAGES . '/pattern-3.png',
          'pattern-4'    => DOTUS_CS_IMAGES . '/pattern-4.png',
          'custom-pattern'  => DOTUS_CS_IMAGES . '/pattern-5.png',
        ),
        'default'      => 'pattern-1',
        'radio'      => true,
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-pattern' ),
      ),
      array(
        'id'      => 'custom_bg_pattern',
        'type'    => 'upload',
        'title'   => esc_html__('Custom Pattern', 'dotus'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type|theme_layout_bg_pattern_custom-pattern', '==|==|==', 'true|bg-pattern|true' ),
        'info' => __('Select your custom background pattern. <br />Note, background pattern image will be repeat in all x and y axis. So, please consider all repeatable area will perfectly fit your custom patterns.', 'dotus'),
      ),
      array(
        'id'      => 'theme_layout_bg',
        'type'    => 'background',
        'title'   => esc_html__('Background', 'dotus'),
        'dependency' => array( 'theme_layout_width_container|theme_layout_bg_type', '==|==', 'true|bg-image' ),
      ),

    ), // end: fields

  );

  // ------------------------------
  // Header Sections
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_header_tab',
    'title'    => esc_html__('Header Settings', 'dotus'),
    'icon'     => 'fa fa-header',
    'sections' => array(

      // header design tab
      array(
        'name'     => 'header_design_tab',
        'title'    => esc_html__('Design', 'dotus'),
        'icon'     => 'fa fa-magic',
        'fields'   => array(

          // Header Select
          array(
            'id'           => 'select_header_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Header Design', 'dotus'),
            'options'      => $headers,
            'attributes' => array(
              'data-depend-id' => 'header_design',
            ),
            'radio'        => true,
            'default'   => 'default',
            'info' => esc_html__('Select your header design, following options will may differ based on your selection of header design.', 'dotus'),
          ),
          // Header Select

          // Extra's
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Extra\'s', 'dotus'),
          ),
          array(
            'id'    => 'sticky_header',
            'type'  => 'switcher',
            'title' => esc_html__('Sticky Header', 'dotus'),
            'info' => esc_html__('Turn On if you want your naviagtion bar on sticky.', 'dotus'),
            'default' => true,
          ),
          array(
            'id'    => 'dotus_cart_widget',
            'type'  => 'switcher',
            'title' => esc_html__('Header Cart', 'dotus'),
            'info' => esc_html__('Turn On if you want to Show Header Cart .', 'dotus'),
            'default' => false,
          ),
          array(
            'id'    => 'dotus_header_search',
            'type'  => 'switcher',
            'title' => esc_html__('Header Search', 'dotus'),
            'info' => esc_html__('Turn On if you want to Hide Header Search .', 'dotus'),
            'default' => false,
          ),
          array(
            'id'    => 'dotus_menu_cta',
            'type'  => 'switcher',
            'title' => esc_html__('Header CTA', 'dotus'),
            'info' => esc_html__('Turn On if you want to Show Header CTA .', 'dotus'),
            'default' => false,
          ),
          array(
            'id'    => 'header_cta_text',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Text', 'dotus'),
            'info' => esc_html__('Write Header CTA Text here.', 'dotus'),
            'type'        => 'text',
            'default' => 'Free Consulting',
            'dependency'  => array('dotus_menu_cta', '==', true),
          ),
          array(
            'id'    => 'header_cta_link',
            'type'  => 'text',
            'title' => esc_html__('Header CTA Link', 'dotus'),
            'info' => esc_html__('Write Header CTA Link here.', 'dotus'),
            'type'        => 'text',
            'default' => '#',
            'dependency'  => array('dotus_menu_cta', '==', true),
          ),
        )
      ),

      // header top bar
      array(
        'name'     => 'header_top_bar_tab',
        'title'    => esc_html__('Top Bar', 'dotus'),
        'icon'     => 'fa fa-minus',
        'fields'   => array(

          array(
            'id'          => 'top_bar',
            'type'        => 'switcher',
            'title'       => esc_html__('Hide Top Bar', 'dotus'),
            'on_text'     => esc_html__('Yes', 'dotus'),
            'off_text'    => esc_html__('No', 'dotus'),
            'default'     => true,
          ),
          array(
            'id'          => 'top_left',
            'title'       => esc_html__('Top left Block', 'dotus'),
            'desc'        => esc_html__('Top bar left block.', 'dotus'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
          array(
            'id'          => 'top_right',
            'title'       => esc_html__('Top Right Block', 'dotus'),
            'desc'        => esc_html__('Top bar right block.', 'dotus'),
            'type'        => 'textarea',
            'shortcode'   => true,
            'dependency'  => array('top_bar', '==', false),
          ),
        )
      ),

      // header banner
      array(
        'name'     => 'header_banner_tab',
        'title'    => esc_html__('Title Bar (or) Banner', 'dotus'),
        'icon'     => 'fa fa-bullhorn',
        'fields'   => array(

          // Title Area
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Title Area', 'dotus')
          ),
          array(
            'id'      => 'need_title_bar',
            'type'    => 'switcher',
            'title'   => esc_html__('Title Bar ?', 'dotus'),
            'label'   => esc_html__('If you want to Hide title bar in your sub-pages, please turn this ON.', 'dotus'),
            'default'    => false,
          ),
          array(
            'id'             => 'title_bar_padding',
            'type'           => 'select',
            'title'          => esc_html__('Padding Spaces Top & Bottom', 'dotus'),
            'options'        => array(
              'padding-default' => esc_html__('Default Spacing', 'dotus'),
              'padding-custom' => esc_html__('Custom Padding', 'dotus'),
            ),
            'dependency'   => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'             => 'titlebar_top_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Top', 'dotus'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),
          array(
            'id'             => 'titlebar_bottom_padding',
            'type'           => 'text',
            'title'          => esc_html__('Padding Bottom', 'dotus'),
            'attributes' => array(
              'placeholder'     => '100px',
            ),
            'dependency'   => array( 'title_bar_padding', '==', 'padding-custom' ),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Background Options', 'dotus'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'      => 'titlebar_bg_overlay_color',
            'type'    => 'color_picker',
            'title'   => esc_html__('Overlay Color', 'dotus'),
            'dependency' => array( 'need_title_bar', '==', 'false' ),
          ),
          array(
            'id'    => 'title_color',
            'type'  => 'color_picker',
            'title' => esc_html__('Title Color', 'dotus'),
            'dependency'   => array('banner_type', '==', 'default-title'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Breadcrumbs', 'dotus'),
          ),
         array(
            'id'      => 'need_breadcrumbs',
            'type'    => 'switcher',
            'title'   => esc_html__('Hide Breadcrumbs', 'dotus'),
            'label'   => esc_html__('If you want to hide breadcrumbs in your banner, please turn this ON.', 'dotus'),
            'default'    => false,
          ),
        )
      ),

    ),
  );

  // ------------------------------
  // Footer Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'footer_section',
    'title'    => esc_html__('Footer Settings', 'dotus'),
    'icon'     => 'fa fa-tasks',
    'sections' => array(

      // footer widgets
      array(
        'name'     => 'footer_widgets_tab',
        'title'    => esc_html__('Widget Area', 'dotus'),
        'icon'     => 'fa fa-th',
        'fields'   => array(
          array(
            'id'           => 'select_footer_design',
            'type'         => 'select',
            'title'        => esc_html__('Select Footer Design', 'dotus'),
            'options'      => $footers,
            'attributes' => array(
              'data-depend-id' => 'footer_design',
            ),
            'radio'        => true,
            'default'   => 'default',
            'info' => esc_html__('Select your footer design, following options will may differ based on your selection of footer design.', 'dotus'),
          ),
          // Footer Widget Block
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Footer Widget Block', 'dotus')
          ),
          array(
            'id'    => 'footer_widget_block',
            'type'  => 'switcher',
            'title' => esc_html__('Enable Widget Block', 'dotus'),
            'info' => __('If you turn this ON, then Goto : Appearance > Widgets. There you can see <strong>Footer Widget 1,2,3 or 4</strong> Widget Area, add your widgets there.', 'dotus'),
            'default' => true,
          ),
          array(
            'id'    => 'footer_widget_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Widget Layouts', 'dotus'),
            'info' => esc_html__('Choose your footer widget theme-layouts.', 'dotus'),
            'default' => 4,
            'options' => array(
              1   => DOTUS_CS_IMAGES . '/footer/footer-1.png',
              2   => DOTUS_CS_IMAGES . '/footer/footer-2.png',
              3   => DOTUS_CS_IMAGES . '/footer/footer-3.png',
              4   => DOTUS_CS_IMAGES . '/footer/footer-4.png',
              5   => DOTUS_CS_IMAGES . '/footer/footer-5.png',
              6   => DOTUS_CS_IMAGES . '/footer/footer-6.png',
              7   => DOTUS_CS_IMAGES . '/footer/footer-7.png',
              8   => DOTUS_CS_IMAGES . '/footer/footer-8.png',
              9   => DOTUS_CS_IMAGES . '/footer/footer-9.png',
            ),
            'radio'       => true,
            'dependency'  => array('footer_widget_block', '==', true),
          ),
           array(
            'id'    => 'dotus_ft_bg',
            'type'  => 'image',
            'title' => esc_html__('Footer Background', 'dotus'),
            'info'  => esc_html__('Upload your footer background.', 'dotus'),
            'add_title' => esc_html__('footer background', 'dotus'),
            'dependency'  => array('footer_widget_block', '==', true),
          ),

        )
      ),

      // footer copyright
      array(
        'name'     => 'footer_copyright_tab',
        'title'    => esc_html__('Copyright Bar', 'dotus'),
        'icon'     => 'fa fa-copyright',
        'fields'   => array(

          // Copyright
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Copyright Layout', 'dotus'),
          ),
         array(
            'id'    => 'hide_copyright',
            'type'  => 'switcher',
            'title' => esc_html__('Hide Copyright?', 'dotus'),
            'default' => false,
            'on_text' => esc_html__('Yes', 'dotus'),
            'off_text' => esc_html__('No', 'dotus'),
            'label' => esc_html__('Yes, do it!', 'dotus'),
          ),
          array(
            'id'    => 'footer_copyright_layout',
            'type'  => 'image_select',
            'title' => esc_html__('Select Copyright Layout', 'dotus'),
            'info' => esc_html__('In above image, blue box is copyright text and yellow box is secondary text.', 'dotus'),
            'default'      => 'copyright-3',
            'options'      => array(
              'copyright-1'    => DOTUS_CS_IMAGES .'/footer/copyright-1.png',
              ),
            'radio'        => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'copyright_text',
            'type'  => 'textarea',
            'title' => esc_html__('Copyright Text', 'dotus'),
            'shortcode' => true,
            'dependency' => array('hide_copyright', '!=', true),
            'after'       => 'Helpful shortcodes: [current_year] [home_url] or any shortcode.',
          ),

          // Copyright Another Text
          array(
            'type'    => 'notice',
            'class'   => 'warning cs-dotus-heading',
            'content' => esc_html__('Copyright Secondary Text', 'dotus'),
             'dependency'     => array('hide_copyright', '!=', true),
          ),
          array(
            'id'    => 'secondary_text',
            'type'  => 'textarea',
            'title' => esc_html__('Secondary Text', 'dotus'),
            'shortcode' => true,
            'dependency'     => array('hide_copyright', '!=', true),
          ),

        )
      ),

    ),
  );

  // ------------------------------
  // Design
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_design',
    'title'  => esc_html__('Theme Design', 'dotus'),
    'icon'   => 'fa fa-sliders'
  );

  // ------------------------------
  // color section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_color_section',
    'title'    => esc_html__('Colors', 'dotus'),
    'icon'     => 'fa fa-eyedropper',
    'fields' => array(

      array(
        'type'    => 'heading',
        'content' => esc_html__('Color Options', 'dotus'),
      ),
      array(
        'type'    => 'subheading',
        'wrap_class' => 'color-tab-content',
        'content' => esc_html__('All color options are available in our theme customizer. The reason of we used customizer options for color section is because, you can choose each part of color from there and see the changes instantly using customizer. Highly customizable colors are in Appearance > Customize', 'dotus'),
      ),

    ),
  );

  // ------------------------------
  // Typography section
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_typo_section',
    'title'    => esc_html__('Typography', 'dotus'),
    'icon'     => 'fa fa-header',
    'fields' => array(

      // Start fields
      array(
        'id'                  => 'typography',
        'type'                => 'group',
        'fields'              => array(
          array(
            'id'              => 'title',
            'type'            => 'text',
            'title'           => esc_html__('Title', 'dotus'),
          ),
          array(
            'id'              => 'selector',
            'type'            => 'textarea',
            'title'           => esc_html__('Selector', 'dotus'),
            'info'           => wp_kses( __('Enter css selectors like : <strong>body, .custom-class</strong>', 'dotus'), array( 'strong' => array() ) ),
          ),
          array(
            'id'              => 'font',
            'type'            => 'typography',
            'title'           => esc_html__('Font Family', 'dotus'),
          ),
          array(
            'id'              => 'size',
            'type'            => 'text',
            'title'           => esc_html__('Font Size', 'dotus'),
          ),
          array(
            'id'              => 'line_height',
            'type'            => 'text',
            'title'           => esc_html__('Line-Height', 'dotus'),
          ),
          array(
            'id'              => 'css',
            'type'            => 'textarea',
            'title'           => esc_html__('Custom CSS', 'dotus'),
          ),
        ),
        'button_title'        => esc_html__('Add New Typography', 'dotus'),
        'accordion_title'     => esc_html__('New Typography', 'dotus'),
      ),

      // Subset
      array(
        'id'                  => 'subsets',
        'type'                => 'select',
        'title'               => esc_html__('Subsets', 'dotus'),
        'class'               => 'chosen',
        'options'             => array(
          'latin'             => 'latin',
          'latin-ext'         => 'latin-ext',
          'cyrillic'          => 'cyrillic',
          'cyrillic-ext'      => 'cyrillic-ext',
          'greek'             => 'greek',
          'greek-ext'         => 'greek-ext',
          'vietnamese'        => 'vietnamese',
          'devanagari'        => 'devanagari',
          'khmer'             => 'khmer',
        ),
        'attributes'         => array(
          'data-placeholder' => 'Subsets',
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( 'latin' ),
      ),

      array(
        'id'                  => 'font_weight',
        'type'                => 'select',
        'title'               => esc_html__('Font Weights', 'dotus'),
        'class'               => 'chosen',
        'options'             => array(
          '100'   => esc_html__('Thin 100', 'dotus'),
          '100i'  => esc_html__('Thin 100 Italic', 'dotus'),
          '200'   => esc_html__('Extra Light 200', 'dotus'),
          '200i'  => esc_html__('Extra Light 200 Italic', 'dotus'),
          '300'   => esc_html__('Light 300', 'dotus'),
          '300i'  => esc_html__('Light 300 Italic', 'dotus'),
          '400'   => esc_html__('Regular 400', 'dotus'),
          '400i'  => esc_html__('Regular 400 Italic', 'dotus'),
          '500'   => esc_html__('Medium 500', 'dotus'),
          '500i'  => esc_html__('Medium 500 Italic', 'dotus'),
          '600'   => esc_html__('Semi Bold 600', 'dotus'),
          '600i'  => esc_html__('Semi Bold 600 Italic', 'dotus'),
          '700'   => esc_html__('Bold 700', 'dotus'),
          '700i'  => esc_html__('Bold 700 Italic', 'dotus'),
          '800'   => esc_html__('Extra Bold 800', 'dotus'),
          '800i'  => esc_html__('Extra Bold 800 Italic', 'dotus'),
          '900'   => esc_html__('Black 900', 'dotus'),
          '900i'  => esc_html__('Black 900 Italic', 'dotus'),
        ),
        'attributes'         => array(
          'data-placeholder' => esc_html__('Font Weight', 'dotus'),
          'multiple'         => 'multiple',
          'style'            => 'width: 200px;'
        ),
        'default'             => array( '400' ),
      ),

      // Custom Fonts Upload
      array(
        'id'                 => 'font_family',
        'type'               => 'group',
        'title'              => esc_html__('Upload Custom Fonts', 'dotus'),
        'button_title'       => esc_html__('Add New Custom Font', 'dotus'),
        'accordion_title'    => esc_html__('Adding New Font', 'dotus'),
        'accordion'          => true,
        'desc'               => esc_html__('It is simple. Only add your custom fonts and click to save. After you can check "Font Family" selector. Do not forget to Save!', 'dotus'),
        'fields'             => array(

          array(
            'id'             => 'name',
            'type'           => 'text',
            'title'          => esc_html__('Font-Family Name', 'dotus'),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. Arial', 'dotus')
            ),
          ),

          array(
            'id'             => 'ttf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .ttf <small><i>(optional)</i></small>', 'dotus'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'dotus'),
              'button_title' => wp_kses(__('Upload <i>.ttf</i>', 'dotus'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'eot',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .eot <small><i>(optional)</i></small>', 'dotus'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'dotus'),
              'button_title' => wp_kses(__('Upload <i>.eot</i>', 'dotus'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'otf',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .otf <small><i>(optional)</i></small>', 'dotus'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'dotus'),
              'button_title' => wp_kses(__('Upload <i>.otf</i>', 'dotus'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'woff',
            'type'           => 'upload',
            'title'          => wp_kses(__('Upload .woff <small><i>(optional)</i></small>', 'dotus'), array( 'small' => array(), 'i' => array() )),
            'settings'       => array(
              'upload_type'  => 'font',
              'insert_title' => esc_html__('Use this Font-Format', 'dotus'),
              'button_title' =>wp_kses(__('Upload <i>.woff</i>', 'dotus'), array( 'i' => array() )),
            ),
          ),

          array(
            'id'             => 'css',
            'type'           => 'textarea',
            'title'          => wp_kses(__('Extra CSS Style <small><i>(optional)</i></small>', 'dotus'), array( 'small' => array(), 'i' => array() )),
            'attributes'     => array(
              'placeholder'  => esc_html__('for eg. font-weight: normal;', 'dotus'),
            ),
          ),

        ),
      ),
      // End All field

    ),
  );

  // ------------------------------
  // Pages
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_pages',
    'title'  => esc_html__('Custom Pages', 'dotus'),
    'icon'   => 'fa fa-folder-open-o'
  );


  // ------------------------------
  // Service Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'service_section',
    'title'    => esc_html__('Service Settings', 'dotus'),
    'icon'     => 'fa fa-server',
    'fields' => array(

      // service name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'dotus')
      ),
      array(
        'id'      => 'theme_service_name',
        'type'    => 'text',
        'title'   => esc_html__('Service Name', 'dotus'),
        'attributes'     => array(
          'placeholder'  => 'Service'
        ),
      ),
      array(
        'id'      => 'theme_service_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Slug', 'dotus'),
        'attributes'     => array(
          'placeholder'  => 'service-item'
        ),
      ),
      array(
        'id'      => 'theme_service_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Service Category Slug', 'dotus'),
        'attributes'     => array(
          'placeholder'  => 'service-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set service slug and page slug as same. It\'ll not work.', 'dotus')
      ),
      // Service Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-dotus-heading',
        'content' => esc_html__('Service Single', 'dotus')
      ),
      array(
          'id'             => 'service_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'dotus'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'dotus'),
            'sidebar-left' => esc_html__('Left', 'dotus'),
            'sidebar-hide' => esc_html__('Hide', 'dotus'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'dotus'),
        ),
        array(
          'id'             => 'single_service_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'dotus'),
          'options'        => dotus_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'dotus'),
          'dependency'     => array('service_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'dotus'),
        ),
        array(
          'id'    => 'service_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'dotus'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'dotus'),
          'default' => true,
        ),
    ),
  );

  
  // ------------------------------
  // Project Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'project_section',
    'title'    => esc_html__('Project Settings', 'dotus'),
    'icon'     => 'fa fa-medkit',
    'fields' => array(

      // project name change
      array(
        'type'    => 'notice',
        'class'   => 'info cs-tmx-heading',
        'content' => esc_html__('Name Change', 'dotus')
      ),
      array(
        'id'      => 'theme_project_name',
        'type'    => 'text',
        'title'   => esc_html__('Project Name', 'dotus'),
        'attributes'     => array(
          'placeholder'  => 'Project'
        ),
      ),
      array(
        'id'      => 'theme_project_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Slug', 'dotus'),
        'attributes'     => array(
          'placeholder'  => 'project-item'
        ),
      ),
      array(
        'id'      => 'theme_project_cat_slug',
        'type'    => 'text',
        'title'   => esc_html__('Project Category Slug', 'dotus'),
        'attributes'     => array(
          'placeholder'  => 'project-category'
        ),
      ),
      array(
        'type'    => 'notice',
        'class'   => 'danger',
        'content' => __('<strong>Important</strong>: Please do not set project slug and page slug as same. It\'ll not work.', 'dotus')
      ),

      // Project Start
      array(
        'type'    => 'notice',
        'class'   => 'info cs-dotus-heading',
        'content' => esc_html__('Project Single', 'dotus')
      ),
      array(
          'id'             => 'project_sidebar_position',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Position', 'dotus'),
          'options'        => array(
            'sidebar-right' => esc_html__('Right', 'dotus'),
            'sidebar-left' => esc_html__('Left', 'dotus'),
            'sidebar-hide' => esc_html__('Hide', 'dotus'),
          ),
          'default_option' => 'Select sidebar position',
          'info'          => esc_html__('Default option : Right', 'dotus'),
        ),
        array(
          'id'             => 'single_project_widget',
          'type'           => 'select',
          'title'          => esc_html__('Sidebar Widget', 'dotus'),
          'options'        => dotus_registered_sidebars(),
          'default_option' => esc_html__('Select Widget', 'dotus'),
          'dependency'     => array('project_sidebar_position', '!=', 'sidebar-hide'),
          'info'          => esc_html__('Default option : Main Widget Area', 'dotus'),
        ),
        array(
          'id'    => 'project_comment_form',
          'type'  => 'switcher',
          'title' => esc_html__('Comment Area/Form', 'dotus'),
          'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this OFF.', 'dotus'),
          'default' => true,
        ),
    ),
  );

  // ------------------------------
  // Blog Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'blog_section',
    'title'    => esc_html__('Blog Settings', 'dotus'),
    'icon'     => 'fa fa-newspaper-o',
    'sections' => array(

      // blog general section
      array(
        'name'     => 'blog_general_tab',
        'title'    => esc_html__('General', 'dotus'),
        'icon'     => 'fa fa-cog',
        'fields'   => array(

          // Layout
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Layout', 'dotus')
          ),
          array(
            'id'             => 'blog_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'dotus'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'dotus'),
              'sidebar-left' => esc_html__('Left', 'dotus'),
              'sidebar-hide' => esc_html__('Hide', 'dotus'),
            ),
            'default_option' => 'Select sidebar position',
            'help'          => esc_html__('This style will apply, default blog pages - Like : Archive, Category, Tags, Search & Author.', 'dotus'),
            'info'          => esc_html__('Default option : Right', 'dotus'),
          ),
          array(
            'id'             => 'blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'dotus'),
            'options'        => dotus_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'dotus'),
            'dependency'     => array('blog_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'dotus'),
          ),
          // Layout
          // Global Options
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Global Options', 'dotus')
          ),
          array(
            'id'         => 'theme_exclude_categories',
            'type'       => 'checkbox',
            'title'      => esc_html__('Exclude Categories', 'dotus'),
            'info'      => esc_html__('Select categories you want to exclude from blog page.', 'dotus'),
            'options'    => 'categories',
          ),
          array(
            'id'      => 'theme_blog_excerpt',
            'type'    => 'text',
            'title'   => esc_html__('Excerpt Length', 'dotus'),
            'info'   => esc_html__('Blog short content length, in blog listing pages.', 'dotus'),
            'default' => '55',
          ),
          array(
            'id'      => 'theme_metas_hide',
            'type'    => 'checkbox',
            'title'   => esc_html__('Meta\'s to hide', 'dotus'),
            'info'    => esc_html__('Check items you want to hide from blog/post meta field.', 'dotus'),
            'class'      => 'horizontal',
            'options'    => array(
              'category'   => esc_html__('Category', 'dotus'),
              'date'    => esc_html__('Date', 'dotus'),
              'author'     => esc_html__('Author', 'dotus'),
              'comments'      => esc_html__('Comments', 'dotus'),
              'Tag'      => esc_html__('Tag', 'dotus'),
            ),
            // 'default' => '30',
          ),
          // End fields

        )
      ),

      // blog single section
      array(
        'name'     => 'blog_single_tab',
        'title'    => esc_html__('Single', 'dotus'),
        'icon'     => 'fa fa-sticky-note',
        'fields'   => array(

          // Start fields
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Enable / Disable', 'dotus')
          ),
          array(
            'id'    => 'single_featured_image',
            'type'  => 'switcher',
            'title' => esc_html__('Featured Image', 'dotus'),
            'info' => esc_html__('If need to hide featured image from single blog post page, please turn this OFF.', 'dotus'),
            'default' => true,
          ),
           array(
            'id'    => 'single_author_info',
            'type'  => 'switcher',
            'title' => esc_html__('Author Info', 'dotus'),
            'info' => esc_html__('If need to hide author info on single blog page, please turn this On.', 'dotus'),
            'default' => false,
          ),
          array(
            'id'    => 'single_share_option',
            'type'  => 'switcher',
            'title' => esc_html__('Share Option', 'dotus'),
            'info' => esc_html__('If need to hide share option on single blog page, please turn this OFF.', 'dotus'),
            'default' => true,
          ),
          array(
            'id'    => 'single_comment_form',
            'type'  => 'switcher',
            'title' => esc_html__('Comment Area/Form ?', 'dotus'),
            'info' => esc_html__('If need to hide comment area and that form on single blog page, please turn this On.', 'dotus'),
            'default' => false,
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Sidebar', 'dotus')
          ),
          array(
            'id'             => 'single_sidebar_position',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Position', 'dotus'),
            'options'        => array(
              'sidebar-right' => esc_html__('Right', 'dotus'),
              'sidebar-left' => esc_html__('Left', 'dotus'),
              'sidebar-hide' => esc_html__('Hide', 'dotus'),
            ),
            'default_option' => 'Select sidebar position',
            'info'          => esc_html__('Default option : Right', 'dotus'),
          ),
          array(
            'id'             => 'single_blog_widget',
            'type'           => 'select',
            'title'          => esc_html__('Sidebar Widget', 'dotus'),
            'options'        => dotus_registered_sidebars(),
            'default_option' => esc_html__('Select Widget', 'dotus'),
            'dependency'     => array('single_sidebar_position', '!=', 'sidebar-hide'),
            'info'          => esc_html__('Default option : Main Widget Area', 'dotus'),
          ),
          // End fields

        )
      ),

    ),
  );

if (class_exists( 'WooCommerce' )){
  // ------------------------------
  // WooCommerce Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'woocommerce_section',
    'title'    => esc_html__('WooCommerce', 'dotus'),
    'icon'     => 'fa fa-shopping-basket',
    'fields' => array(

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-dotus-heading',
        'content' => esc_html__('Layout', 'dotus')
      ),
     array(
        'id'             => 'woo_product_columns',
        'type'           => 'select',
        'title'          => esc_html__('Product Column', 'dotus'),
        'options'        => array(
          2 => esc_html__('Two Column', 'dotus'),
          3 => esc_html__('Three Column', 'dotus'),
          4 => esc_html__('Four Column', 'dotus'),
        ),
        'default_option' => esc_html__('Select Product Columns', 'dotus'),
        'help'          => esc_html__('This style will apply, default woocommerce shop and archive pages.', 'dotus'),
      ),
      array(
        'id'             => 'woo_sidebar_position',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Position', 'dotus'),
        'options'        => array(
          'right-sidebar' => esc_html__('Right', 'dotus'),
          'left-sidebar' => esc_html__('Left', 'dotus'),
          'sidebar-hide' => esc_html__('Hide', 'dotus'),
        ),
        'default_option' => esc_html__('Select sidebar position', 'dotus'),
        'info'          => esc_html__('Default option : Right', 'dotus'),
      ),
      array(
        'id'             => 'woo_widget',
        'type'           => 'select',
        'title'          => esc_html__('Sidebar Widget', 'dotus'),
        'options'        => dotus_registered_sidebars(),
        'default_option' => esc_html__('Select Widget', 'dotus'),
        'dependency'     => array('woo_sidebar_position', '!=', 'sidebar-hide'),
        'info'          => esc_html__('Default option : Shop Page', 'dotus'),
      ),

      array(
        'type'    => 'notice',
        'class'   => 'info cs-dotus-heading',
        'content' => esc_html__('Listing', 'dotus')
      ),
      array(
        'id'      => 'theme_woo_limit',
        'type'    => 'text',
        'title'   => esc_html__('Product Limit', 'dotus'),
        'info'   => esc_html__('Enter the number value for per page products limit.', 'dotus'),
      ),
      // End fields

      // Start fields
      array(
        'type'    => 'notice',
        'class'   => 'info cs-dotus-heading',
        'content' => esc_html__('Single Product', 'dotus')
      ),
      array(
        'id'             => 'woo_related_limit',
        'type'           => 'text',
        'title'          => esc_html__('Related Products Limit', 'dotus'),
      ),
      array(
        'id'    => 'woo_single_upsell',
        'type'  => 'switcher',
        'title' => esc_html__('You May Also Like', 'dotus'),
        'info' => esc_html__('If you don\'t want \'You May Also Like\' products in single product page, please turn this ON.', 'dotus'),
        'default' => false,
      ),
      array(
        'id'    => 'woo_single_related',
        'type'  => 'switcher',
        'title' => esc_html__('Related Products', 'dotus'),
        'info' => esc_html__('If you don\'t want \'Related Products\' in single product page, please turn this ON.', 'dotus'),
        'default' => false,
      ),
      // End fields

    ),
  );
}

  // ------------------------------
  // Extra Pages
  // ------------------------------
  $options[]   = array(
    'name'     => 'theme_extra_pages',
    'title'    => esc_html__('404 & Maintenance', 'dotus'),
    'icon'     => 'fa fa-cogs',
    'sections' => array(

      // error 404 page
      array(
        'name'     => 'error_page_section',
        'title'    => esc_html__('404 Page', 'dotus'),
        'icon'     => 'fa fa-exclamation-triangle',
        'fields'   => array(

          // Start 404 Page
          array(
            'id'    => 'error_heading',
            'type'  => 'text',
            'title' => esc_html__('404 Page Heading', 'dotus'),
            'info'  => esc_html__('Enter 404 page heading.', 'dotus'),
          ),
          array(
            'id'    => 'error_subheading',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Sub Heading', 'dotus'),
            'info'  => esc_html__('Enter 404 page Sub heading.', 'dotus'),
          ),
          array(
            'id'    => 'error_page_content',
            'type'  => 'textarea',
            'title' => esc_html__('404 Page Content', 'dotus'),
            'info'  => esc_html__('Enter 404 page content.', 'dotus'),
            'shortcode' => true,
          ),
          array(
            'id'    => 'error_btn_text',
            'type'  => 'text',
            'title' => esc_html__('Button Text', 'dotus'),
            'info'  => esc_html__('Enter BACK TO HOME button text. If you want to change it.', 'dotus'),
          ),
          // End 404 Page

        ) // end: fields
      ), // end: fields section

      // maintenance mode page
      array(
        'name'     => 'maintenance_mode_section',
        'title'    => esc_html__('Maintenance Mode', 'dotus'),
        'icon'     => 'fa fa-hourglass-half',
        'fields'   => array(

          // Start Maintenance Mode
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('If you turn this ON : Only Logged in users will see your pages. All other visiters will see, selected page of : <strong>Maintenance Mode Page</strong>', 'dotus')
          ),
          array(
            'id'             => 'enable_maintenance_mode',
            'type'           => 'switcher',
            'title'          => esc_html__('Maintenance Mode', 'dotus'),
            'default'        => false,
          ),
          array(
            'id'             => 'maintenance_mode_page',
            'type'           => 'select',
            'title'          => esc_html__('Maintenance Mode Page', 'dotus'),
            'options'        => 'pages',
            'default_option' => esc_html__('Select a page', 'dotus'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_title',
            'type'           => 'text',
            'title'          => esc_html__('Maintenance Mode Text', 'dotus'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_text',
            'type'           => 'textarea',
            'title'          => esc_html__('Maintenance Mode Text', 'dotus'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          array(
            'id'             => 'maintenance_mode_bg',
            'type'           => 'background',
            'title'          => esc_html__('Page Background', 'dotus'),
            'dependency'   => array( 'enable_maintenance_mode', '==', 'true' ),
          ),
          // End Maintenance Mode

        ) // end: fields
      ), // end: fields section

    )
  );

  // ------------------------------
  // Advanced
  // ------------------------------
  $options[] = array(
    'name'   => 'theme_advanced',
    'title'  => esc_html__('Advanced Settings', 'dotus'),
    'icon'   => 'fa fa-cog'
  );

  // ------------------------------
  // Misc Section
  // ------------------------------
  $options[]   = array(
    'name'     => 'misc_section',
    'title'    => esc_html__('Extra Settings', 'dotus'),
    'icon'     => 'fa fa-reorder',
    'sections' => array(

      // custom sidebar section
      array(
        'name'     => 'custom_sidebar_section',
        'title'    => esc_html__('Custom Sidebar', 'dotus'),
        'icon'     => 'fa fa-reorder',
        'fields'   => array(

          // start fields
          array(
            'id'              => 'custom_sidebar',
            'title'           => esc_html__('Sidebars', 'dotus'),
            'desc'            => esc_html__('Go to Appearance -> Widgets after create sidebars', 'dotus'),
            'type'            => 'group',
            'fields'          => array(
              array(
                'id'          => 'sidebar_name',
                'type'        => 'text',
                'title'       => esc_html__('Sidebar Name', 'dotus'),
              ),
              array(
                'id'          => 'sidebar_desc',
                'type'        => 'text',
                'title'       => esc_html__('Custom Description', 'dotus'),
              )
            ),
            'accordion'       => true,
            'button_title'    => esc_html__('Add New Sidebar', 'dotus'),
            'accordion_title' => esc_html__('New Sidebar', 'dotus'),
          ),
          // end fields

        )
      ),
      // custom sidebar section

      // Custom CSS/JS
      array(
        'name'        => 'custom_css_js_section',
        'title'       => esc_html__('Custom Codes', 'dotus'),
        'icon'        => 'fa fa-code',

        // begin: fields
        'fields'      => array(
          // Start Custom CSS/JS
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Custom JS', 'dotus')
          ),
          array(
            'id'             => 'theme_custom_js',
            'type'           => 'textarea',
            'attributes' => array(
              'rows'     => 10,
              'placeholder'     => esc_html__('Enter your JS code here...', 'dotus'),
            ),
          ),
          // End Custom CSS/JS

        ) // end: fields
      ),

      // Translation
      array(
        'name'        => 'theme_translation_section',
        'title'       => esc_html__('Translation', 'dotus'),
        'icon'        => 'fa fa-language',

        // begin: fields
        'fields'      => array(

          // Start Translation
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Common Texts', 'dotus')
          ),
          array(
            'id'          => 'read_more_text',
            'type'        => 'text',
            'title'       => esc_html__('Read More Text', 'dotus'),
          ),
          array(
            'id'          => 'view_more_text',
            'type'        => 'text',
            'title'       => esc_html__('View More Text', 'dotus'),
          ),
          array(
            'id'          => 'share_text',
            'type'        => 'text',
            'title'       => esc_html__('Share Text', 'dotus'),
          ),
          array(
            'id'          => 'share_on_text',
            'type'        => 'text',
            'title'       => esc_html__('Share On Tooltip Text', 'dotus'),
          ),
          array(
            'id'          => 'author_text',
            'type'        => 'text',
            'title'       => esc_html__('Author Text', 'dotus'),
          ),
          array(
            'id'          => 'post_comment_text',
            'type'        => 'text',
            'title'       => esc_html__('Post Comment Text [Submit Button]', 'dotus'),
          ),
          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('WooCommerce', 'dotus')
          ),
          array(
            'id'          => 'add_to_cart_text',
            'type'        => 'text',
            'title'       => esc_html__('Add to Cart Text', 'dotus'),
          ),
          array(
            'id'          => 'details_text',
            'type'        => 'text',
            'title'       => esc_html__('Details Text', 'dotus'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Pagination', 'dotus')
          ),
          array(
            'id'          => 'older_post',
            'type'        => 'text',
            'title'       => esc_html__('Older Posts Text', 'dotus'),
          ),
          array(
            'id'          => 'newer_post',
            'type'        => 'text',
            'title'       => esc_html__('Newer Posts Text', 'dotus'),
          ),

          array(
            'type'    => 'notice',
            'class'   => 'info cs-dotus-heading',
            'content' => esc_html__('Single Portfolio Pagination', 'dotus')
          ),
          array(
            'id'          => 'prev_port',
            'type'        => 'text',
            'title'       => esc_html__('Prev Case Text', 'dotus'),
          ),
          array(
            'id'          => 'next_port',
            'type'        => 'text',
            'title'       => esc_html__('Next Case Text', 'dotus'),
          ),
          // End Translation

        ) // end: fields
      ),

    ),
  );

  
  // ------------------------------
  // backup                       -
  // ------------------------------
  $options[]   = array(
    'name'     => 'backup_section',
    'title'    => 'Backup',
    'icon'     => 'fa fa-shield',
    'fields'   => array(

      array(
        'type'    => 'notice',
        'class'   => 'warning',
        'content' => esc_html__('You can save your current options. Download a Backup and Import.', 'dotus'),
      ),

      array(
        'type'    => 'backup',
      ),

    )
  );

  return $options;

}
add_filter( 'cs_framework_options', 'dotus_options' );