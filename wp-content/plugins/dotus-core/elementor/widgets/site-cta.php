<?php
/*
 * Elementor Dotus CTA Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_CTA extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_cta';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'CTA', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-call-to-action';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus CTA widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-dotus_cta'];
	}
	*/
	
	/**
	 * Register Dotus CTA widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_CTA',
			[
				'label' => esc_html__( 'CTA Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'cta_title',
			[
				'label' => esc_html__( 'Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
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
			'btn2_text',
			[
				'label' => esc_html__( 'Button/Link Text 2', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Button Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type btn text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn2_link',
			[
				'label' => esc_html__( 'Button Link 2', 'dotus-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		$this->end_controls_section();// end: Section


		// CTA Background
		$this->start_controls_section(
			'cta_section_background_style',
			[
				'label' => esc_html__( 'Background', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'cta_background_color',
				'label' => esc_html__('Background', 'dotus-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Background Color', 'dotus-core'),
						'default' => 'gradient',
					],
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
				'selector' => '{{WRAPPER}}  .wpo-donors-section .wpo-donors-wrap h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap h2' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


		// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__( 'Button', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => __( 'Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'condition' => [
					'btn_style' => array('style-one'),
				],
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn, 
						{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'button_bg_color',
					'label' => esc_html__('Background', 'dotus-core'),
					'types' => ['gradient'],
					'exclude' => ['image'],
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn',
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'dotus-core'),
							'default' => 'gradient',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn',
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
						'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn:hover,
						{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'button_bg_hover_color',
					'label' => esc_html__('Hover Background', 'dotus-core'),
					'types' => ['gradient'],
					'exclude' => ['image'],
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn:hover',
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'dotus-core'),
							'default' => 'gradient',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn:hover ',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section


		// Button
		$this->start_controls_section(
			'section_button2_style',
			[
				'label' => esc_html__( 'Button 2', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button2_padding',
			[
				'label' => __( 'Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->start_controls_tabs( 'button2_style' );
			$this->start_controls_tab(
				'button2_normal',
				[
					'label' => esc_html__( 'Normal', 'dotus-core' ),
				]
			);
			$this->add_control(
				'button2_color',
				[
					'label' => esc_html__( 'Color', 'dotus-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2, 
						{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'button2_bg_color',
					'label' => esc_html__('Background', 'dotus-core'),
					'types' => ['gradient'],
					'exclude' => ['image'],
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2',
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'dotus-core'),
							'default' => 'gradient',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button2_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2',
				]
			);
			$this->end_controls_tab();  // end:Normal tab
			
			$this->start_controls_tab(
				'button2_hover',
				[
					'label' => esc_html__( 'Hover', 'dotus-core' ),
				]
			);
			$this->add_control(
				'button2_hover_color',
				[
					'label' => esc_html__( 'Color', 'dotus-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2:hover,
						{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'button2_bg_hover_color',
					'label' => esc_html__('Hover Background', 'dotus-core'),
					'types' => ['gradient'],
					'exclude' => ['image'],
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2:hover',
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Background Color', 'dotus-core'),
							'default' => 'gradient',
						],
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button2_hover_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-donors-section .wpo-donors-wrap .donors-btn a.cta-btn-s2:hover ',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render CTA widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();

		$cta_title = !empty( $settings['cta_title'] ) ? $settings['cta_title'] : '';

		$btn_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';

		$btn_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty( $btn_link ) ?  $btn_external.' '.$btn_nofollow : '';

		$btn2_text = !empty( $settings['btn2_text'] ) ? $settings['btn2_text'] : '';

		$btn2_link = !empty( $settings['btn2_link']['url'] ) ? $settings['btn2_link']['url'] : '';
		$btn2_external = !empty( $settings['btn2_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn2_nofollow = !empty( $settings['btn2_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn2_link_attr = !empty( $btn2_link ) ?  $btn2_external.' '.$btn2_nofollow : '';

		$button = $btn_link ? '<a href="'.esc_url($btn_link).'" '.esc_attr( $btn_link_attr ).' class="cta-btn" >'.esc_html( $btn_text ).'</a>' : '';

		$button2 = $btn2_link ? '<a href="'.esc_url($btn2_link).'" '.esc_attr( $btn2_link_attr ).' class="cta-btn-s2" >'.esc_html( $btn2_text ).'</a>' : '';

		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-donors-section">
        <div class="container">
            <div class="wpo-donors-wrap">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <?php if( $cta_title) { echo '<h2>'.esc_html( $cta_title ).'</h2>'; } ?>
                    </div>
                    <div class="col-lg-6">
                        <div class="donors-btn">
                          <?php echo $button.$button2; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </div>

	<?php // Return outbut buffer
		echo ob_get_clean();
		
	}
	/**
	 * Render CTA widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_CTA() );