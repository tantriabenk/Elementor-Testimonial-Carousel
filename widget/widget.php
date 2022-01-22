<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ):
	exit; // Exit if accessed directly
endif;

class ETC_Testimonial_Carousel extends Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', [ 'elementor-frontend' ], '1.8.1', true );
		wp_register_script( 'etc-carousel', ETC_PLUGIN_URI . 'widget/script.js', array( 'jquery' ), ETC_VERSION, true );

		wp_enqueue_style( 'elementor-icons-shared-0' );
        wp_enqueue_style( 'elementor-icons-fa-brands' );
        wp_enqueue_style( 'elementor-icons-fa-solid' );

		wp_register_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css' );
		wp_register_style( 'slick-theme', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css' );
		wp_register_style( 'widget-style', ETC_PLUGIN_URI . 'assets/css/style.css', array(), ETC_VERSION );
	}

	public function get_script_depends() {
		return ['slick', 'etc-carousel'];
	}

	public function get_style_depends() {
		return ['slick', 'slick-theme', 'widget-style'];
	}

    public function get_name() {
        return 'testimonial_carousel';
    }

    public function get_title() {
		return __( 'Testimonial Carousel', 'ele-testimonial' );
	}

	public function get_icon() {
		return 'eicon-wordpress';
	}

	public function get_categories() {
		return [ 'etc-widget' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'slides_options',
			[
				'label' => __( 'Slides', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$repeater = new \Elementor\Repeater();

			$repeater->add_control(
                'image',
                [
                    'label' => esc_html__( 'Image', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ]
            );

			$repeater->add_control(
                'content',
                [
                    'label' => esc_html__( 'Content', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::TEXTAREA,
					'placeholder' => esc_html__( '', 'ele-testimonial' ),
                ]
            );

			$repeater->add_control(
                'name',
                [
                    'label' => esc_html__( 'Name', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( '', 'ele-testimonial' ),
                ]
            );

			$repeater->add_control(
                'position',
                [
                    'label' => esc_html__( 'Position', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'placeholder' => esc_html__( '', 'ele-testimonial' ),
                ]
            );

			$this->add_control(
				'slides',
				[
					'label' => esc_html__( 'Slides', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::REPEATER,
					'fields' => $repeater->get_controls(),
					'default' => [
						[
							'name' => esc_html__( 'John Doe', 'ele-testimonial' ),
							'position' => esc_html__( 'CEO', 'ele-testimonial' ),
							'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.'
						],
					],
					'title_field' => '{{{ name }}}',
				]
			);

			$this->add_control(
				'hr',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);

			$this->add_control(
				'layout',
				[
					'type' => \Elementor\Controls_Manager::SELECT,
					'label' => esc_html__( 'Layout', 'ele-testimonial' ),
					'options' => [
						'inline' => esc_html__( 'Image Inline', 'ele-testimonial' ),
						'above' => esc_html__( 'Image Above', 'ele-testimonial' ),
					],
					'default' => 'inline',
				]
			);

			$this->add_responsive_control(
				'alignment',
				[
					'type' => \Elementor\Controls_Manager::CHOOSE,
					'label' => esc_html__( 'Alignment', 'ele-testimonial' ),
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'ele-testimonial' ),
							'icon' => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'ele-testimonial' ),
							'icon' => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'ele-testimonial' ),
							'icon' => 'eicon-text-align-right',
						],
					],
					'default' => 'center',
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__item' => 'text-align: {{VALUE}};',
                        '{{WRAPPER}} .etc-slides__item-footer' => 'justify-content: {{VALUE}};',
                    ],
				]
			);

			$this->add_responsive_control(
				'slides_per_view',
				[
					'type' => \Elementor\Controls_Manager::SELECT,
					'label' => esc_html__( 'Slides Per View', 'ele-testimonial' ),
					'options' => [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
					],
					'default' => '1',
				]
			);
			
			$this->add_responsive_control(
				'slides_to_scroll',
				[
					'type' => \Elementor\Controls_Manager::SELECT,
					'label' => esc_html__( 'Slides To Scroll', 'ele-testimonial' ),
					'options' => [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
					],
					'default' => '1',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'additional_options',
			[
				'label' => __( 'Additional Options', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

			$this->add_control(
				'arrows',
				[
					'label' => esc_html__( 'Arrows', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'ele-testimonial' ),
					'label_off' => esc_html__( 'Hide', 'ele-testimonial' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'dots',
				[
					'label' => esc_html__( 'Dots', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Show', 'ele-testimonial' ),
					'label_off' => esc_html__( 'Hide', 'ele-testimonial' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'hr_pagination',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label' => esc_html__( 'Autoplay', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'ele-testimonial' ),
					'label_off' => esc_html__( 'No', 'ele-testimonial' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label' => esc_html__( 'Autoplay Speed', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::NUMBER,
					'min' => 1,
					'max' => 10000,
					'step' => 1,
					'default' => 500,
				]
			);

			$this->add_control(
				'infinite_loop',
				[
					'label' => esc_html__( 'Infinite Loop', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'ele-testimonial' ),
					'label_off' => esc_html__( 'No', 'ele-testimonial' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label' => esc_html__( 'Pause On Hover', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'ele-testimonial' ),
					'label_off' => esc_html__( 'No', 'ele-testimonial' ),
					'return_value' => 'yes',
					'default' => 'yes',
				]
			);

			$this->add_control(
				'hr_image_size',
				[
					'type' => \Elementor\Controls_Manager::DIVIDER,
				]
			);

			$this->add_group_control(
				\Elementor\Group_Control_Image_Size::get_type(),
				[
					'name' => 'image_size', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
					'exclude' => [ 'custom' ],
					'include' => [],
					'default' => 'large',
				]
			);
		
		$this->end_controls_section();

		$this->start_controls_section(
			'arrow_settings',
			[
				'label' => __( 'Arrows', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'arrows' => 'yes',
                ],
			]
		);

			$this->add_control(
				'prev_icon',
				[
					'label' => esc_html__( 'Prev Icon', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-angle-left',
						'library' => 'solid',
					],
				]
			);

			$this->add_control(
				'next_icon',
				[
					'label' => esc_html__( 'Next Icon', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::ICONS,
					'default' => [
						'value' => 'fas fa-angle-right',
						'library' => 'solid',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_style_section',
			[
				'label' => __( 'Box Carousel Item', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_responsive_control(
                'box_spacing',
                [
                    'label' => esc_html__( 'Spacing', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 15,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__item' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_padding',
                [
                    'label' => __( 'Padding', 'ele-testimonial' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'box_border_radius',
                [
                    'label' => __( 'Border Radius', 'ele-testimonial' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'background_color',
                [
                    'label' => __( 'Background Color', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__item' => 'background-color: {{VALUE}}',
                    ],
                    'default' => '#fff'
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_box_shadow',
                    'label' => __( 'Box Shadow', 'ele-testimonial' ),
                    'selector' => '{{WRAPPER}} .etc-slides__item',
                ]
            );

        $this->end_controls_section();

		$this->start_controls_section(
			'testimonial_content_section',
			[
				'label' => __( 'Content', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'testimonial_color',
                [
                    'label' => __( 'Text Color', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__item-text' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_typography',
                    'label' => __( 'Typography', 'ele-testimonial' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .etc-slides__item-text',
                ]
            );

            $this->add_responsive_control(
                'testimonial_spacing',
                [
                    'label' => esc_html__( 'Spacing', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__item-text' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-top: 0;',
                    ],
                ]
            );

        $this->end_controls_section();
		
		$this->start_controls_section(
			'testimonial_image_section',
			[
				'label' => __( 'Image', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'testimonial_image_margin',
				[
					'label' => __( 'Margin', 'ele-testimonial' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .etc-slides__image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

            $this->add_responsive_control(
                'testimonial_image_size',
                [
                    'label' => esc_html__( 'Size', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 5,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 60,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__image img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

		$this->start_controls_section(
			'testimonial_name_section',
			[
				'label' => __( 'Name', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'testimonial_name_color',
                [
                    'label' => __( 'Text Color', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__name' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_name_typography',
                    'label' => __( 'Typography', 'ele-testimonial' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .etc-slides__name',
                ]
            );

            $this->add_responsive_control(
                'testimonial_name_spacing',
                [
                    'label' => esc_html__( 'Spacing', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 1000,
                            'step' => 5,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 10,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__name' => 'margin-bottom: {{SIZE}}{{UNIT}}; margin-top: 0;',
                    ],
                ]
            );

        $this->end_controls_section();

		$this->start_controls_section(
			'testimonial_position_section',
			[
				'label' => __( 'Position', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

            $this->add_control(
                'testimonial_position_color',
                [
                    'label' => __( 'Text Color', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .etc-slides__position' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                \Elementor\Group_Control_Typography::get_type(),
                [
                    'name' => 'testimonial_position_typography',
                    'label' => __( 'Typography', 'ele-testimonial' ),
                    'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .etc-slides__position',
                ]
            );

        $this->end_controls_section();

		$this->start_controls_section(
			'dots_style_section',
			[
				'label' => __( 'Dots', 'ele-testimonial' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'dots' => 'yes',
                ],
			]
		);

			$this->add_responsive_control(
				'dots_size',
				[
					'label' => esc_html__( 'Size', 'ele-testimonial' ),
					'type' => \Elementor\Controls_Manager::SLIDER,
					'size_units' => [ 'px' ],
					'range' => [
						'px' => [
							'min' => 0,
							'max' => 1000,
							'step' => 5,
						],
					],
					'default' => [
						'unit' => 'px',
						'size' => 10,
					],
					'selectors' => [
						'{{WRAPPER}} .slick-dots li' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .slick-dots li button' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .slick-dots li button:before' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; font-size: {{SIZE}}{{UNIT}}; transition: all 0.3s;',
					],
				]
			);

			$this->add_control(
                'dots_color',
                [
                    'label' => __( 'Color', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-dots li button:before' => 'color: {{VALUE}}',
                    ],
                    'default' => '#000'
                ]
            );

			$this->add_control(
                'dots_color_hover',
                [
                    'label' => __( 'Hover Color', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-dots li button:hover::before' => 'color: {{VALUE}}',
                    ],
                    'default' => '#6ec1e4'
                ]
            );

			$this->add_control(
                'dots_color_active',
                [
                    'label' => __( 'Active Color', 'ele-testimonial' ),
                    'type' => \Elementor\Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => \Elementor\Core\Schemes\Color::get_type(),
                        'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-dots li.slick-active button::before' => 'color: {{VALUE}}',
                    ],
                    'default' => '#cecece'
                ]
            );

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$slides           = $settings['slides'];
		$layout           = $settings['layout'];
		$image_size       = $settings['image_size_size'];
		$dots             = $settings['dots'];
		$arrows           = $settings['arrows'];
		$autoplay         = $settings['autoplay'];
		$autoplay_speed   = $settings['autoplay_speed'];
		$infinite_loop    = $settings['infinite_loop'];
		$slides_per_view  = $settings['slides_per_view'];
		$slides_to_scroll = $settings['slides_to_scroll'];
		$pause_on_hover   = $settings['pause_on_hover'];

		$slider_setting = array(
            'dots'             => $dots,
            'arrows'           => $arrows,
            'autoplay'         => $autoplay,
            'autoplay_speed'   => $autoplay_speed,
            'infinite_loop'    => $infinite_loop,
            'slides_to_show'   => $slides_per_view,
            'slides_to_scroll' => $slides_to_scroll,
            'pause_on_hover'   => $pause_on_hover,
        );

		if( $slides ):

			echo '<div class="etc-slides__wrapper">';

				echo "<div class='etc-slides__container' data-settings='" . json_encode( $slider_setting ) . "'>";

					foreach( $slides as $slide ):

						if( empty( $slide['image']['id'] ) ):
							$image = sprintf( '<img src="%s" />', $slide['image']['url'] );
						else:
							$image = wp_get_attachment_image( $slide['image']['id'], $image_size );
						endif;

						echo '<div class="etc-slides__item elementor-repeater-item-' . esc_attr( $item['_id'] ) . '">';  ?>

							<div class="etc-slides__testimonial <?php echo ( $layout == "above" ) ? 'etc-slides__testimonial-above' : ''; ?>">

								<div class="etc-slides__content">
									<?php echo sprintf( '<div class="etc-slides__item-text">%s</div>', $slide['content'] ); ?>

									<?php
									if( $layout == "above" ):
										echo sprintf( '
											<div class="etc-slides__name-position">
												<span class="etc-slides__name">%s</span>
												<span class="etc-slides__position">%s</span>
											</div>
										', esc_html( $slide['name'] ), esc_html( $slide['position'] ) );
									endif;
									?>
								</div>

								<div class="etc-slides__item-footer">

									<div class="etc-slides__image">
										<?php echo $image; ?>
									</div>
									
									<?php 
									if( $layout == "inline" ):
										echo sprintf( '
											<div class="etc-slides__name-position">
												<span class="etc-slides__name">%s</span>
												<span class="etc-slides__position">%s</span>
											</div>
									', esc_html( $slide['name'] ), esc_html( $slide['position'] ) );
									endif;
									?>
								</div>
							
							</div>	

						<?php echo '</div>';

					endforeach;

				echo '</div>';

				echo '<div class="etc-slides__arrows">'; ?>

					<a href="#" class="etc-arrow__prev etc-arrow__nav">
						<?php \Elementor\Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</a>
					
					<a href="#" class="etc-arrow__next etc-arrow__nav">
						<?php \Elementor\Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</a>

				<?php echo '</div>';
			
			echo '</div>';

		endif;
	}
}