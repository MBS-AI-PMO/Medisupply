<?php
/*
 * Elementor Dotus Testimonial Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Dotus_Testimonial extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_testimonial';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Testimonial', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-testimonial';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Testimonial widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_testimonial'];
	}
	
	/**
	 * Register Dotus Testimonial widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_testimonial',
			[
				'label' => esc_html__( 'Testimonial Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'section_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub Title Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type subtitle text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__( 'Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'section_number',
			[
				'label' => esc_html__( 'Number Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Number Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'testimonial_title',
			[
				'label' => esc_html__( 'Testimonial Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_subtitle',
			[
				'label' => esc_html__( 'Testimonial Sub Title', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Testimonial Sub Title', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type testimonial Sub title here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'testimonial_content',
			[
				'label' => esc_html__( 'Testimonial Content', 'dotus-core' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Testimonial Content', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type testimonial Content here', 'dotus-core' ),
				'label_block' => true,
			]
		);
	  $repeater->add_control(
			'bg_image',
			[
				'label' => esc_html__( 'Testimonial Image', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				
			]
		);
	  $repeater->add_control(
			'small_image',
			[
				'label' => esc_html__( 'Small Image', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				
			]
		);
		$this->add_control(
			'testimonialItems_groups',
			[
				'label' => esc_html__( 'Testimonial Items', 'dotus-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'testimonial_title' => esc_html__( 'Testimonial', 'dotus-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ testimonial_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		
		// Testimonial Name Style 
		$this->start_controls_section(
			'testimonials_section_name_style',
			[
				'label' => esc_html__( 'Testimonial Name', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'testimonials_dotus_name_typography',
				'selector' => '{{WRAPPER}}  .wpo-testimonial-section .testimonial-right .testimonial-right-text h2',
			]
		);
		$this->add_control(
			'testimonials_name_color',
			[
				'label' => esc_html__( 'Name Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonial-section .testimonial-right .testimonial-right-text h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		// Testimonial Title Style 
		$this->start_controls_section(
			'testimonials_section_title_style',
			[
				'label' => esc_html__( 'Testimonial Title', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'testimonials_dotus_title_typography',
				'selector' => '{{WRAPPER}} .wpo-testimonial-section .testimonial-right .testimonial-right-text span',
			]
		);
		$this->add_control(
			'testimonials_title_color',
			[
				'label' => esc_html__( 'Name Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonial-section .testimonial-right .testimonial-right-text span' => 'color: {{VALUE}};',
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
				'selector' => '{{WRAPPER}}  .wpo-testimonial-section .testimonial-right .testimonial-right-text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonial-section .testimonial-right .testimonial-right-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		// Dot Color
		$this->start_controls_section(
			'section_quote_style',
			[
				'label' => esc_html__( 'Dot', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'dot_br_color',
			[
				'label' => esc_html__( 'Active Background', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonial-section .testimonial-right .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'dot_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-testimonial-section .testimonial-right .slick-dots button' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	}

	/**
	 * Render Testimonial widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$testimonialItems_groups = !empty( $settings['testimonialItems_groups'] ) ? $settings['testimonialItems_groups'] : [];

		$section_subtitle = !empty( $settings['section_subtitle'] ) ? $settings['section_subtitle'] : '';
		$section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		$section_number = !empty( $settings['section_number'] ) ? $settings['section_number'] : '';

		// Turn output buffer on
		ob_start(); ?>
		<div class="wpo-testimonial-section">
	    <div class="container">
	        <div class="row align-items-center">
	            <div class="col-lg-3 col-12">
	                <div class="testimonial-left">
	                	 <?php
	                	  if( $section_subtitle ) { echo ' <div class="theme-btn">'.esc_html( $section_subtitle ).'</div>'; }
	                	 ?>
	                    <div class="fun-fact-grids clearfix">
	                        <div class="grid">
	                            <div class="info">
	                                <h3>
	                                    <span class="odometer" data-count="<?php echo esc_attr( $section_number ); ?>">00</span>
	                                    <i class="fa fa-plus" aria-hidden="true"></i>
	                                </h3>
	                               <?php if( $section_title ) { echo '<p>'.esc_html( $section_title ).'</p>'; } ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <div class="col-lg-9 col-12">
	                <div class="testimonial-right">
	                    <div class="row align-items-center justify-content-center">
	                        <div class="col-lg-4 co-12">
	                            <div class="slider-for">
	                            		<?php 	// Group Param Output
																	if( is_array( $testimonialItems_groups ) && !empty( $testimonialItems_groups ) ){
																	foreach ( $testimonialItems_groups as $each_items ) { 

																	$image_url = wp_get_attachment_url( $each_items['bg_image']['id'] );
																	$image_alt = get_post_meta( $each_items['bg_image']['id'], '_wp_attachment_image_alt', true);

																	?>
	                                <div class="testimonial-right-img">
	                                    <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_attr( $image_alt ).'">'; } ?>
	                                </div>
	                                <?php }
	                    						} ?>	
	                            </div>
	                        </div>
	                        <div class="col-lg-8 col-12">
	                            <div class="slider-nav">
	                            	<?php 	// Group Param Output
																if( is_array( $testimonialItems_groups ) && !empty( $testimonialItems_groups ) ){
																foreach ( $testimonialItems_groups as $each_items ) { 

																$testimonial_title = !empty( $each_items['testimonial_title'] ) ? $each_items['testimonial_title'] : '';
																$testimonial_subtitle = !empty( $each_items['testimonial_subtitle'] ) ? $each_items['testimonial_subtitle'] : '';
																$testimonial_content = !empty( $each_items['testimonial_content'] ) ? $each_items['testimonial_content'] : '';

																?>
	                                <div class="testimonial-right-text">
	                                  <?php 
	                                    if( $testimonial_content ) { echo '<p>'.esc_html( $testimonial_content ).'</p>'; }
                                     	if( $testimonial_title ) { echo '<h2>'.esc_html( $testimonial_title ).'</h2>'; } 
									                  	if( $testimonial_subtitle ) { echo '<span>'.esc_html( $testimonial_subtitle ).'</span>'; }
	                                  ?>
	                                </div>
 																	<?php }
	                    						} ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
		</div>
		<?php 
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Testimonial widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Dotus_Testimonial() );