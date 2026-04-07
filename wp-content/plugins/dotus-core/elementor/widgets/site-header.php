<?php
/*
 * Elementor Dotus Header Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_Header extends Widget_Base{

	protected $nav_menu_index = 1;

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_header';
	}

	/**
	 * Retrieve the widget header.
	*/
	public function get_title(){
		return esc_html__( 'Header', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-nav-menu';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	public function get_keywords() {
		return [ 'menu', 'nav', 'hader' ];
	}

	public function on_export( $element ) {
		unset( $element['settings']['menu'] );

		return $element;
	}

	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Retrieve the list of scripts the Dotus Header widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_header'];
	}
	
	
	/**
	 * Register Dotus Header widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_Header',
			[
				'label' => esc_html__( 'Header Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'navigation_style',
			[
				'label' => esc_html__( 'Navigation', 'dotus-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__( 'Style One', 'dotus-core' ),
					'style-two' => esc_html__( 'Style Two', 'dotus-core' ),
				],
				'default' => 'style-one',
				'description' => esc_html__( 'Select your navigation style.', 'dotus-core' ),
			]
		);
		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label' => __( 'Menu', 'dotus' ),
					'type' => Controls_Manager::SELECT,
					'options' => $menus,
					'default' => array_keys( $menus )[0],
					'save_default' => true,
					'separator' => 'after',
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'dotus' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => '<strong>' . __( 'There are no menus in your site.', 'dotus' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'dotus' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'dotus-panel-alert dotus-panel-alert-info',
				]
			);
		}
		$this->add_control(
			'header_logo',
			[
				'label' => esc_html__( 'Logo Image', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button/Link Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type btn text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( 'Button Link', 'dotus-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'header_search',
			[
				'label' => esc_html__( 'Search', 'dotus-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'dotus-core' ),
				'label_off' => esc_html__( 'Hide', 'dotus-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->add_control(
			'header_cart',
			[
				'label' => esc_html__( 'Cart', 'dotus-core' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'dotus-core' ),
				'label_off' => esc_html__( 'Hide', 'dotus-core' ),
				'return_value' => 'true',
				'default' => 'true',
			]
		);
		$this->end_controls_section();// end: Section

		
		
		$this->start_controls_section(
			'dotus_section_style_main-menu',
			[
				'label' => __( 'Main Menu', 'dotus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dotus_menu_typography',
				'selector' => '{{WRAPPER}} .wpo-site-header #navbar>ul>li>a',
			]
		);

		$this->add_responsive_control(
			'minimum_height_menu_item',
			[
				'label' => __( 'Main Menu Height', 'dotus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 120,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wpo-custom-site-header .navigation' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

		$this->start_controls_tab(
			'dotus_tab_menu_item_normal',
			[
				'label' => __( 'Normal', 'dotus' ),
			]
		);

		$this->add_control(
			'dotus_color_menu_bg_item',
			[
				'label' => __( 'Background Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'dotus_menu_row_bg_item',
			[
				'label' => __( 'Background Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .wpo-site-header .navigation .row' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'dotus_color_menu_item',
			[
				'label' => __( 'Text Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li>a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label' => __( 'Hover', 'dotus' ),
			]
		);

		$this->add_control(
			'color_menu_item_hover',
			[
				'label' => __( 'Text Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul li a:hover,
					{{WRAPPER}} .navigation #navbar>ul li a:focus' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_menu_item_line_hover',
			[
				'label' => __( 'Line Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li>a:before' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => __( 'Active', 'dotus' ),
			]
		);

		$this->add_control(
			'color_menu_item_active',
			[
				'label' => __( 'Text Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li.current-menu-parent>a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		/* This control is required to handle with complicated conditions */
		$this->add_control(
			'hr',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'padding_horizontal_menu_item',
			[
				'label' => __( 'Horizontal Padding', 'dotus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li>a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'padding_vertical_menu_item',
			[
				'label' => __( 'Vertical Padding', 'dotus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li>a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __( 'Dropdown', 'dotus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dropdown_description',
			[
				'raw' => __( 'On desktop, this will affect the submenu. On mobile, this will affect the entire menu.', 'dotus' ),
				'type' => Controls_Manager::RAW_HTML,
				'content_classes' => 'dotus-descriptor',
			]
		);

		$this->start_controls_tabs( 'tabs_dropdown_item_style' );

		$this->start_controls_tab(
			'tab_dropdown_item_normal',
			[
				'label' => __( 'Normal', 'dotus' ),
			]
		);

		$this->add_control(
			'color_dropdown_item',
			[
				'label' => __( 'Text Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li .sub-menu a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item',
			[
				'label' => __( 'Background Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul .sub-menu' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_hover',
			[
				'label' => __( 'Hover', 'dotus' ),
			]
		);

		$this->add_control(
			'color_dropdown_item_hover',
			[
				'label' => __( 'Text Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li .sub-menu a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'background_color_dropdown_item_hover',
			[
				'label' => __( 'Background Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul .sub-menu:hover' => 'background-color: {{VALUE}}',
				],
				'separator' => 'none',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_dropdown_item_active',
			[
				'label' => __( 'Active', 'dotus' ),
			]
		);

		$this->add_control(
			'color_dropdown_item_active',
			[
				'label' => __( 'Text Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul .sub-menu .current-menu-item > a' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'padding_horizontal_dropdown_item',
			[
				'label' => __( 'Horizontal Padding', 'dotus' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li .sub-menu a' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
				'separator' => 'before',

			]
		);

		$this->add_responsive_control(
			'padding_vertical_dropdown_item',
			[
				'label' => __( 'Vertical Padding', 'dotus' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .navigation #navbar>ul>li .sub-menu a' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'heading_dropdown_divider',
			[
				'label' => __( 'Divider', 'dotus' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( 'style_toggle',
			[
				'label' => __( 'Toggle Button', 'dotus' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'tab_toggle_style_normal',
			[
				'label' => __( 'Normal', 'dotus' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label' => __( 'Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation .mobail-menu button span' => 'background-color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label' => __( 'Background Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation .mobail-menu button' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_toggle_style_hover',
			[
				'label' => __( 'Hover', 'dotus' ),
			]
		);

		$this->add_control(
			'toggle_color_hover',
			[
				'label' => __( 'Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation .mobail-menu button:hover span' => 'background-color: {{VALUE}}', // Harder selector to override text color control
				],
			]
		);

		$this->add_control(
			'toggle_background_color_hover',
			[
				'label' => __( 'Background Color', 'dotus' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation .mobail-menu button:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();// end: Section

				// Button
		$this->start_controls_section(
			'section_bout_btn_style',
			[
				'label' => esc_html__( 'Button', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation .theme-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_bg_color',
				'label' => esc_html__( 'Background', 'dotus-core' ),
				'description' => esc_html__( 'Button Color', 'dotus-core' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .navigation .theme-btn',
			]
		);
		$this->add_control(
			'button_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .navigation .theme-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_hover_bg_color',
				'label' => esc_html__( 'Hover Background', 'dotus-core' ),
				'description' => esc_html__( 'Button Color', 'dotus-core' ),
				'types' => [ 'gradient' ],
				'selector' => '{{WRAPPER}} .navigation .theme-btn:hover',
			]
		);
		$this->add_control(
			'about_btn_padding',
			[
				'label' => esc_html__( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .navigation .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// search
		$this->start_controls_section(
			'section_search_cart_style',
			[
				'label' => esc_html__( 'Search & Cart', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'search_cart_border_color',
			[
				'label' => esc_html__( 'Border Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-toggle-btn, .cart-toggle-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'search_cart_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .search-toggle-btn i:before, .cart-toggle-btn i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


	
	}

	/**
	 * Render Header widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$navigation_style = !empty( $settings['navigation_style'] ) ? $settings['navigation_style'] : '';
		$header_search  = ( isset( $settings['header_search'] ) && ( 'true' == $settings['header_search'] ) ) ? true : false;
		$header_cart  = ( isset( $settings['header_cart'] ) && ( 'true' == $settings['header_cart'] ) ) ? true : false;
		$bg_image = !empty( $settings['header_logo']['id'] ) ? $settings['header_logo']['id'] : '';	
		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image , '_wp_attachment_image_alt', true);

		$btn_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';

		$btn_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty( $btn_link ) ?  $btn_external.' '.$btn_nofollow : '';

		$button = $btn_link ? '<a href="'.esc_url($btn_link).'" '.esc_attr( $btn_link_attr ).' class="theme-btn" >'.esc_html( $btn_text ).'</a>' : '';


		$available_menus = $this->get_available_menus();

		if ( ! $available_menus ) {
			return;
		}

		$settings = $this->get_active_settings();

		$args = [
			'echo' => false,
			'menu' => $settings['menu'],
			'menu_class' => 'nav navbar-nav mb-2 mb-lg-0',
			'menu_id' => 'menu-' . $this->get_nav_menu_index() . '-' . $this->get_id(),
			'fallback_cb' => '__return_empty_string',
			'container' => '',
		];

		// General Menu.
		$menu_html = wp_nav_menu( $args );


		if ( empty( $menu_html ) ) {
			return;
		}
	
		if ( $navigation_style == 'style-one' ) {
			$nav_style = 'wpo-site-header-s3';
			$logo_col = 'col-lg-2 col-md-6 col-6';
			$header_container = 'container-fluid';
			$header_right_col = 'col-lg-2';
		} else {
			$nav_style = 'wpo-site-header-s2';
			$logo_col = 'col-lg-2 col-md-6 col-6';
			$header_container = 'container-fluid';
			$header_right_col = 'col-lg-2 col-md-2 col-2';
		}
		// Turn output buffer on

		ob_start(); ?>
		<div class=" wpo-custom-site-header wpo-site-header <?php echo esc_attr( $nav_style ); ?>">
	    <nav class="navigation navbar navbar-expand-lg navbar-light">
	        <div class="<?php echo esc_attr( $header_container ); ?>">
	            <div class="row align-items-center">
	                <div class="col-lg-3 col-md-3 col-3 d-lg-none dl-block">
	                    <div class="mobail-menu">
	                        <button type="button" class="navbar-toggler open-btn">
	                            <span class="sr-only"><?php echo esc_html__( 'Toggle navigation','dotus' ) ?></span>
	                            <span class="icon-bar first-angle"></span>
	                            <span class="icon-bar middle-angle"></span>
	                            <span class="icon-bar last-angle"></span>
	                        </button>
	                    </div>
	                </div>
	                <div class="<?php echo esc_attr( $logo_col ); ?> col-md-6 col-6">
	                    <div class="navbar-header">
	                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
	                        	<?php  if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
	                        </a>
	                    </div>
	                </div>
	                <div class="col-lg-8 col-md-1 col-1">
	                    <div id="navbar" class="collapse navbar-collapse navigation-holder">
	                        <button class="menu-close"><i class="ti-close"></i></button>
	                         <?php echo $menu_html; ?>
	                    </div><!-- end of nav-collapse -->
	                </div>
	                <div class="<?php echo esc_attr( $header_right_col ); ?> col-md-2 col-2">
	                    <div class="header-right">

	                        <?php if ( $header_search ) { ?>
	                        	<div class="header-search-form-wrapper">
	                            <div class="cart-search-contact">
	                                <button class="search-toggle-btn"><i class="fi ti-search"></i></button>
	                                <div class="header-search-form">
	                                    <form method="get" action="<?php echo esc_url( home_url('/') ); ?>" class="form" >
	                                        <div>
	                                            <input type="text" name="s" class="form-control" placeholder="<?php echo esc_attr__( 'Search here','dotus' ); ?>">
	                                            <button type="submit">
	                                            	<i class="fi flaticon-search"></i>
	                                            </button>
	                                        </div>
	                                    </form>
	                                </div>
	                            </div>
	                        </div>
	                        <?php } 
	                         if ( $header_cart && class_exists( 'WooCommerce' ) ) {
	                        	?>
	                 				<div class="mini-cart">
											    <button class="cart-toggle-btn"><i class="fi flaticon-shopping-bag"></i>
											    	 <span class="cart-count">
												    	<?php
												    		if ( WC()->cart ) {
												    		 echo esc_html( WC()->cart->get_cart_contents_count() ); 
												    		 }
												    	?>
											    	</span>
											    </button>
											    <div class="mini-cart-content">
											      <button class="mini-cart-close"><i class="ti-close"></i></button>
											        <div class="mini-cart-title">
											            <p><?php echo esc_html__('Shopping Cart','dotus'); ?></p>
											        </div>
											        <?php if ( WC()->cart && WC()->cart->get_cart_contents_count() == 0  ) { ?>
											          <div class="mini-cart-items">
											             <?php foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
											              $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
											              $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

											              if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
											                $product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
											                ?>
											            <div class="mini-cart-item clearfix">
											                <div class="mini-cart-item-image">
											                    <?php
											                      $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
											                      if ( ! $product_permalink ) {
											                        echo wp_kses_post( $thumbnail );
											                      } else {
											                        printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail );
											                      }
											                    ?>
											                </div>
											                <div class="mini-cart-item-des">
											                     <?php
											                      if ( ! $product_permalink ) {
											                        echo apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;';
											                      } else {
											                        echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key );
											                      }
											                    ?>
											                    <span class="mini-cart-item-price">
											                    <?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
											                      <span class="mini-cart-item-quantity">
											                        <i class="ti-close"></i>
											                        <?php echo esc_html( $cart_item['quantity'] ); ?>
											                      </span>
											                    </span>
											                    <?php
											                        echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
											                          '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><i class="ti-close"></i></a>',
											                          esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											                          esc_html__( 'Remove this item', 'dotus' ),
											                          esc_attr( $product_id ),
											                          esc_attr( $_product->get_sku() )
											                        ), $cart_item_key );
											                      ?>
											                </div>
											            </div>
											            <?php
											              }
											             }
											            ?>
											        </div>
											        <?php }
											          $mini_shop_url = wc_get_page_permalink( 'shop' ); ?>
											          <div class="mini-cart-empty">
											            <p class="no-products"><?php echo esc_html__('Your basket is empty!.','dotus' ); ?></p>
											            <div class="cart-emty-icon">
											              <i class="fi flaticon-shopping-bag"></i>
											            </div>
											            <a href="<?php  echo esc_url( $mini_shop_url ) ?>" class="view-cart-btn s2">
											                <?php echo esc_html__('Start Shopping','dotus' ); ?>
											            </a>
											          </div>
											        <?php ?>
											        <div class="mini-cart-action clearfix">
											          <?php 
											          if ( WC()->cart && WC()->cart->get_cart_contents_count() == 0 ) {
											            $checkout_url = wc_get_page_permalink( 'checkout' );
											            $mini_cart_url = wc_get_page_permalink( 'cart' ); 
											             ?>
											              <span class="mini-checkout-price">
											              <?php echo esc_html__('Subtotal: ','dotus' ); ?>
											              <span><?php echo WC()->cart->get_cart_total(); ?></span>
											              </span>
											            
											              <a href="<?php echo esc_url( $checkout_url ); ?>" class="view-cart-btn s1">
											                <?php echo esc_html__(' Checkout','dotus' ); ?>
											              </a>
											              <a href="<?php  echo esc_url( $mini_cart_url ) ?>" class="view-cart-btn">
											                <?php echo esc_html__('View Cart','dotus' ); ?>
											              </a>
											            <?php } ?>
											        </div>
											    	</div>
													</div>
	                         <?php 
	                       		} ?>
	                        <div class="close-form">
	                          <?php echo $button; ?>

	                          <?php if ( $btn_link ) { ?>
	                          	<div class="mobile-btn">
	                          	<a href="<?php echo esc_url( $btn_link ); ?>"><i class="ti-support"></i></a>
	                          	</div>
	                          <?php } ?>
	                          
	                        </div>

	                    </div>

	                </div>
	            </div>
	        </div><!-- end of container -->
	    </nav>
	</div>
		<?php // Return outbut buffer
		echo ob_get_clean();
		
	}

	/**
	 * Render Header widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_Header() );