<?php
/*
 * Elementor Dotus Contact Form 7 Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_Contact_Form extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_contact_form';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Contact Form', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Contact Form widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	/*
	public function get_script_depends() {
		return ['wpo-dotus_contact_form'];
	}
	 */
	
	/**
	 * Register Dotus Contact Form widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_contact_form',
			[
				'label' => esc_html__( 'Form Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'form_style',
			[
				'label' => esc_html__('Form Style', 'dotus-core'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__('Style One', 'dotus-core'),
					'style-two' => esc_html__('Style two', 'dotus-core'),
				],
				'default' => 'style-one',
				'description' => esc_html__('Select your form style.', 'dotus-core'),
			]
		);
		$this->add_control(
			'form_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub Title Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type subtitle text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'form_title',
			[
				'label' => esc_html__( 'Title', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Default title', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type your title here', 'dotus-core' ),
			]
		);	
		$this->add_control(
			'form_image',
			[
				'label' => esc_html__( 'Shape Image', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'form_id',
			[
				'label' => esc_html__( 'Select contact form', 'dotus-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => Controls_Helper_Output::get_posts('wpcf7_contact_form'),
			]
		);
		$this->end_controls_section();// end: Section

		// Body Style
		$this->start_controls_section(
			'section_form_body_style',
			[
				'label' => esc_html__( 'Body', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'form_body_color',
			[
				'label' => esc_html__( 'Body Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-appoinment-section .appoinment-wrap' => 'background-color: {{VALUE}};',
				],
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
				'selector' => '{{WRAPPER}} .wpo-appoinment .appoinment-text .appoinment-btn',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .wpo-appoinment .appoinment-text .appoinment-btn' => 'color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'subtitle_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .wpo-appoinment .appoinment-text .appoinment-btn' => 'background-color: {{VALUE}};',
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
					'{{WRAPPER}}  .wpo-appoinment .appoinment-text .appoinment-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	

		// Title Style
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
				'selector' => '{{WRAPPER}}  .wpo-appoinment .appoinment-text h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-appoinment .appoinment-text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_pad',
			[
				'label' => __( 'Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}}  .wpo-appoinment .appoinment-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	

		$this->start_controls_section(
			'section_form_style',
			[
				'label' => esc_html__( 'Form', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'form_typography',
				'selector' => '{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="text"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="email"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="date"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="time"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="number"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form textarea, 
				{{WRAPPER}} .wpo-appoinment .appoinment-form select, 
				{{WRAPPER}} .wpo-appoinment .appoinment-form .form-control, 
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',
			]
		);
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'form_border',
				'label' => esc_html__( 'Border', 'dotus-core' ),
				'selector' => '{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="text"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="email"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-forminput[type="date"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="time"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="number"], 
				{{WRAPPER}} .wpo-appoinment .appoinment-form textarea, 
				{{WRAPPER}} .wpo-appoinment .appoinment-form select, 
				{{WRAPPER}} .wpo-appoinment .appoinment-form .form-control, 
				{{WRAPPER}} .wpo-appoinment .appoinment-form .nice-select,
				{{WRAPPER}} .track-contact .track-trace select, 
				{{WRAPPER}} .track-contact .track-trace input',

			]
		);
		$this->add_control(
			'placeholder_text_color',
			[
				'label' => __( 'Placeholder Text Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-appoinment .appoinment-form input:not([type="submit"])::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-appoinment .appoinment-form input:not([type="submit"])::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-appoinment .appoinment-form input:not([type="submit"])::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-appoinment .appoinment-form input:not([type="submit"])::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-appoinment .appoinment-form textarea::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-appoinment .appoinment-form textarea::-moz-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-appoinment .appoinment-form textarea::-ms-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .wpo-appoinment .appoinment-form textarea::-o-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace input::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .track-contact .track-trace select::-webkit-input-placeholder' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'label_color',
			[
				'label' => __( 'Label Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-appoinment .appoinment-form label' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => __( 'Text Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="text"], 
					{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="email"], 
					{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="date"], 
					{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="time"], 
					{{WRAPPER}} .wpo-appoinment .appoinment-form input[type="number"], 
					{{WRAPPER}} .wpo-appoinment .appoinment-form textarea, 
					{{WRAPPER}} .wpo-appoinment .appoinment-form select, 
					{{WRAPPER}} .wpo-appoinment .appoinment-form .form-control, 
					{{WRAPPER}} .track-contact .track-trace input, 
					{{WRAPPER}} .wpo-appoinment .appoinment-form .nice-select' => 'color: {{VALUE}} !important;',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
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
				'selector' => '{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit',
			]
		);
		$this->add_responsive_control(
			'btn_width',
			[
				'label' => esc_html__( 'Width', 'dotus-core' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
				],
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit' => 'min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'btn_margin',
			[
				'label' => __( 'Margin', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_color',
				[
					'label' => esc_html__( 'Background Color', 'dotus-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit',
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
						'{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit:hover' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'button_bg_hover_color',
				[
					'label' => esc_html__( 'Background Color', 'dotus-core' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit:hover' => 'background-color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'button_hover_border',
					'label' => esc_html__( 'Border', 'dotus-core' ),
					'selector' => '{{WRAPPER}} .wpo-appoinment .appoinment-form .wpcf7-form-control.wpcf7-submit:hover',
				]
			);
			$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs
		
		$this->end_controls_section();// end: Section

	}

	/**
	 * Render Contact Form widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$form_style = !empty($settings['form_style']) ? $settings['form_style'] : '';

		$form_id = !empty( $settings['form_id'] ) ? $settings['form_id'] : '';
		$form_subtitle = !empty( $settings['form_subtitle'] ) ? $settings['form_subtitle'] : '';
		$form_title = !empty( $settings['form_title'] ) ? $settings['form_title'] : '';

		$bg_image = !empty( $settings['form_image']['id'] ) ? $settings['form_image']['id'] : '';	
		
		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image , '_wp_attachment_image_alt', true);

		if ( $form_style == 'style-one') {
			$form_wrapper = 'wpo-appoinment-section';
			$form_col = 'col-xl-6 col-lg-12 col-12';
			$title_col = 'col-xl-6 col-lg-12 col-12';
			$row_class = 'align-items-center';
		} else {
			$form_wrapper = 'wpo-appoinment-section-s2';
			$form_col = 'col-lg-10 col-12';
			$title_col = 'col-lg-6';
			$row_class = 'justify-content-center';
		}

		// Turn output buffer on
		ob_start(); ?>

		<div class="wpo-appoinment <?php echo esc_attr( $form_wrapper ); ?>">
	    <div class="container">
	        <div class="appoinment-wrap">
	            <div class="row <?php echo esc_attr( $row_class ); ?>">
	                <div class="<?php echo esc_attr( $title_col ); ?>">
	                    <div class="appoinment-text">
	                    	<?php 
							          	if( $form_subtitle ) { echo '<span class="appoinment-btn">'.esc_html( $form_subtitle ).'</span>'; } 
							          	if( $form_title ) { echo '<h2>'.esc_html( $form_title ).'</h2>'; } 
							         ?>
	                    </div>
	                </div>
	                <div class="<?php echo esc_attr( $form_col ); ?>">
	                    <div class="appoinment-right">
	                        <div class="appoinment-form">
	                            <?php echo do_shortcode( '[contact-form-7 id="'. $form_id .'"]' ); ?>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <?php if ( $form_style == 'style-one' ) { ?>
	            	<div class="shape-1">
	              <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
	            </div>
	            <?php } ?>
	        </div>
	    </div>
		</div>
		<?php
		// Return outbut buffer
		echo ob_get_clean();
		
		} 
		


	/**
	 * Render Contact Form widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_Contact_Form() );