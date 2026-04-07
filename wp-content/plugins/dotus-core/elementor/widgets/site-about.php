<?php
/*
 * Elementor Dotus About Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_About extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_about';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'About', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-site-identity';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus About widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_about'];
	}
	
	/**
	 * Register Dotus About widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_about',
			[
				'label' => esc_html__( 'About Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'about_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'About Us', 'dotus-core' ),
				'placeholder' => esc_html__( 'Sub Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_title',
			[
				'label' => esc_html__( 'Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'We Are Trusted The Best Certificate Healthcare.', 'dotus-core' ),
				'placeholder' => esc_html__( 'Sub Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_content',
			[
				'label' => esc_html__( 'Content', 'dotus-core' ),
				'default' => esc_html__( 'your content text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type your content here', 'dotus-core' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'about_image',
			[
				'label' => esc_html__( 'About Image', 'dotus-core' ),
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
	 $this->end_controls_section();// end: Section
		
		// Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__( 'Sub Title', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dotus_subtitle_typography',
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text span',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text span' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	
		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'dotus_title_typography',
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text h2' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__( 'Content', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text p, .wpo-about-section .wpo-about-text ul li',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text p, .wpo-about-section .wpo-about-text ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => __( 'Content Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text p, .wpo-about-section .wpo-about-text ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Button Style
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn',
			]
		);
		$this->add_responsive_control(
			'button_min_width',
			[
				'label' => esc_html__( 'Width', 'dotus-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 10,
						'max' => 500,
						'step' => 1,
					],
				],
				'size_units' => [ 'px' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'button_border_radius',
			[
				'label' => __( 'Border Radius', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'button_style' );
			$this->start_controls_tab(
				'button_normal',
				[
					'label' => esc_html__( 'Normal', 'dotus-core' ),
				]
			);
			$this->add_control(
				'button_color',
				[
					'label' => esc_html__( 'Color', 'dotus-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn' => 'color: {{VALUE}};',
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
						'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn',
					]
				);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn',
				]
			);
			$this->end_controls_tab();  // end:Normal tab
			
			$this->start_controls_tab(
				'button_hover',
				[
					'label' => esc_html__( 'Hover', 'dotus-core' ),
				]
			);
			$this->add_control(
				'button_hover_color',
				[
					'label' => esc_html__( 'Color', 'dotus-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
					Group_Control_Background::get_type(),
					[
						'name' => 'button_bg_hover_color',
						'label' => esc_html__( 'Hover Background', 'dotus-core' ),
						'description' => esc_html__( 'Hover Background Color', 'dotus-core' ),
						'types' => [ 'gradient' ],
						'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn:after',
					]
				);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-about-section .wpo-about-text .theme-btn:hover',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section

		

	}

	/**
	 * Render About widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$about_subtitle = !empty( $settings['about_subtitle'] ) ? $settings['about_subtitle'] : '';
		$about_title = !empty( $settings['about_title'] ) ? $settings['about_title'] : '';
		$about_content = !empty( $settings['about_content'] ) ? $settings['about_content'] : '';

		$bg_image = !empty( $settings['about_image']['id'] ) ? $settings['about_image']['id'] : '';	
		
		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image , '_wp_attachment_image_alt', true);

		$btn_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';

		$btn_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty( $btn_link ) ?  $btn_external.' '.$btn_nofollow : '';

		$button = $btn_link ? '<a href="'.esc_url($btn_link).'" '.esc_attr( $btn_link_attr ).' class="theme-btn" >'.esc_html( $btn_text ).'</a>' : '';

		// Turn output buffer on
		ob_start(); ?>
	  <div class="wpo-about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="wpo-about-wrap">
                        <div class="wpo-about-img">
                          <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="wpo-about-text">
                         <?php	
                          if( $about_subtitle ) { echo '<span>'.esc_html( $about_subtitle ).'</span>'; }
                          if( $about_title ) { echo '<h2>'.wp_kses_post( $about_title ).'</h2>'; }
                       		if( $about_content ) { echo wp_kses_post( $about_content ); } 
                       		echo $button
                       ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
		<?php 
			echo ob_get_clean();	
		}
	/**
	 * Render About widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_About() );