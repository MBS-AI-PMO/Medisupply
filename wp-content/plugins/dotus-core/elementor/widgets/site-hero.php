<?php
/*
 * Elementor Dotus Hero Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Site_Hero extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-dotus_hero';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Hero', 'dotus-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'ti-panel';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Hero widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	public function get_script_depends()
	{
		return ['wpo-dotus_hero'];
	}

	/**
	 * Register Dotus Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_hero',
			[
				'label' => esc_html__('Hero Options', 'dotus-core'),
			]
		);
		$this->add_control(
			'hero_subtitle',
			[
				'label' => esc_html__('Sub Title Text', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Sub Title Here ', 'dotus-core'),
				'placeholder' => esc_html__('Type subtitle text here', 'dotus-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_title',
			[
				'label' => esc_html__('Title Text', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text Here ', 'dotus-core'),
				'placeholder' => esc_html__('Type title text here', 'dotus-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_content',
			[
				'label' => esc_html__('Content', 'dotus-core'),
				'default' => esc_html__('your content text', 'dotus-core'),
				'placeholder' => esc_html__('Type your content here', 'dotus-core'),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'dotus-core'),
				'default' => esc_html__('button text', 'dotus-core'),
				'placeholder' => esc_html__('Type button Text here', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__('Button Link', 'dotus-core'),
				'type' => Controls_Manager::URL,
				'placeholder' => 'https://your-link.com',
				'default' => [
					'url' => '',
				],
				'label_block' => true,
			]
		);
		$this->add_control(
			'hero_image',
			[
				'label' => esc_html__('Choose Image', 'dotus-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'hero_image_two',
			[
				'label' => esc_html__('Shape Image 1', 'dotus-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'hero_image_three',
			[
				'label' => esc_html__('Shape Image 2', 'dotus-core'),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'dotus-core'),
			]
		);
		$this->add_control(
			'feature_title',
			[
				'label' => esc_html__('Feature Text', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Neurologist', 'dotus-core'),
				'placeholder' => esc_html__('Type title text here', 'dotus-core'),
				'label_block' => true,
			]
		);
		$this->end_controls_section(); // end: Section
	

		// Body Style
		$this->start_controls_section(
			'section_body_style',
			[
				'label' => esc_html__('Body Style', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_background',
				'label' => esc_html__('Background', 'dotus-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .static-hero',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Custom Background', 'dotus-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->add_control(
			'section_body_fill_color',
			[
				'label' => esc_html__('Shap Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}  .static-hero .shape-1 svg circle' => 'fill: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Sub Title
		$this->start_controls_section(
			'section_subtitle_style',
			[
				'label' => esc_html__('Sub Title', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'dotus_subtitle_typography',
				'selector' => '{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-title .slide-title-btn',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-title .slide-title-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_bg_color',
			[
				'label' => esc_html__('Background', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-title .slide-title-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_dot_color',
			[
				'label' => esc_html__('Dot', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-title .slide-title-btn' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => esc_html__('Title Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-title .slide-title-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'dotus_title_typography',
				'selector' => '{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-sub-title h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-sub-title h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-sub-title h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'section_content_style',
			[
				'label' => esc_html__('Content', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'section_content_typography',
				'selector' => '{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-text ul li, .static-hero .hero-inner .wpo-static-hero-inner .slide-text p',
			]
		);
		$this->add_control(
			'content_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-text ul li, .static-hero .hero-inner .wpo-static-hero-inner .slide-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_list_color',
			[
				'label' => esc_html__('List', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-text ul li:before' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_list_bg_color',
			[
				'label' => esc_html__('List Background', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-text ul li:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'content_padding',
			[
				'label' => esc_html__('Content Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .hero-inner .wpo-static-hero-inner .slide-text ul li, .static-hero .hero-inner .wpo-static-hero-inner .slide-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section


		// Button
		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'button_one_typography',
				'label' => esc_html__('Typography', 'dotus-core'),
				'selector' => '{{WRAPPER}} .static-hero .slide-btn .theme-btn',
			]
		);
		$this->start_controls_tabs('button_one_style');
		$this->start_controls_tab(
			'button_one_normal',
			[
				'label' => esc_html__('Normal', 'dotus-core'),
			]
		);
		$this->add_control(
			'button_one_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btn .theme-btn' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_one_bgcolor',
				'label' => esc_html__('Background', 'dotus-core'),
				'description' => esc_html__('Button Color', 'dotus-core'),
				'types' => ['gradient'],
				'selector' => '{{WRAPPER}} .static-hero .slide-btn .theme-btn',
			]
		);
		$this->add_control(
			'button_padding',
			[
				'label' => esc_html__('Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btn .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_tab();  // end:Normal tab

		$this->start_controls_tab(
			'button_one_hover',
			[
				'label' => esc_html__('Hover', 'dotus-core'),
			]
		);
		$this->add_control(
			'button_one_hover_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .static-hero .slide-btn .theme-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_one_hover_bg_color',
				'label' => esc_html__('Hover Background', 'dotus-core'),
				'description' => esc_html__('Button Color', 'dotus-core'),
				'types' => ['gradient'],
				'selector' => '{{WRAPPER}} .static-hero .slide-btn .theme-btn:hover,.static-hero .slide-btn .theme-btn:after',
			]
		);
		$this->end_controls_tab();  // end:Hover tab
		$this->end_controls_tabs(); // end tabs

		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render Hero widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$hero_subtitle = !empty($settings['hero_subtitle']) ? $settings['hero_subtitle'] : '';
		$hero_title = !empty($settings['hero_title']) ? $settings['hero_title'] : '';
		$hero_content = !empty($settings['hero_content']) ? $settings['hero_content'] : '';

		$feature_title = !empty($settings['feature_title']) ? $settings['feature_title'] : '';

		$bg_image = !empty($settings['hero_image']['id']) ? $settings['hero_image']['id'] : '';
		$bg_image2 = !empty($settings['hero_image_two']['id']) ? $settings['hero_image_two']['id'] : '';
		$bg_image3 = !empty($settings['hero_image_three']['id']) ? $settings['hero_image_three']['id'] : '';

		$button_text = !empty($settings['btn_text']) ? $settings['btn_text'] : '';
		$button_link = !empty($settings['btn_link']['url']) ? $settings['btn_link']['url'] : '';
		$button_link_external = !empty($settings['btn_link']['is_external']) ? 'target="_blank"' : '';
		$button_link_nofollow = !empty($settings['btn_link']['nofollow']) ? 'rel="nofollow"' : '';
		$button_link_attr = !empty($button_link) ?  $button_link_external . ' ' . $button_link_nofollow : '';

		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		$image2_url = wp_get_attachment_url($bg_image2);
		$image2_alt = get_post_meta($bg_image2, '_wp_attachment_image_alt', true);

		$image3_url = wp_get_attachment_url($bg_image3);
		$image3_alt = get_post_meta($bg_image3, '_wp_attachment_image_alt', true);

		$dotus_button = $button_link ? '<a href="' . esc_url($button_link) . '" ' . $button_link_attr . ' class="btn theme-btn">' . esc_html($button_text) . '</a>' : '';

		if ($image2_url) {
			$bg_url = ' style="';
			$bg_url .= ($image2_url) ? 'background-image: url( ' . esc_url($image2_url) . ' );' : '';
			$bg_url .= '"';
		} else {
			$bg_url = '';
		}


		// Turn output buffer on
		ob_start(); ?>
		<div class="static-hero">
	    <div class="hero-container">
	        <div class="hero-inner">
	            <div class="container">
	                <div class="row align-items-center">
	                    <div class="col-xl-7 col-lg-8 col-12">
	                        <div class="wpo-static-hero-inner">
	                           <?php if ($hero_subtitle) { ?>
	                            <div class="slide-title">
	                                <div class="slide-title-btn"> <span></span>
	                                	<?php echo esc_html($hero_subtitle); ?>
	                                </div>
	                            </div>
	                            <?php } 
	                            if ($hero_title) { ?>
	                            <div class="slide-sub-title">
	                                <h2><?php echo esc_html($hero_title); ?></h2>
	                            </div>
	                          	<?php } 
	                          	if ($hero_content) { ?> 
	                            <div class="slide-text">
	                               <?php echo wp_kses_post($hero_content); ?>
	                            </div>
	                          	<?php } ?>
	                            <div class="clearfix"></div>
	                            <div class="slide-btn">
	                              	<?php echo $dotus_button; ?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="static-hero-right">
	        <div class="static-hero-img">
	            <div class="static-hero-img-inner">
	                <?php if ($image_url) {
										echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
									} ?>
	                <div class="hero-img-inner-boder"></div>
	            </div>
	            <div class="icon-1">
	                <div class="icon-img">
	                 <?php if ($image2_url) {
										echo '<img src="' . esc_url($image2_url) . '" alt="' . esc_url($image2_alt) . '">';
									} ?>
	                </div>

	                	<span><?php echo esc_html($feature_title); ?></span>
	                <div class="icon-boder"></div>
	            </div>
	        </div>
	    </div>
	    <div class="shape-1">
	        <svg width="696" height="839" viewBox="0 0 696 839" fill="none">
	            <g opacity="0.6" filter="url(#filter0_f_221_39)">
	                <circle cx="162" cy="305" r="234" />
	            </g>
	            <defs>
	                <filter id="filter0_f_221_39" x="-372" y="-229" width="1068" height="1068" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
	                    <feFlood flood-opacity="0" result="BackgroundImageFix" />
	                    <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
	                    <feGaussianBlur stdDeviation="150" result="effect1_foregroundBlur_221_39" />
	                </filter>
	            </defs>
	        </svg>
	    </div>
	    <div class="line-shape-1">
	      <?php if ($image3_url) {
					echo '<img src="' . esc_url($image3_url) . '" alt="' . esc_url($image3_alt) . '">';
				} ?>
	    </div>
	</div>
	<?php 
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render Hero widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_Hero());
