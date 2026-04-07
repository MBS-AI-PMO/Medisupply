<?php
/*
 * Elementor Dotus Topbar Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Theme_Topbar extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_topbar';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Topbar', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-preferences';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Topbar widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_topbar'];
	}
	
	/**
	 * Register Dotus Topbar widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_topbar',
			[
				'label' => esc_html__( 'Topbar Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'site_logo',
			[
				'label' => esc_html__( 'Site Logo', 'dotus-core' ),
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
		$repeater = new Repeater();
		$repeater->add_control(
			'topbar_title',
			[
				'label' => esc_html__( 'Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Call Us:', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);	
		$repeater->add_control(
			'topbar_desc',
			[
				'label' => esc_html__( 'Desc Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '+(684) 555-0102', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'topbar_link',
			[
				'label' => esc_html__( 'Link Url', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type link url here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'topbar_icon',
			[
				'label' => __( 'Icon', 'dotus-core' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fi flaticon-phone-call',
					'library' => 'solid',
				],
			]
		);
		$this->add_control(
			'topbarItems_groups',
			[
				'label' => esc_html__( 'Topbar item', 'dotus-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'topbar_title' => esc_html__( 'Topbar', 'dotus-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ topbar_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		

		$this->start_controls_section(
			'section_topbar_section_style',
			[
				'label' => esc_html__( 'Topbar', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'topbar_item_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'topbar_border_color',
			[
				'label' => esc_html__( 'Border Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar ' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Info Icons
		$this->start_controls_section(
			'topbar_icon_style',
			[
				'label' => esc_html__( 'Icon', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'topbar_icon_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar .contact-info-wrap .contact-info .icon .fi:before' => 'color: {{VALUE}};',
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
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'dotus_title_typography',
				'selector' => '{{WRAPPER}} .topbar .contact-info-wrap .contact-info .info-text span',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar .contact-info-wrap .contact-info .info-text span' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_padding',
			[
				'label' => __( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .topbar .contact-info-wrap .contact-info .info-text span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Title Desctription
		$this->start_controls_section(
			'section_title_info_style',
			[
				'label' => esc_html__( 'Title Info', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'dotus_title_info_typography',
				'selector' => '{{WRAPPER}} .topbar .contact-info-wrap .contact-info .info-text p',
			]
		);
		$this->add_control(
			'title_info_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .topbar .contact-info-wrap .contact-info .info-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_info_padding',
			[
				'label' => __( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .topbar .contact-info-wrap .contact-info .info-text p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	
		// Title Desctription
		$this->start_controls_section(
			'section_topbar_btn_style',
			[
				'label' => esc_html__( 'Button', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'dotus_topbar_btn_typography',
				'selector' => '{{WRAPPER}} .topbar .contact-info-wrap .contact-info .theme-btn',
			]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
		        'name' => 'topbar_btn_background',
		        'label' => esc_html__('Background', 'dotus-core'),
		        'types' => ['gradient'],
		        'exclude' => ['image'],
		        'selector' => '{{WRAPPER}} .topbar .contact-info-wrap .contact-info .theme-btn',
		        'fields_options' => [
		            'background' => [
		                'label' => esc_html__('Custom Background', 'dotus-core'),
		                'default' => 'gradient',
		            ],
		            'color' => [
		                'default' => '#ED6B37',
		            ],
		        ],
		    ]
		);
		$this->add_group_control(
		    Group_Control_Background::get_type(),
		    [
		        'name' => 'topbar_btn_hover_background',
		        'label' => esc_html__('Background', 'dotus-core'),
		        'types' => ['gradient'],
		        'exclude' => ['image'],
		        'selector' => '{{WRAPPER}} .topbar .contact-info-wrap .contact-info .theme-btn:after',
		        'fields_options' => [
		            'background' => [
		                'label' => esc_html__('Hover Background', 'dotus-core'),
		                'default' => 'gradient',
		            ],
		            'color' => [
		                'default' => '#ED6B37',
		            ],
		        ],
		    ]
		);
		$this->add_control(
			'topbar_btn_padding',
			[
				'label' => __( 'Button Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .topbar .contact-info-wrap .contact-info .theme-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	
		
	}

	/**
	 * Render Topbar widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$topbarItems_groups = !empty( $settings['topbarItems_groups'] ) ? $settings['topbarItems_groups'] : [];


		$site_logo = !empty( $settings['site_logo']['id'] ) ? $settings['site_logo']['id'] : '';	
		
		// Image
		$image_url = wp_get_attachment_url( $site_logo );
		$image_alt = get_post_meta( $site_logo , '_wp_attachment_image_alt', true);

		$btn_text = !empty( $settings['btn_text'] ) ? $settings['btn_text'] : '';

		$btn_link = !empty( $settings['btn_link']['url'] ) ? $settings['btn_link']['url'] : '';
		$btn_external = !empty( $settings['btn_link']['is_external'] ) ? 'target="_blank"' : '';
		$btn_nofollow = !empty( $settings['btn_link']['nofollow'] ) ? 'rel="nofollow"' : '';
		$btn_link_attr = !empty( $btn_link ) ?  $btn_external.' '.$btn_nofollow : '';


		$button = $btn_link ? '<a href="'.esc_url($btn_link).'" '.esc_attr( $btn_link_attr ).' class="theme-btn" >'.esc_html( $btn_text ).'</a>' : '';


		// Turn output buffer on
		ob_start(); ?>

		<div class="topbar">
		    <div class="container">
		        <div class="row align-items-center">
		            <div class="col-lg-3 col-12 d-lg-block d-none">
		                <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
		                  <?php  if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; }  ?>
		                </a>
		            </div>
		            <div class="col-lg-9 col-12">
		                <div class="contact-info-wrap">
	                     <?php
							        		// Group Param Output
													if( is_array( $topbarItems_groups ) && !empty( $topbarItems_groups ) ){
													foreach ( $topbarItems_groups as $each_item ) { 	

													$topbar_title = !empty( $each_item['topbar_title'] ) ? $each_item['topbar_title'] : '';
													$topbar_desc = !empty( $each_item['topbar_desc'] ) ? $each_item['topbar_desc'] : '';
													$topbar_link = !empty( $each_item['topbar_link'] ) ? $each_item['topbar_link'] : '';
												
													if ( $topbar_link ) {
											      $link_o = '<a href="'. $topbar_link .'" class="info-link">';
											      $link_c = '</a>';
											    } else {
											      $link_o = '';
											      $link_c = '';
											    }
										    
											   ?>
		                    <div class="contact-info">
		                        <div class="icon">
		                        <?php \Elementor\Icons_Manager::render_icon( $each_item['topbar_icon'], [ 'aria-hidden' => 'true' ] ); ?>
		                        </div>
		                        <div class="info-text">
		                        	 <?php 
												      	if( $topbar_title ) { echo '<span>'.esc_html( $topbar_title ).'</span>'; }
												      	if( $topbar_desc ) { echo '<p>'.esc_html( $topbar_desc ).'</p>'; }
												      ?>
		                        </div>
		                    </div>
		                    	<?php 
		                    	}
												}
											 ?>
		                    <div class="contact-info">
		                       <?php echo $button; ?>
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
	 * Render Topbar widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Theme_Topbar() );