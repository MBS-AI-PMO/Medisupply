<?php
/*
 * Elementor Dotus Service Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Dotus_Service extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_service';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Service', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-kit-details';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Service widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_service'];
	}
	
	/**
	 * Register Dotus Service widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function _register_controls(){


		$posts = get_posts( 'post_type="service"&numberposts=-1' );
    $PostID = array();
    if ( $posts ) {
      foreach ( $posts as $post ) {
        $PostID[ $post->ID ] = $post->ID;
      }
    } else {
      $PostID[ __( 'No ID\'s found', 'dotus' ) ] = 0;
    }
		
	
		$this->start_controls_section(
			'section_service_listing',
			[
				'label' => esc_html__( 'Listing Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'service_limit',
			[
				'label' => esc_html__( 'Service Limit', 'dotus-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__( 'Enter the number of items to show.', 'dotus-core' ),
			]
		);
		$this->add_control(
			'service_order',
			[
				'label' => __( 'Order', 'dotus-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'ASC' => esc_html__( 'Asending', 'dotus-core' ),
					'DESC' => esc_html__( 'Desending', 'dotus-core' ),
				],
				'default' => 'DESC',
			]
		);
		$this->add_control(
			'service_orderby',
			[
				'label' => __( 'Order By', 'dotus-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'dotus-core' ),
					'ID' => esc_html__( 'ID', 'dotus-core' ),
					'author' => esc_html__( 'Author', 'dotus-core' ),
					'title' => esc_html__( 'Title', 'dotus-core' ),
					'date' => esc_html__( 'Date', 'dotus-core' ),
					'menu_order' => esc_html__( 'Menu Order', 'dotus-core' ),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'service_show_category',
			[
				'label' => __( 'Certain Categories?', 'dotus-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names( 'service_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'service_show_id',
			[
				'label' => __( 'Certain ID\'s?', 'dotus-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->add_control(
			'short_content',
			[
				'label' => esc_html__( 'Excerpt Length', 'dotus-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
				'default' => 16,
				'description' => esc_html__( 'How many words you want in short content paragraph.', 'dotus-core' ),
			]
		);
		$this->add_control(
			'read_more_txt',
			[
				'label' => esc_html__( 'Read More', 'dotus-core' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Type your Read More text here', 'dotus-core' ),
			]
		);
		$this->end_controls_section();// end: Section

	

		// Service Item
		$this->start_controls_section(
			'section_service_item_style',
			[
				'label' => esc_html__( 'Service', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'service_item_color',
				'label' => esc_html__('Hover Background', 'dotus-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .wpo-service-section .wpo-service-slider .wpo-service-item:before',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Hover Color', 'dotus-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->end_controls_section();// end: Section
	

		// Service Icon
		$this->start_controls_section(
			'section_service_icon_style',
			[
				'label' => esc_html__( 'Icon ', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'service_icon_color',
				'label' => esc_html__('Background', 'dotus-core'),
				'types' => ['gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}}  .wpo-service-section .wpo-service-text .service-icon .fi:before',
				'fields_options' => [
					'background' => [
						'label' => esc_html__('Icon Color', 'dotus-core'),
						'default' => 'gradient',
					],
				],
			]
		);
		$this->add_control(
			'service_icon_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-item:hover .wpo-service-text .service-icon .fi:before' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
	
		// Title
		$this->start_controls_section(
			'service_section_title_style',
			[
				'label' => esc_html__( 'Title', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'service_dotus_title_typography',
				'selector' => '{{WRAPPER}}  .wpo-service-section .wpo-service-slider .wpo-service-item .wpo-service-text h2',
			]
		);
		$this->add_control(
			'service_title_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .wpo-service-item .wpo-service-text h2 a' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_title_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .wpo-service-item:hover .wpo-service-text h2 a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .wpo-service-item .wpo-service-text h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Content
		$this->start_controls_section(
			'service_section_content_style',
			[
				'label' => esc_html__( 'Content', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'service_section_content_typography',
				'selector' => '{{WRAPPER}} .wpo-service-section .wpo-service-slider .wpo-service-item .wpo-service-text p',
			]
		);
		$this->add_control(
			'service_content_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .wpo-service-item .wpo-service-text p' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_content_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .wpo-service-item:hover .wpo-service-text p:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

		// Arrow
		$this->start_controls_section(
			'service_nav_style',
			[
				'label' => esc_html__( 'Arrow', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'nav_icon_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .owl-nav [class*=owl-]' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_nav_border_color',
			[
				'label' => esc_html__( 'Border Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .owl-nav .owl-prev, .wpo-service-section .wpo-service-slider .owl-nav .owl-next, .wpo-service-section-s2 .wpo-service-slider .owl-nav .owl-prev, .wpo-service-section-s2 .wpo-service-slider .owl-nav .owl-next' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_nav_hover_border_color',
			[
				'label' => esc_html__( 'Hover Border', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .owl-nav .owl-prev:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'service_nav_hover_bg_color',
			[
				'label' => esc_html__( 'Hover Background', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-service-section .wpo-service-slider .owl-nav .owl-prev:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section


		
	}

	/**
	 * Render Service widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$read_more_txt = !empty( $settings['read_more_txt'] ) ? $settings['read_more_txt'] : '';
		$service_limit = !empty( $settings['service_limit'] ) ? $settings['service_limit'] : '';
		$service_order = !empty( $settings['service_order'] ) ? $settings['service_order'] : '';
		$service_orderby = !empty( $settings['service_orderby'] ) ? $settings['service_orderby'] : '';
		$service_show_category = !empty( $settings['service_show_category'] ) ? $settings['service_show_category'] : [];
		$service_show_id = !empty( $settings['service_show_id'] ) ? $settings['service_show_id'] : [];
		$short_content = !empty( $settings['short_content'] ) ? $settings['short_content'] : '';
		$excerpt_length = $short_content ? $short_content : '16';

		$read_more_txt = $read_more_txt ? $read_more_txt : esc_html__( 'Read More', 'dotus-core' );

	
		// Turn output buffer on
		ob_start();

		// Pagination
		global $paged;
		if( get_query_var( 'paged' ) )
		  $my_page = get_query_var( 'paged' );
		else {
		  if( get_query_var( 'page' ) )
			$my_page = get_query_var( 'page' );
		  else
			$my_page = 1;
		  set_query_var( 'paged', $my_page );
		  $paged = $my_page;
		}

    if ($service_show_id) {
			$service_show_id = json_encode( $service_show_id );
			$service_show_id = str_replace(array( '[', ']' ), '', $service_show_id);
			$service_show_id = str_replace(array( '"', '"' ), '', $service_show_id);
      $service_show_id = explode(',',$service_show_id);
    } else {
      $service_show_id = '';
    }

		$args = array(
		  // other query params here,
		  'paged' => $my_page,
		  'post_type' => 'service',
		  'posts_per_page' => (int)$service_limit,
		  'service_category' => implode(',', $service_show_category),
		  'orderby' => $service_orderby,
		  'order' => $service_order,
      'post__in' => $service_show_id,
		);

		$dotus_service = new \WP_Query( $args );
		if ( $dotus_service->have_posts()) :
		 ?>

		<div class="wpo-service-section">
    	<div class="container">
        <div class="row-grid wpo-service-slider owl-carousel">
          	<?php

		      		 while ( $dotus_service->have_posts()) : $dotus_service->the_post();
							$service_options = get_post_meta( get_the_ID(), 'service_options', true );
			        $service_icon = isset($service_options['service_icon']) ? $service_options['service_icon'] : '';
		  				global $post;

		      		?>
		      		 <div class="grid">
	                <div class="wpo-service-item">
	                    <div class="wpo-service-text">
	                        <div class="service-icon">
	                          <?php if ( $service_icon ) { echo '<i class="fi '.esc_attr( $service_icon ).'"></i>'; } ?>
	                        </div>
	                        <h2>
			                   	<a href="<?php echo esc_url( get_permalink() ); ?>">
			                   		<?php echo esc_html(get_the_title()); ?>
			                   	</a>
			                   	</h2>
	                        <p><?php echo wp_trim_words( get_the_excerpt(), $excerpt_length, ' ' ); ?></p>
	                    </div>
	                </div>
	            </div>
              <?php 
              endwhile;
							wp_reset_postdata();
			      	 ?>
			  	</div>
			  </div>
			</div>
			<?php
			endif;
			// Return outbut buffer
			echo ob_get_clean();	
		}
	/**
	 * Render Service widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register_widget_type( new Dotus_Service() );