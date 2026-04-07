<?php
/*
 * Elementor Dotus Feature Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Feature extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-dotus_feature';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Feature', 'dotus-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-icon-box';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Feature widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-dotus_feature'];
	}

	/**
	 * Register Dotus Feature widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_feature',
			[
				'label' => esc_html__('Feature Options', 'dotus-core'),
			]
		);
		$this->add_control(
			'section_subtitle',
			[
				'label' => esc_html__( 'Sub Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Why Choose Us?', 'dotus-core' ),
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
			'feature_image',
			[
				'label' => esc_html__( 'Feature Image', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'feature_image2',
			[
				'label' => esc_html__( 'Feature Image 2', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'feature_image3',
			[
				'label' => esc_html__( 'Feature Image 3', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__( 'Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'funfact_title',
			[
				'label' => esc_html__( 'Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'funfact_number',
			[
				'label' => esc_html__( 'Funfact Number', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '99', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type funfact Number here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'feature_title',
			[
				'label' => esc_html__('Title Text', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Make Donation', 'dotus-core'),
				'placeholder' => esc_html__('Type title text here', 'dotus-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'feature_link',
			[
				'label' => esc_html__('link', 'dotus-core'),
				'default' => esc_html__('#', 'dotus-core'),
				'placeholder' => esc_html__('Type your link here', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'featureItems_groups',
			[
				'label' => esc_html__('Feature', 'dotus-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'feature_title' => esc_html__('Feature', 'dotus-core'),
					],

				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ feature_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section


		$this->start_controls_section(
			'section_feature_section_style',
			[
				'label' => esc_html__('Body Style', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'feature_item_bg_color',
			[
				'label' => esc_html__('Background Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_item_shape_color',
			[
				'label' => esc_html__('Shape Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-shape-1 svg circle' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'feature_body_padding',
			[
				'label' => esc_html__('Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} ..wpo-service-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Sub Title', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'dotus_title_typography',
				'selector' => '{{WRAPPER}} .wpo-service-section .service-left .wpo-section-title span',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .wpo-section-title span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_bg_color',
			[
				'label' => esc_html__('Background Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .wpo-section-title span' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __('Title Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .wpo-section-title span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__('Title', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .wpo-service-section .service-left .wpo-section-title h2',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .wpo-section-title h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Feature
		$this->start_controls_section(
			'section_feature_content_style',
			[
				'label' => esc_html__('Feature', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'section_feature_content_typography',
				'selector' => '{{WRAPPER}} .wpo-service-section .service-left .service-left-wrap .service-single-btn a',
			]
		);
		$this->add_control(
			'content_feature_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .service-left-wrap .service-single-btn a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_content_bg_color',
			[
				'label' => esc_html__('Background', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .service-left-wrap .service-single-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_content_border_color',
			[
				'label' => esc_html__('Border', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .service-left-wrap .service-single-btn' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_content_hover_color',
			[
				'label' => esc_html__('Hover Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .service-left-wrap .service-single-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_content_hover_bg_color',
			[
				'label' => esc_html__('Hover Background', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .service-left-wrap .service-single-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'feature_content_hover_border_color',
			[
				'label' => esc_html__('Hover Border', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-left .service-left-wrap .service-single-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section



		// Funfact
		$this->start_controls_section(
			'section_funfact_style',
			[
				'label' => esc_html__('Funfact', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'funfact_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-right .service-right-wrap-2 .fun-fact-grids .info h3 .odometer,.wpo-service-section .service-right .service-right-wrap-2 .fun-fact-grids .info h3 i:before, .wpo-service-section .service-right .service-right-wrap-2 .fun-fact-grids .info p, .wpo-service-section .service-right .service-right-wrap-2 .fun-fact-grids .info i:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'funfact_bg_color',
			[
				'label' => esc_html__('Background Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .service-right .service-right-wrap-2 .fun-fact-grids .info' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section



	}

	/**
	 * Render Feature widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$featureItems_groups = !empty($settings['featureItems_groups']) ? $settings['featureItems_groups'] : [];
		// Turn output buffer on

		$section_subtitle = !empty( $settings['section_subtitle'] ) ? $settings['section_subtitle'] : '';
		$section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';

		$funfact_title = !empty( $settings['funfact_title'] ) ? $settings['funfact_title'] : '';
		$funfact_number = !empty( $settings['funfact_number'] ) ? $settings['funfact_number'] : '';

		$bg_image = !empty( $settings['feature_image']['id'] ) ? $settings['feature_image']['id'] : '';	
		$bg_image2 = !empty( $settings['feature_image2']['id'] ) ? $settings['feature_image2']['id'] : '';	
		$bg_image3 = !empty( $settings['feature_image3']['id'] ) ? $settings['feature_image3']['id'] : '';	

		// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image , '_wp_attachment_image_alt', true);

		// Image
		$image2_url = wp_get_attachment_url( $bg_image2 );
		$image2_alt = get_post_meta( $bg_image2 , '_wp_attachment_image_alt', true);

		// Image
		$image3_url = wp_get_attachment_url( $bg_image3 );
		$image3_alt = get_post_meta( $bg_image3 , '_wp_attachment_image_alt', true);


		ob_start(); ?>

		<div class="wpo-service-section section-padding">
    	<div class="service-shape-1">
        <svg width="794" height="783" viewBox="0 0 794 783" fill="none">
            <g opacity="0.6" filter="url(#filter0_f_225_6)">
                <circle cx="534" cy="249" r="234" />
            </g>
            <defs>
                <filter id="filter0_f_225_6" x="0" y="-285" width="1068" height="1068" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                    <feGaussianBlur stdDeviation="150" result="effect1_foregroundBlur_225_6" />
                </filter>
            </defs>
        </svg>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-12 col-md-12 col-12">
                <div class="service-left">
                    <div class="wpo-section-title">
                        <?php 
					                if( $section_subtitle ) { echo '<span>'.esc_html( $section_subtitle ).'</span>'; } 
									      	if( $section_title ) { echo '<h2>'.esc_html( $section_title ).'</h2>'; }
									      ?>
                    </div>
                    <div class="service-left-wrap">
                    	<?php 	// Group Param Output
                    	$id = 0;
												if( is_array( $featureItems_groups ) && !empty( $featureItems_groups ) ){
												foreach ( $featureItems_groups as $each_item ) { 
													$id++;

													if ( $id == 1 ) {
														$extra_class = 'mr-20';
													} elseif ($id == 2 ) {
														$extra_class = '';
													} elseif ($id == 3 ) {
														$extra_class = 'mr-20';
													} elseif ($id == 4 ) {
														$extra_class = '';
													} elseif ($id == 5 ) {
														$extra_class = 'mr-20';
													} else {
														$extra_class = '';
													}


												$feature_title = !empty( $each_item['feature_title'] ) ? $each_item['feature_title'] : '';

												$feature_link = !empty( $each_item['feature_link'] ) ? $each_item['feature_link'] : '';
												
												if ( $feature_link ) {
										      $link_o = '<a href="'. $feature_link .'" class="'.esc_attr( $extra_class ).'">';
										      $link_c = '</a>';
										    } else {
										      $link_o = '';
										      $link_c = '';
										    }

												?>
												<div class="service-single-btn ">
	                     		<?php 
	                     			echo $link_o;
	                     			if( $feature_title ) { echo wp_kses_post( $feature_title ); }
	                     			echo $link_c;
	                     		?>
                     		</div>
                      <?php }
                    } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="service-right">
        <div class="service-right-wrap">
            <div class="service-right-img-1">
               <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
                <div class="service-right-img-boder"></div>
            </div>
            <div class="service-img-2">
               <?php if( $image2_url ) { echo '<img src="'.esc_url( $image2_url ).'" alt="'.esc_url( $image2_alt ).'">'; }  ?>
                <div class="service-img-boder"></div>
            </div>
        </div>
        <div class="service-right-wrap-2">
            <div class="service-img-3">
                <?php if( $image3_url ) { echo '<img src="'.esc_url( $image3_url ).'" alt="'.esc_url( $image3_alt ).'">'; }  ?>
                <div class="service-img-boder"></div>
            </div>
            <?php if ( $funfact_title && $funfact_number ) { ?>
            <div class="fun-fact-grids clearfix">
                <div class="grid">
                    <div class="info">
                        <h3>
                            <span class="odometer" data-count="<?php echo esc_attr( $funfact_number ); ?>">00</span>
                            <i class="fa fa-percent" aria-hidden="true"></i>
                        </h3>
                        <p><?php echo esc_html($funfact_title ); ?></p>
                        <div class="icon">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
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
	 * Render Feature widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Feature());
