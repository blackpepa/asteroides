<?php
/**
 * @package The7
 */

namespace The7\Mods\Compatibility\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Responsive\Responsive;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use The7\Mods\Compatibility\Elementor\The7_Elementor_Less_Vars_Decorator_Interface;
use The7\Mods\Compatibility\Elementor\The7_Elementor_Widget_Base;
use The7\Mods\Compatibility\Elementor\Widget_Templates\Arrows;
use The7\Mods\Compatibility\Elementor\Widget_Templates\Bullets;
use The7\Mods\Compatibility\Elementor\Widget_Templates\Button;
use The7\Mods\Compatibility\Elementor\Widget_Templates\Image_Aspect_Ratio;

defined( 'ABSPATH' ) || exit;

/**
 * Text_And_Icon_Carousel class.
 */
class Text_And_Icon_Carousel extends The7_Elementor_Widget_Base {

	/**
	 * Get element name.
	 *
	 * Retrieve the element name.
	 *
	 * @return string The name.
	 */
	public function get_name() {
		return 'the7_content_carousel';
	}

	/**
	 * @return string[]
	 */
	protected function the7_keywords() {
		return [ 'carousel' ];
	}

	/**
	 * @return string|void
	 */
	protected function the7_title() {
		return __( 'Multipurpose Carousel', 'the7mk2' );
	}

	/**
	 * @return string
	 */
	protected function the7_icon() {
		return 'eicon-posts-carousel';
	}

	/**
	 * @return array|string[]
	 */
	public function get_script_depends() {
		if ( $this->is_preview_mode() ) {
			return [ 'the7-elements-carousel-widget-preview' ];
		}

		return [];
	}

	/**
	 * @return string[]
	 */
	public function get_style_depends() {
		return [ 'the7-carousel-text-and-icon-widget' ];
	}

	/**
	 * Register widget controls.
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Slides', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'list_title',
			[
				'label'   => __( 'Title', 'the7mk2' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Title', 'the7mk2' ),
			]
		);

		$repeater->add_control(
			'list_content',
			[
				'label' => __( 'Subtitle', 'the7mk2' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$repeater->add_control(
			'graphic_type',
			[
				'label'       => __( 'Graphic Element', 'the7mk2' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'icon'  => [
						'title' => __( 'Icon', 'the7mk2' ),
						'icon'  => 'eicon-favorite',
					],
					'image' => [
						'title' => __( 'Image', 'the7mk2' ),
						'icon'  => 'eicon-image',
					],
					'none'  => [
						'title' => __( 'None', 'the7mk2' ),
						'icon'  => 'eicon-ban',
					],
				],

				'toggle'      => false,
				'default'     => 'icon',
			]
		);

		$repeater->add_control(
			'list_icon',
			[
				'label'     => __( 'Icon', 'the7mk2' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'condition' => [
					'graphic_type' => 'icon',
				],
			]
		);

		$repeater->add_control(
			'list_image',
			[
				'name'        => 'image',
				'label'       => __( 'Choose Image', 'the7mk2' ),
				'type'        => Controls_Manager::MEDIA,
				'default'     => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'label_block' => true,
				'condition'   => [
					'graphic_type' => 'image',
				],
			]
		);

		$repeater->add_control(
			'button',
			[
				'label'   => __( 'Button text', 'the7mk2' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Button text', 'the7mk2' ),
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link', 'the7mk2' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => 'https://your-link.com',
			]
		);

		$this->add_control(
			'list',
			[
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'list_title'   => __( 'Item #1', 'the7mk2' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'the7mk2' ),
						'list_icon'    => 'fas fa-check',
						'button'       => __( 'Click Here', 'the7mk2' ),
						'link'         => __( 'https://your-link.com', 'the7mk2' ),
					],
					[
						'list_title'   => __( 'Item #2', 'the7mk2' ),
						'list_content' => __( 'Item content. Click the edit button to change this text.', 'the7mk2' ),
						'list_icon'    => 'fas fa-check',
						'button'       => __( 'Click Here', 'the7mk2' ),
						'link'         => __( 'https://your-link.com', 'the7mk2' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'layout_section',
			[
				'label' => __( 'Layout', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'wide_desk_columns',
			[
				'label'   => esc_html__( 'Columns On A Wide Desktop', 'the7mk2' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '',
				'min'     => 1,
				'max'     => 12,
			]
		);

		$this->add_control(
			'widget_columns_wide_desktop_breakpoint',
			[
				'label'              => esc_html__( 'Wide Desktop Breakpoint (px)', 'the7mk2' ),
				'description'        => the7_elementor_get_wide_columns_control_description(),
				'type'               => Controls_Manager::NUMBER,
				'default'            => '',
				'min'                => 0,
				'frontend_available' => true,
			]
		);

		$this->add_basic_responsive_control(
			'widget_columns',
			[
				'label'          => __( 'Columns', 'the7mk2' ),
				'type'           => Controls_Manager::NUMBER,
				'default'        => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
			]
		);

		$this->add_basic_responsive_control(
			'gap_between_posts',
			[
				'label'      => __( 'Gap Between Columns (px)', 'the7mk2' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'separator'  => 'before',
			]
		);
		$this->add_basic_responsive_control(
			'carousel_margin',
			[
				'label'       => __( 'outer gaps', 'the7mk2' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => [ 'px' ],
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .owl-stage-outer' => ' --stage-right-gap:{{RIGHT}}{{UNIT}};  --stage-left-gap:{{LEFT}}{{UNIT}}; padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'adaptive_height',
			[
				'label'        => __( 'Adaptive Height', 'the7mk2' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'y',
				'default'      => '',
			]
		);

		$this->end_controls_section();
		// Scolling.

		$this->start_controls_section(
			'scrolling_section',
			[
				'label' => __( 'Scrolling', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'slide_to_scroll',
			[
				'label'   => __( 'Scroll Mode', 'the7mk2' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'single',
				'options' => [
					'single' => 'One slide at a time',
					'all'    => 'All slides',
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Transition Speed (ms)', 'the7mk2' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '600',
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => __( 'Autoplay Slides', 'the7mk2' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'y',
				'default'      => '',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => __( 'Autoplay Speed (ms)', 'the7mk2' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 6000,
				'min'       => 100,
				'max'       => 10000,
				'step'      => 10,
				'condition' => [
					'autoplay' => 'y',
				],
			]
		);

		$this->end_controls_section();

		$this->template( Arrows::class )->add_content_controls();
		$this->template( Bullets::class )->add_content_controls();

		$this->start_controls_section(
			'skin_section',
			[
				'label' => __( 'Skin', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$layouts            = [
			'layout_1' => __( 'Above content', 'the7mk2' ),
			'layout_2' => __( 'Aligned with title', 'the7mk2' ),
			'layout_3' => __( 'Left aligned with content', 'the7mk2' ),
			'layout_4' => __( 'Right aligned with content', 'the7mk2' ),
		];
		$layouts_on_devices = [ 'default' => __( 'No change', 'the7mk2' ) ] + $layouts;

		$this->add_basic_responsive_control(
			'layout',
			[
				'label'        => __( 'Choose Skin', 'the7mk2' ),
				'type'         => Controls_Manager::SELECT,
				'options'              => $layouts,
				'device_args'          => [
					'tablet' => [
						'default' => 'default',
						'options' => $layouts_on_devices,
					],
					'mobile' => [
						'default' => 'default',
						'options' => $layouts_on_devices,
					],
				],
				'default'      => 'layout_1',
				'selectors_dictionary' => [
					'layout_1'   => $this->combine_to_css_vars_definition_string(
						[
							'the7-slider-layout-columns' => 'minmax(0,100%)',
							'the7-slider-template-areas' => '" icon" " header " " desc" " button "',
							'the7-slider-template-rows' => 'none',
							'img-width' => 'var(--icon-size, 40px)',
							'img-height' => 'var(--icon-size, 40px)',
							'icon-width' => 'var(--icon-size, 40px)',
							'icon-top-padding' => 'var(--icon-size, 40px)',
							'the7-slider-layout-gap' => 'var(--icon-bottom-gap, 0px)',
							'the7-slider-layout-margin'  => 'var(--icon-top-gap, 0px) var(--icon-right-gap, 0px) var(--icon-bottom-gap, 0px) var(--icon-left-gap, 0px)',
						]
					),
					'layout_2' => $this->combine_to_css_vars_definition_string(
						[
							'the7-slider-layout-columns' => 'var(--the7-slider-layout-2-columns)',
							'the7-slider-template-areas' => 'var(--the7-slider-template-2-areas)',
							'the7-slider-template-rows' => 'none',
							'img-width' => 'calc(100% - var(--icon-left-gap, 0px))',
							'img-height' => 'var(--icon-size, 40px)',
							'icon-width' => 'calc(100% - var(--icon-left-gap, 0px))',
							'icon-top-padding' => 'calc(100% - var(--icon-right-gap, 0px) - var(--icon-left-gap, 0px))',
							'the7-slider-layout-gap' => 'var(--icon-right-gap, 0px)',
							'the7-slider-layout-margin'  => 'var(--icon-top-gap, 0px) var(--icon-right-gap, 0px) var(--icon-bottom-gap, 0px) var(--icon-left-gap, 0px)',
						]
					),
					'layout_3'  => $this->combine_to_css_vars_definition_string(
						[
							'the7-slider-layout-columns' => 'calc(var(--icon-size, 40px) + var(--icon-left-gap, 0px)) minmax(0,1fr)',
							'the7-slider-template-areas' => '"icon header" "icon desc" "icon button"',
							'the7-slider-template-rows' => 'repeat(2, auto) 1fr',
							'the7-slider-layout-gap' => 'var(--icon-right-gap, 0px)',
							'img-width' => 'calc(100% - var(--icon-left-gap, 0px))',
							'img-height' => 'var(--icon-size, 40px)',
							'icon-width' => 'calc(100% - var(--icon-left-gap, 0px))',
							'icon-top-padding' => 'calc(100% - var(--icon-right-gap, 0px) - var(--icon-left-gap, 0px))',
							'the7-slider-layout-margin'  => 'var(--icon-top-gap, 0px) 0 var(--icon-bottom-gap, 0px) var(--icon-left-gap, 0px)',
						]
					),
					'layout_4'  => $this->combine_to_css_vars_definition_string(
						[
							'the7-slider-layout-columns' => 'minmax(0,1fr) calc(var(--icon-size, 40px) + var(--icon-right-gap, 0px))',
							'the7-slider-template-areas' => '" header icon "  " desc icon " " button icon "',
							'the7-slider-template-rows' => 'repeat(2, auto) 1fr',
							'img-width' => 'calc(100% - var(--icon-right-gap, 0px))',
							'img-height' => 'var(--icon-size, 40px)',
							'icon-width' => 'calc(100% - var(--icon-right-gap, 0px))',
							'icon-top-padding' => 'calc(100% - var(--icon-right-gap, 0px) - var(--icon-left-gap, 0px))',
							'the7-slider-layout-gap' => 'var(--icon-left-gap, 0px)',
							'the7-slider-layout-margin'  => 'var(--icon-top-gap, 0px) var(--icon-right-gap, 0px) var(--icon-bottom-gap, 0px) 0',
						]
					),
				],
				'selectors'            => [
					'{{WRAPPER}}' => '{{VALUE}}',
				],
				'prefix_class' => 'slider%s-',
			]
		);

		$this->add_basic_responsive_control(
			'content_alignment',
			[
				'label'        => __( 'Alignment', 'the7mk2' ),
				'type'         => Controls_Manager::CHOOSE,
				'label_block'  => false,
				'options'      => [
					'left'   => [
						'title' => __( 'Left', 'the7mk2' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'the7mk2' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'the7mk2' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'      => 'center',
				'selectors_dictionary' => [
					'left'   => $this->combine_to_css_vars_definition_string(
						[
							'content-text-align' => 'left',
							'content-justify-self' => 'flex-start',
							'the7-slider-layout-2-columns' => 'calc(var(--icon-size, 40px) + var(--icon-left-gap, 0px)) minmax(0,1fr)',
							'the7-slider-template-2-areas' => '" icon header " " desc desc " " button button "',
						]
					),
					'center' => $this->combine_to_css_vars_definition_string(
						[
							'content-text-align' => 'center',
							'content-justify-self' => 'center',
							'the7-slider-layout-2-columns' => '1fr calc(var(--icon-size, 40px)  + var(--icon-left-gap, 0px)) minmax(auto,  max-content) 1fr',
							'the7-slider-template-2-areas' => '"empty1 icon before empty2" "empty1 icon header empty2" "empty1 icon subtitle empty2" "empty1 icon empty empty2" "desc desc desc desc" "button button button button"',
						]
					),
					'right'  => $this->combine_to_css_vars_definition_string(
						[
							'content-text-align' => 'right',
							'content-justify-self' => 'flex-end',
							'the7-slider-layout-2-columns' => ' minmax(0,1fr) calc(var(--icon-size, 40px) + var(--icon-left-gap, 0px))',
							'the7-slider-template-2-areas' => '" before icon " " header icon " " subtitle icon " " empty icon " " desc desc " " button button "',
						]
					),
				],
				'selectors'            => [
					'{{WRAPPER}}' => '{{VALUE}}',
				],
				'prefix_class' => 'slide-h-position%s-',
			]
		);

		$this->add_basic_responsive_control(
			'icon_below_gap',
			[
				'label'      => __( 'Graphic Element Margin', 'the7mk2' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => '--icon-top-gap: {{TOP}}{{UNIT}}; --icon-right-gap: {{RIGHT}}{{UNIT}}; --icon-left-gap: {{LEFT}}{{UNIT}}; --icon-bottom-gap: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

		$this->add_basic_responsive_control(
			'icon_bg_size',
			[
				'label'      => __( 'Graphic Element Width', 'the7mk2' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
					'size' => 40,
				],
				'size_units' => [ '%', 'px' ],
				'range'      => [
					'%'  => [
						'min' => 1,
						'max' => 100,
					],
					'px' => [
						'min' => 1,
						'max' => 1000,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => '--icon-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'link_click',
			[
				'label'   => __( 'Apply Link & Hover On', 'the7mk2' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'button',
				'options' => [
					'slide'  => __( 'Whole box', 'the7mk2' ),
					'button' => __( "Separate slide's elements", 'the7mk2' ),
				],
			]
		);
		$this->add_control(
			'link_hover',
			[
				'label'        => __( 'Apply Hover To Slides With No Links', 'the7mk2' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'y',
				'default'      => 'y',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'box_section',
			[
				'label' => __( 'Box', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'box_border_width',
			[
				'label'      => __( 'Border Width', 'the7mk2' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-wrap' => 'border-style: solid; box-sizing: border-box; border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'the7mk2' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_basic_responsive_control(
			'box_padding',
			[
				'label'      => __( 'Padding', 'the7mk2' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .owl-carousel' => '--box-padding-top: {{TOP}}{{UNIT}}; --box-padding-bottom: {{BOTTOM}}{{UNIT}};',
					'{{WRAPPER}} .dt-owl-item-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'box_style_tabs' );

		$this->start_controls_tab(
			'classic_style_normal',
			[
				'label' => __( 'Normal', 'the7mk2' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'box_shadow',
				'selector'       => '{{WRAPPER}} .dt-owl-item-wrap',
				'fields_options' => [
					'box_shadow' => [
						'selectors' => [
							'{{SELECTOR}}' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',
						],
					],
				],
			]
		);

		$this->add_control(
			'box_background_color',
			[
				'label'     => __( 'Background Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-wrap' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'box_border_color',
			[
				'label'     => __( 'Border Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-wrap' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'classic_style_hover',
			[
				'label' => __( 'Hover', 'the7mk2' ),
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'           => 'box_shadow_hover',
				'selector'       => '{{WRAPPER}} .dt-owl-item-wrap { transition: all 0.3s ease; } {{WRAPPER}} .dt-owl-item-wrap.box-hover:hover, {{WRAPPER}} .dt-owl-item-wrap.elements-hover:hover',
				'fields_options' => [
					'box_shadow' => [
						'selectors' => [
							'{{SELECTOR}}' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',

						],

					],
				],
			]
		);

		$this->add_control(
			'box_background_color_hover',
			[
				'label'     => __( 'Background Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'
					{{WRAPPER}} .dt-owl-item-wrap { transition: all 0.3s ease; }
					{{WRAPPER}} .dt-owl-item-wrap.box-hover:hover, {{WRAPPER}} .dt-owl-item-wrap.elements-hover:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'box_border_color_hover',
			[
				'label'     => __( 'Border Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'
					{{WRAPPER}} .dt-owl-item-wrap { transition: all 0.3s ease; }
					{{WRAPPER}} .dt-owl-item-wrap.box-hover:hover, {{WRAPPER}} .dt-owl-item-wrap.elements-hover:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label' => __( 'Title', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_STYLE,

			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => __( 'HTML Tag', 'the7mk2' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				],
				'default' => 'h4',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'post_title',
				'label'          => __( 'Typography', 'the7mk2' ),
				'selector'       => '{{WRAPPER}} .dt-owl-item-heading',
				'fields_options' => [
					'font_family' => [
						'default' => '',
					],
					'font_size'   => [
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
					],
					'font_weight' => [
						'default' => '',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
					],
				],
			]
		);

		$this->start_controls_tabs( 'post_title_style_tabs' );

		$this->start_controls_tab(
			'post_title_normal_style',
			[
				'label' => __( 'Normal', 'the7mk2' ),
			]
		);

		$this->add_control(
			'custom_title_color',
			[
				'label'     => __( 'Font Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_title_hover_style',
			[
				'label' => __( 'Hover', 'the7mk2' ),
			]
		);

		$this->add_control(
			'post_title_color_hover',
			[
				'label'     => __( 'Font Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'
					{{WRAPPER}} .dt-owl-item-heading { transition: color 0.3s ease; }
					{{WRAPPER}} .box-hover:hover .dt-owl-item-heading, {{WRAPPER}} .elements-hover .dt-owl-item-heading:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'post_title_bottom_margin',
			[
				'label'      => __( 'Gap Below Title', 'the7mk2' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-heading' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Icon section.
		 */
		$this->start_controls_section(
			'text_section',
			[
				'label' => __( 'Text', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'           => 'post_content',
				'label'          => __( 'Typography', 'the7mk2' ),
				'fields_options' => [
					'font_family' => [
						'default' => '',
					],
					'font_size'   => [
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
					],
					'font_weight' => [
						'default' => '',
					],
					'line_height' => [
						'default' => [
							'unit' => 'px',
							'size' => '',
						],
					],
				],
				'selector'       => '{{WRAPPER}} .dt-owl-item-description',
			]
		);

		$this->start_controls_tabs( 'post_content_style_tabs' );

		$this->start_controls_tab(
			'post_content_normal_style',
			[
				'label' => __( 'Normal', 'the7mk2' ),
			]
		);

		$this->add_control(
			'post_content_color',
			[
				'label'     => __( 'Font Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_content_hover_style',
			[
				'label' => __( 'Hover', 'the7mk2' ),
			]
		);

		$this->add_control(
			'post_content_color_hover',
			[
				'label'     => __( 'Font Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-description { transition: color 0.3s ease; }
					{{WRAPPER}} .box-hover:hover .dt-owl-item-description,
					{{WRAPPER}} .elements-hover .dt-owl-item-description:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'post_content_bottom_margin',
			[
				'label'      => __( 'Gap Below Text', 'the7mk2' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
					'size' => 5,
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-description' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Icon section.
		 */
		$this->start_controls_section(
			'icon_section',
			[
				'label' => __( 'Icon', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_basic_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Icon Size', 'the7mk2' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
					'size' => 16,
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}}' => '--icon-font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_border_width',
			[
				'label'      => __( 'Border Width', 'the7mk2' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'unit' => 'px',
					'size' => 2,
				],
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-icon:before' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
					'{{WRAPPER}} .dt-owl-item-icon:after'  => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'the7mk2' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label' => __( 'Normal', 'the7mk2' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-icon i'   => 'color: {{VALUE}}',
					'{{WRAPPER}} .dt-owl-item-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label'     => __( 'Border Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-icon:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .dt-owl-item-icon:after'  => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => __( 'Background Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-icon:before' => 'background: {{VALUE}};',
					'{{WRAPPER}} .dt-owl-item-icon:after'  => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'the7mk2' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label'     => __( 'Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .dt-owl-item-icon i { transition: color 0.3s ease; } {{WRAPPER}} .box-hover:hover .dt-owl-item-icon > i,  {{WRAPPER}} .elements-hover .dt-owl-item-icon:hover > i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .dt-owl-item-icon svg { transition: fill 0.3s ease; } {{WRAPPER}} .box-hover:hover .dt-owl-item-icon > svg,  {{WRAPPER}} .elements-hover .dt-owl-item-icon:hover > svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[
				'label'     => __( 'Border Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'
					{{WRAPPER}} .dt-owl-item-icon:before,
					{{WRAPPER}} .dt-owl-item-icon:after { transition: opacity 0.3s ease; }
					{{WRAPPER}} .dt-owl-item-icon:after' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color_hover',
			[
				'label'     => __( 'Background Color', 'the7mk2' ),
				'type'      => Controls_Manager::COLOR,
				'alpha'     => true,
				'default'   => '',
				'selectors' => [
					'
					{{WRAPPER}} .dt-owl-item-icon:before,
					{{WRAPPER}} .dt-owl-item-icon:after { transition: opacity 0.3s ease; }
					{{WRAPPER}} .dt-owl-item-icon:after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_image',
			[
				'label' => __( 'Image', 'the7mk2' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->template( Image_Aspect_Ratio::class )->add_style_controls();

		$this->add_control(
			'img_border_radius',
			[
				'label'      => __( 'Border Radius', 'the7mk2' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-image, {{WRAPPER}} .dt-owl-item-image:before, {{WRAPPER}} .dt-owl-item-image:after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .dt-owl-item-image > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .dt-owl-item-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'image_scale_animation_on_hover',
			[
				'label'   => __( 'Scale Animation On Hover', 'the7mk2' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'quick_scale',
				'options' => [
					'disabled'    => __( 'Disabled', 'the7mk2' ),
					'quick_scale' => __( 'Quick scale', 'the7mk2' ),
					'slow_scale'  => __( 'Slow scale', 'the7mk2' ),
				],
			]
		);

		$this->start_controls_tabs( 'thumbnail_effects_tabs' );

		$this->start_controls_tab(
			'normal',
			[
				'label' => __( 'Normal', 'the7mk2' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'overlay_background',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => __( 'Overlay', 'the7mk2' ),
					],
				],
				'selector'       => '
				{{WRAPPER}} .dt-owl-item-image:before,
				{{WRAPPER}} .dt-owl-item-image:after
				',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'img_shadow',
				'selector' => '
				{{WRAPPER}} .dt-owl-item-image
				',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'thumbnail_filters',
				'selector' => '
				{{WRAPPER}} .dt-owl-item-image img
				',
			]
		);

		$this->add_control(
			'thumbnail_opacity',
			[
				'label'      => __( 'Opacity', 'the7mk2' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .dt-owl-item-image img' => 'opacity: calc({{SIZE}}/100)',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'hover',
			[
				'label' => __( 'Hover', 'the7mk2' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'           => 'overlay_hover_background',
				'types'          => [ 'classic', 'gradient' ],
				'exclude'        => [ 'image' ],
				'fields_options' => [
					'background' => [
						'label' => __( 'Overlay', 'the7mk2' ),
					],
					'color'      => [
						'selectors' => [
							'
							{{SELECTOR}},
							{{WRAPPER}} .dt-owl-item-image:before { transition: opacity 0.3s ease; }
							{{SELECTOR}}' => 'background: {{VALUE}};',
						],
					],

				],
				'selector'       => '
				{{WRAPPER}} .dt-owl-item-image:after

				',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'img_hover_shadow',
				'selector' => '
				{{WRAPPER}} .dt-owl-item-image:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'thumbnail_hover_filters',
				'selector' => '
				{{WRAPPER}} .dt-owl-item-image:hover img
				',
			]
		);

		$this->add_control(
			'thumbnail_hover_opacity',
			[
				'label'      => __( 'Opacity', 'the7mk2' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'
					{{WRAPPER}} .dt-owl-item-image img { transition: opacity 0.3s ease; }
					{{WRAPPER}} .box-hover:hover .dt-owl-item-image img,
					{{WRAPPER}} .elements-hover .dt-owl-item-image:hover img ' => 'opacity: calc({{SIZE}}/100)',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->template( Button::class )->add_style_controls(
			Button::ICON_MANAGER,
			[],
			[
				'gap_above_button' => null,
			]
		);

		$this->template( Arrows::class )->add_style_controls();
		$this->template( Bullets::class )->add_style_controls();
	}

	/**
	 * Render widget.
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['list'] ) ) {
			return;
		}

		$this->remove_image_hooks();
		$this->print_inline_css();

		$this->template( Arrows::class )->add_container_render_attributes( 'wrapper' );
		$this->add_container_class_render_attribute( 'wrapper' );
		$this->add_container_data_render_attributes( 'wrapper' );

		// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
		$title_element = Utils::validate_html_tag( $settings['title_tag'] );
		$slide_count   = 0;
		$img_wrapper_class = 'dt-owl-item-image ' . $this->template( Image_Aspect_Ratio::class )->get_image_wrap_class();
		if ( presscore_lazy_loading_enabled() ) {
			$img_wrapper_class .= ' layzr-bg';
		}

		foreach ( $settings['list'] as $slide ) {
			$btn_attributes_list = [];
			$btn_attributes      = '';
			$slide_attributes    = '';
			$slide_element       = 'div';
			$btn_element         = 'div';
			$icon_element        = 'div';
			$wrap_class          = '';
			$title_link          = '';
			$title_link_close    = '';

			if ( $slide['graphic_type'] === 'none' ) {
				$wrap_class .= ' hide-icon';
			}
			if ( 'y' === $settings['link_hover'] && 'button' === $settings['link_click'] ) {
				$wrap_class .= ' elements-hover';
			} elseif ( 'y' === $settings['link_hover'] ) {
				$wrap_class .= ' box-hover';
			}

			if ( ! empty( $slide['link']['url'] ) ) {
				$this->add_link_attributes( 'slide_link' . $slide_count, $slide['link'] );

				if ( 'button' === $settings['link_click'] ) {
					$wrap_class         .= ' elements-hover';
					$btn_element         = 'a';
					$icon_element        = 'a';
					$btn_attributes      = $this->get_render_attribute_string( 'slide_link' . $slide_count );
					$btn_attributes_list = $this->get_render_attributes( 'slide_link' . $slide_count );

					$title_link       = '<a ' . $btn_attributes . '>';
					$title_link_close = '</a>';
				} else {
					$wrap_class      .= ' box-hover';
					$slide_element    = 'a';
					$slide_attributes = $this->get_render_attribute_string( 'slide_link' . $slide_count );
				}
			}

			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '<' . $slide_element . '  class="dt-owl-item-wrap' . $wrap_class . '"  ' . $slide_attributes . '>';
			echo '<div class="dt-owl-item-inner ">';

			if ( $slide['list_icon'] ) {
				echo '<' . $icon_element . ' ' . $btn_attributes . '  class="dt-owl-item-icon">';
				Icons_Manager::render_icon(
					$slide['list_icon'],
					[
						'aria-hidden' => 'true',
						'class'       => 'open-button',
					],
					'i'
				);
				echo '</' . $icon_element . '>';
			}

			if ( 'image' === $slide['graphic_type'] && ! empty( $slide['list_image']['id'] ) ) {
				echo '<' . $icon_element . ' ' . $btn_attributes . ' class="' . $img_wrapper_class . '"> ';

				dt_get_thumb_img(
					[
						'img_id'  => $slide['list_image']['id'],
						'wrap'    => '<img %IMG_CLASS% %SRC% %ALT% %IMG_TITLE% %SIZE% />',
						'echo'    => true,
					]
				);

				echo '</' . $icon_element . '>';
			}

			if ( $slide['list_title'] ) {
				echo '<' . $title_element . '  class="dt-owl-item-heading">' . $title_link . wp_kses_post( $slide['list_title'] ) . $title_link_close . '</' . $title_element . '>';
			}

			if ( $slide['list_content'] ) {
				echo '<div class="dt-owl-item-description">' . wp_kses_post( $slide['list_content'] ) . '</div>';
			}

			if ( $slide['button'] || $this->template( Button::class )->is_icon_visible() ) {
				// Cleanup button render attributes.
				$this->remove_render_attribute( 'box-button' );

				$this->add_render_attribute( 'box-button', $btn_attributes_list ?: [] );
				$this->add_render_attribute( 'box-button', 'class', 'dt-slide-button' );

				$this->template( Button::class )->render_button(
					'box-button',
					esc_html( $slide['button'] ),
					$btn_element
				);
			}

			echo '</div>';
			echo '</' . $slide_element . '>';

			$slide_count++;
		}

		echo '</div>';

		$this->template( Arrows::class )->render();

		$this->add_image_hooks();
	}

	/**
	 * @param string $element Element name.
	 *
	 * @return void
	 */
	protected function add_container_class_render_attribute( $element ) {
		$class   = [ 'owl-carousel', 'text-and-icon-carousel', 'elementor-owl-carousel-call' ];
		$class[] = 'the7-elementor-widget';

		// Unique class.
		$class[] = $this->get_unique_class();

		$settings = $this->get_settings_for_display();

		$class[] = the7_array_match(
			$settings['bullets_style'],
			[
				'scale-up'         => 'bullets-scale-up',
				'stroke'           => 'bullets-stroke',
				'fill-in'          => 'bullets-fill-in',
				'small-dot-stroke' => 'bullets-small-dot-stroke',
				'ubax'             => 'bullets-ubax',
				'etefu'            => 'bullets-etefu',
			]
		);

		if ( $settings['image_scale_animation_on_hover'] === 'quick_scale' ) {
			$class[] = 'quick-scale-img';
		} elseif ( $settings['image_scale_animation_on_hover'] === 'slow_scale' ) {
			$class[] = 'scale-img';
		}

		$this->add_render_attribute( $element, 'class', $class );
	}

	/**
	 * @param string $element Element name.
	 *
	 * @return void
	 */
	protected function add_container_data_render_attributes( $element ) {
		$settings = $this->get_settings_for_display();

		$data_atts = [
			'data-scroll-mode'          => $settings['slide_to_scroll'] === 'all' ? 'page' : '1',
			'data-col-num'              => $settings['widget_columns'],
			'data-wide-col-num'         => $settings['wide_desk_columns'],
			'data-laptop-col'           => $settings['widget_columns_tablet'],
			'data-h-tablet-columns-num' => $settings['widget_columns_tablet'],
			'data-v-tablet-columns-num' => $settings['widget_columns_tablet'],
			'data-phone-columns-num'    => $settings['widget_columns_mobile'],
			'data-auto-height'          => $settings['adaptive_height'] ? 'true' : 'false',
			'data-col-gap'              => $settings['gap_between_posts']['size'],
			'data-col-gap-tablet'       => $settings['gap_between_posts_tablet']['size'],
			'data-col-gap-mobile'       => $settings['gap_between_posts_mobile']['size'],
			'data-speed'                => $settings['speed'],
			'data-autoplay'             => $settings['autoplay'] ? 'true' : 'false',
			'data-autoplay_speed'       => $settings['autoplay_speed'],
			'data-bullet'               => $settings['show_bullets'],
			'data-bullet_tablet'        => $settings['show_bullets_tablet'],
			'data-bullet_mobile'        => $settings['show_bullets_mobile'],
		];

		$this->add_render_attribute( $element, $data_atts );
	}

	/**
	 * Return shortcode less file absolute path to output inline.
	 *
	 * @return string
	 */
	protected function get_less_file_name() {
		return PRESSCORE_THEME_DIR . '/css/dynamic-less/elementor/the7-carousel-text-and-icon-widget.less';
	}

	/**
	 * @param  The7_Elementor_Less_Vars_Decorator_Interface $less_vars Less vars manager object.
	 *
	 * @return void
	 */
	protected function less_vars( The7_Elementor_Less_Vars_Decorator_Interface $less_vars ) {
		// For project icon style, see `selectors` in settings declaration.

		$settings = $this->get_settings_for_display();

		$less_vars->add_keyword(
			'unique-shortcode-class-name',
			$this->get_unique_class() . '.text-and-icon-carousel',
			'~"%s"'
		);

		$less_vars->add_pixel_number( 'icon-size', $settings['arrow_icon_size'] );

		$this->template( Arrows::class )->add_less_vars( $less_vars );

		$less_vars->add_keyword( 'bullets-v-position', $settings['bullets_v_position'] );
		$less_vars->add_keyword( 'bullets-h-position', $settings['bullets_h_position'] );
		$less_vars->add_pixel_number( 'bullet-v-position', $settings['bullets_v_offset'] );
		$less_vars->add_pixel_number( 'bullet-h-position', $settings['bullets_h_offset'] );

		$icon_bg_size       = array_merge( [ 'size' => 0 ], array_filter( $settings['icon_bg_size'] ) );
		$iconbg_size_tablet = array_merge(
			$icon_bg_size,
			$this->unset_empty_value( $settings['icon_bg_size_tablet'] )
		);
		$iconbg_size_mobile = array_merge(
			$iconbg_size_tablet,
			$this->unset_empty_value( $settings['icon_bg_size_mobile'] )
		);
		$less_vars->add_pixel_or_percent_number( 'icon-bg-size', $icon_bg_size );
		$less_vars->add_pixel_or_percent_number( 'icon-bg-size-tablet', $iconbg_size_tablet );
		$less_vars->add_pixel_or_percent_number( 'icon-bg-size-mobile', $iconbg_size_mobile );

		$less_vars->add_pixel_number(
			'icon-font-size',
			$this->get_settings_for_display( 'icon_size' )
		);
		$less_vars->add_pixel_number(
			'icon-font-size-tablet',
			$this->get_responsive_setting( 'icon_size', 'tablet' )
		);
		$less_vars->add_pixel_number(
			'icon-font-size-mobile',
			$this->get_responsive_setting( 'icon_size', 'mobile' )
		);

		$defaults              = [
			'top'    => 0,
			'right'  => 0,
			'bottom' => 0,
			'left'   => 0,
		];
		$icon_below_gap        = array_merge(
			$defaults,
			the7_array_filter_non_empty_string( $settings['icon_below_gap'] )
		);
		$icon_below_gap_tablet = array_merge(
			$icon_below_gap,
			$this->unset_empty_value( $settings['icon_below_gap_tablet'] )
		);
		$icon_below_gap_mobile = array_merge(
			$icon_below_gap_tablet,
			$this->unset_empty_value( $settings['icon_below_gap_mobile'] )
		);

		$less_vars->add_paddings(
			[
				'icon-padding-top',
				'icon-padding-right',
				'icon-padding-bottom',
				'icon-padding-left',
			],
			$icon_below_gap,
			'px|%'
		);
		$less_vars->add_paddings(
			[
				'icon-padding-top-tablet',
				'icon-padding-right-tablet',
				'icon-padding-bottom-tablet',
				'icon-padding-left-tablet',
			],
			$icon_below_gap_tablet,
			'px|%'
		);
		$less_vars->add_paddings(
			[
				'icon-padding-top-mobile',
				'icon-padding-right-mobile',
				'icon-padding-bottom-mobile',
				'icon-padding-left-mobile',
			],
			$icon_below_gap_mobile,
			'px|%'
		);
	}
}
