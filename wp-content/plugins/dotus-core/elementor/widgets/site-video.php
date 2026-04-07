<?php
/*
 * Elementor Dotus Video Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_Video extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_video';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Video', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-video-camera';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Video widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_video'];
	}
	
	/**
	 * Register Dotus Video widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_video',
			[
				'label' => esc_html__( 'Video Options', 'dotus-core' ),
			]
		);
		
	$this->add_control(
			'video_image',
			[
				'label' => esc_html__( 'Video Image', 'dotus-core' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				
			]
		);
		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Video Link', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type video link here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$this->end_controls_section();// end: Section
		

		// Title
		$this->start_controls_section(
			'section_video_style',
			[
				'label' => esc_html__( 'Video', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'video_bg_color',
			[
				'label' => esc_html__( 'Background', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-video .video-btn' => 'background-color: {{VALUE}};',
				],
			]
		);	
		$this->add_control(
			'video_border_color',
			[
				'label' => esc_html__( 'Border', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .funfact-video .video-btn' => 'border-color: {{VALUE}};',
				],
			]
		);	

		$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'video_btn_icon_color',
					'label' => esc_html__('Color', 'dotus-core'),
					'types' => ['gradient'],
					'exclude' => ['image'],
					'selector' => '{{WRAPPER}} .funfact-video .video-btn .fi::before',
					'fields_options' => [
						'background' => [
							'label' => esc_html__('Color', 'dotus-core'),
							'default' => 'gradient',
						],
					],
				]
			);
		$this->end_controls_section();// end: Section	
		
	}

	/**
	 * Render Video widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		$bg_image = !empty( $settings['video_image']['id'] ) ? $settings['video_image']['id'] : '';	
			// Image
		$image_url = wp_get_attachment_url( $bg_image );
		$image_alt = get_post_meta( $bg_image , '_wp_attachment_image_alt', true);

		$video_link = !empty( $settings['video_link'] ) ? $settings['video_link'] : '';
		// Turn output buffer on
		ob_start();

		if ( $video_link ) { ?>
		<div class="funfact-video mt-0">
         <?php  if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
        <a href="<?php echo esc_url( $video_link ); ?>" class="video-btn" data-type="iframe"><i class="fi flaticon-play"></i></a>
    </div>
		 <?php }
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Video widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register_widget_type( new Site_Video() );