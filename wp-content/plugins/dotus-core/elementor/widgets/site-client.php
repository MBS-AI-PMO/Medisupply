<?php
/*
 * Elementor Dotus Client Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_Client extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_client';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Client', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-photo-library';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Client widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_client'];
	}
	
	/**
	 * Register Dotus Client widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){
		
		$this->start_controls_section(
			'section_client',
			[
				'label' => esc_html__( 'Client Options', 'dotus-core' ),
			]
		);
		$repeater = new Repeater();
		$repeater->add_control(
			'client_title',
			[
				'label' => esc_html__( 'Title Text', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Title Text', 'dotus-core' ),
				'placeholder' => esc_html__( 'Type title text here', 'dotus-core' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'client_link',
			[
				'label' => esc_html__( 'Link', 'dotus-core' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'dotus-core' ),
				'label_block' => true,
				'show_external' => true,
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
				],
			]
		);
		$this->add_control(
			'clientLogos_groups',
			[
				'label' => esc_html__( 'Client Items', 'dotus-core' ),
				'type' => Controls_Manager::REPEATER,
				'default' => [
					[
						'client_title' => esc_html__( 'Client', 'dotus-core' ),
					],
					
				],
				'fields' =>  $repeater->get_controls(),
				'title_field' => '{{{ client_title }}}',
			]
		);
		$this->end_controls_section();// end: Section
		

		// Background
		$this->start_controls_section(
			'section_client_bg_style',
			[
				'label' => esc_html__( 'Background', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'client_bg_padding',
			[
				'label' => __( 'Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,				
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-partners-section .partner-grids' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .wpo-partners-section h2',
			]
		);
		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-partners-section h3' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .wpo-partners-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section	
		
	}

	/**
	 * Render Client widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$clientLogos_groups = !empty( $settings['clientLogos_groups'] ) ? $settings['clientLogos_groups'] : [];
		$section_title = !empty( $settings['section_title'] ) ? $settings['section_title'] : '';
		// Turn output buffer on
		ob_start();
		 ?>

		 <div class="wpo-partners-section">
		    <div class="partner-grids partners-slider owl-carousel">
		    	<?php 	// Group Param Output
						if( is_array( $clientLogos_groups ) && !empty( $clientLogos_groups ) ){
							foreach ( $clientLogos_groups as $eatch_items ) {

							$client_title = !empty($eatch_items['client_title']) ? $eatch_items['client_title'] : '';
							$image_link = !empty( $eatch_items['client_link']['url'] ) ? $eatch_items['client_link']['url'] : '';
							$image_link_external = !empty( $eatch_items['client_link']['is_external'] ) ? 'target="_blank"' : '';
							$image_link_nofollow = !empty( $eatch_items['client_link']['nofollow'] ) ? 'rel="nofollow"' : '';
							$image_link_attr = !empty( $image_link ) ?  $image_link_external.' '.$image_link_nofollow : '';

						?>
		        <div class="grid">
		             <?php 
		              if( $image_link ) { echo '<a href="'.esc_url( $image_link ).'" '.esc_attr( $image_link_attr ).'>'; } 
					      	if( $client_title ) { echo '<h2>'.esc_html( $client_title ).'<i class="ti-star"></i></h2>'; }
					      	if( $image_link ) { echo '</a>'; }
					      ?>
		        </div>
		        <?php
		         }
		      	}
		       ?>
		    </div>
		</div>
		<?php
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Client widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_Client() );