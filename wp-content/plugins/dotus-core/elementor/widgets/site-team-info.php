<?php
/*
 * Elementor dotus Team Info Widget
 * Author & Copyright: wpoceans
 */

namespace Elementor;

if (!defined('ABSPATH')) {
	exit;
}
// Exit if accessed directly

class Site_TeamInfo extends Widget_Base
{

	/**
	 * Retrieve the widget name.
	 */
	public function get_name()
	{
		return 'wpo-dotus_team_info';
	}

	/**
	 * Retrieve the widget title.
	 */
	public function get_title()
	{
		return esc_html__('Team Info', 'dotus-core');
	}

	/**
	 * Retrieve the widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-checkbox';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 */
	public function get_categories()
	{
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Follio TeamInfo widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	 */
	/*
    public function get_script_depends() {
    return ['wpo-dotus_team_info'];
    }
     */

	/**
	 * Register Follio TeamInfo widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'section_TeamInfo',
			[
				'label' => esc_html__('Team Info Options', 'dotus-core'),
			]
		);
		$this->add_control(
			'section_title',
			[
				'label' => esc_html__('Title Text', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'dotus-core'),
				'placeholder' => esc_html__('Type title text here', 'dotus-core'),
				'label_block' => true,
			]
		);
		$this->add_control(
			'team_image',
			[
				'label' => esc_html__('Team Image', 'dotus-core'),
				'type' => Controls_Manager::MEDIA,
				'frontend_available' => true,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'description' => esc_html__('Set your image.', 'dotus-core'),
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
		$repeater = new Repeater();
		$repeater->add_control(
			'single_team_title',
			[
				'label' => esc_html__('Title Text', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Title Text', 'dotus-core'),
				'placeholder' => esc_html__('Type title text here', 'dotus-core'),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'single_team_content',
			[
				'label' => esc_html__('Content', 'dotus-core'),
				'default' => esc_html__('your content text', 'dotus-core'),
				'placeholder' => esc_html__('Type your content here', 'dotus-core'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'single_teamItems_groups',
			[
				'label' => esc_html__('Team Info', 'dotus-core'),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'single_team_title' => esc_html__('Team Info', 'dotus-core'),
					],

				],
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ single_team_title }}}',
			]
		);
		$this->end_controls_section(); // end: Section

		// Item
		$this->start_controls_section(
			'section_item_info_style',
			[
				'label' => esc_html__('Info', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'info_bg_color',
			[
				'label' => esc_html__('BG Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .project-info-wrapper .project-info' => 'background-color: {{VALUE}};',
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
				'name' => 'dotus_subtitle_typography',
				'selector' => '{{WRAPPER}} .widget project-info h3',
			]
		);
		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .widget project-info h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'subtitle_padding',
			[
				'label' => __('Title Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .widget project-info h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Title
		$this->start_controls_section(
			'single_service_section_title_style',
			[
				'label' => esc_html__('Title', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'sasban_title_typography',
				'selector' => '{{WRAPPER}} .project-info-wrapper .project-info ul li',
			]
		);
		$this->add_control(
			'single_service_title_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .project-info-wrapper .project-info ul li' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_title_padding',
			[
				'label' => __('Title Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .project-info-wrapper .project-info ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

		// Content
		$this->start_controls_section(
			'single_service_section_content_style',
			[
				'label' => esc_html__('Content', 'dotus-core'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__('Typography', 'dotus-core'),
				'name' => 'single_service_content_typography',
				'selector' => '{{WRAPPER}} .project-info-wrapper .project-info ul li span',
			]
		);
		$this->add_control(
			'single_service_content_color',
			[
				'label' => esc_html__('Color', 'dotus-core'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .project-info-wrapper .project-info ul li span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'single_service_content_padding',
			[
				'label' => __('Title Padding', 'dotus-core'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em'],
				'selectors' => [
					'{{WRAPPER}} .project-info-wrapper .project-info ul li span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section(); // end: Section

	}

	/**
	 * Render TeamInfo widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$single_teamItems_groups = !empty($settings['single_teamItems_groups']) ? $settings['single_teamItems_groups'] : [];
		$section_title = !empty($settings['section_title']) ? $settings['section_title'] : '';

		$bg_image = !empty($settings['team_image']['id']) ? $settings['team_image']['id'] : '';
		// Image
		$image_url = wp_get_attachment_url($bg_image);
		$image_alt = get_post_meta($bg_image, '_wp_attachment_image_alt', true);

		$btn_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';

		$btn_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty( $btn_link ) ?  $btn_external.' '.$btn_nofollow : '';

		$button = $btn_link ? '<a href="'.esc_url($btn_link).'" '.esc_attr( $btn_link_attr ).' class="theme-btn" >'.esc_html( $btn_text ).'</a>' : '';

		// Turn output buffer on
		ob_start(); ?>
		<div class="team-info-wrap">
	    <div class="row align-items-center">
	        <div class="col-lg-6">
	            <div class="team-info-img">
	              <?php if ($image_url) {
									echo '<img src="' . esc_url($image_url) . '" alt="' . esc_url($image_alt) . '">';
								}  ?>
	            </div>
	        </div>
	        <div class="col-lg-6">
	            <div class="team-info-text">
	                <?php
										if ($section_title) {
											echo '<h2>' . esc_html($section_title) . '</h2>';
										}
									?>
	                <ul>
	                   <?php
											// Group Param Output
											if (is_array( $single_teamItems_groups ) && !empty( $single_teamItems_groups )) {
												foreach ($single_teamItems_groups as $each_item) {

													$single_team_title = !empty($each_item['single_team_title']) ? $each_item['single_team_title'] : '';
													$single_team_content = !empty($each_item['single_team_content']) ? $each_item['single_team_content'] : '';

													if ($single_team_title) {
														echo '<li>' . esc_html($single_team_title) . '<span>' . esc_html($single_team_content) . '</span></li>';
													}
												}
											}
											?>
	                </ul>
	                <?php echo $button; ?>
	            </div>
	        </div>
	    </div>
	</div>
	<?php
		// Return outbut buffer
		echo ob_get_clean();
	}
	/**
	 * Render TeamInfo widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 */

	//protected function _content_template(){}

}
Plugin::instance()->widgets_manager->register(new Site_TeamInfo());