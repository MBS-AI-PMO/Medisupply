<?php
/*
 * Elementor Dotus Project Widget
 * Author & Copyright: wpoceans
*/

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Site_Project extends Widget_Base{

	/**
	 * Retrieve the widget name.
	*/
	public function get_name(){
		return 'wpo-dotus_project';
	}

	/**
	 * Retrieve the widget title.
	*/
	public function get_title(){
		return esc_html__( 'Project', 'dotus-core' );
	}

	/**
	 * Retrieve the widget icon.
	*/
	public function get_icon() {
		return 'eicon-calendar';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	*/
	public function get_categories() {
		return ['wpoceans-category'];
	}

	/**
	 * Retrieve the list of scripts the Dotus Project widget depended on.
	 * Used to set scripts dependencies required to run the widget.
	*/
	public function get_script_depends() {
		return ['wpo-dotus_project'];
	}
	
	/**
	 * Register Dotus Project widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	*/
	protected function register_controls(){


		$posts = get_posts( 'post_type="project"&numberposts=-1' );
    $PostID = array();
    if ( $posts ) {
      foreach ( $posts as $post ) {
        $PostID[ $post->ID ] = $post->ID;
      }
    } else {
      $PostID[ __( 'No ID\'s found', 'dotus' ) ] = 0;
    }
		

		$this->start_controls_section(
			'section_project_listing',
			[
				'label' => esc_html__( 'Listing Options', 'dotus-core' ),
			]
		);
		$this->add_control(
			'project_style',
			[
				'label' => esc_html__( 'Project Style', 'dotus-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'style-one' => esc_html__( 'Style One', 'dotus-core' ),
					'style-two' => esc_html__( 'Style Two', 'dotus-core' ),
				],
				'default' => 'style-one',
				'description' => esc_html__( 'Select your project style.', 'dotus-core' ),
			]
		);
		$this->add_control(
			'project_limit',
			[
				'label' => esc_html__( 'Project Limit', 'dotus-core' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => 3,
				'description' => esc_html__( 'Enter the number of items to show.', 'dotus-core' ),
			]
		);
		$this->add_control(
			'project_order',
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
			'project_orderby',
			[
				'label' => __( 'Order By', 'dotus-core' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'none' => esc_html__( 'None', 'dotus-core' ),
					'ID' => esc_html__( 'ID', 'dotus-core' ),
					'author' => esc_html__( 'Author', 'dotus-core' ),
					'title' => esc_html__( 'Title', 'dotus-core' ),
					'date' => esc_html__( 'Date', 'dotus-core' ),
				],
				'default' => 'date',
			]
		);
		$this->add_control(
			'project_show_category',
			[
				'label' => __( 'Certain Categories?', 'dotus-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => Controls_Helper_Output::get_terms_names( 'project_category'),
				'multiple' => true,
			]
		);
		$this->add_control(
			'project_show_id',
			[
				'label' => __( 'Certain ID\'s?', 'dotus-core' ),
				'type' => Controls_Manager::SELECT2,
				'default' => [],
				'options' => $PostID,
				'multiple' => true,
			]
		);
		$this->end_controls_section();// end: Section

	
		// Project Body
		$this->start_controls_section(
			'section_project_body_style',
			[
				'label' => esc_html__( 'Body', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'project_body_border_color',
			[
				'label' => esc_html__( 'Border Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-doctor-wrap .department-single' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_body_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-doctor-wrap .department-single' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_body_bg_hover_color',
			[
				'label' => esc_html__( 'Hover Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-doctor-wrap .department-single:hover' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_body_border_hover_color',
			[
				'label' => esc_html__( 'Border Hover', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-doctor-wrap .department-single:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	
		// Project Icon
		$this->start_controls_section(
			'section_project_icon_style',
			[
				'label' => esc_html__( 'Icon', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'project_icon_icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-single .department-single-img' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section

	
		// Project Title
		$this->start_controls_section(
			'section_project_title_style',
			[
				'label' => esc_html__( 'Title', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Typography', 'dotus-core' ),
				'name' => 'dotus_project_title_typography',
				'selector' => '{{WRAPPER}} .wpo-department-section .department-wrap .department-single h2',
			]
		);
		$this->add_control(
			'project_title_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-single h2' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'project_title_padding',
			[
				'label' => esc_html__( 'Title Padding', 'dotus-core' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-single h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
		// Project Button
		$this->start_controls_section(
			'section_project_arrow_style',
			[
				'label' => esc_html__( 'Button', 'dotus-core' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => esc_html__( 'Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-single a i' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__( 'Background Color', 'dotus-core' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wpo-department-section .department-wrap .department-single a i' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();// end: Section
		
	}

	/**
	 * Render Project widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	*/
	protected function render() {
		$settings = $this->get_settings_for_display();
		$project_style = !empty( $settings['project_style'] ) ? $settings['project_style'] : '';
		$project_limit = !empty( $settings['project_limit'] ) ? $settings['project_limit'] : '';
		$project_order = !empty( $settings['project_order'] ) ? $settings['project_order'] : '';
		$project_orderby = !empty( $settings['project_orderby'] ) ? $settings['project_orderby'] : '';
		$project_show_category = !empty( $settings['project_show_category'] ) ? $settings['project_show_category'] : [];
		$project_show_id = !empty( $settings['project_show_id'] ) ? $settings['project_show_id'] : [];

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

    if ($project_show_id) {
			$project_show_id = json_encode( $project_show_id );
			$project_show_id = str_replace(array( '[', ']' ), '', $project_show_id);
			$project_show_id = str_replace(array( '"', '"' ), '', $project_show_id);
      $project_show_id = explode(',',$project_show_id);
    } else {
      $project_show_id = '';
    }

		$args = array(
		  // other query params here,
		  'paged' => $my_page,
		  'post_type' => 'project',
		  'posts_per_page' => (int)$project_limit,
		  'project_category' => implode(',', $project_show_category),
		  'orderby' => $project_orderby,
		  'order' => $project_order,
      'post__in' => $project_show_id,
		);

		$dotus_project = new \WP_Query( $args );

		?>
		<div class="wpo-department-section">
		    <div class="container">
		        <div class="department-wrap">
		            <div class="department-doctor-wrap">
		                <div class="row">
		                    <?php 
												if ( $dotus_project->have_posts()) : while ( $dotus_project->have_posts()) : $dotus_project->the_post();
								        global $post;

								        $project_options = get_post_meta( get_the_ID(), 'project_options', true );

												$project_title = isset($project_options['project_title']) ? $project_options['project_title'] : '';
												$project_image = isset($project_options['project_image']) ? $project_options['project_image'] : '';

								      	$image_url = wp_get_attachment_url( $project_image );
						          	$image_alt = get_post_meta( $project_image , '_wp_attachment_image_alt', true);
								       
											  ?>
		                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
		                        <div class="department-single">
		                            <div class="department-single-img">
		                              <?php if( $image_url ) { echo '<img src="'.esc_url( $image_url ).'" alt="'.esc_url( $image_alt ).'">'; } ?>
		                            </div>
		                             <h2><?php echo esc_html( $project_title ); ?></h2>
		                            <a href="<?php echo esc_url( get_permalink() ); ?>">
		                                <i class="ti-arrow-right"></i>
		                            </a>
		                        </div>
		                    </div>
		                    <?php
										 	 endwhile;
										 	 endif;
										 	 wp_reset_postdata();
										 	?>
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
	 * Render Project widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	*/
	
	//protected function _content_template(){}
	
}
Plugin::instance()->widgets_manager->register( new Site_Project() );