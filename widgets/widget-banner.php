<?php
namespace Vesara_Silks\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit;

class Banner_Widget extends Widget_Base {

    public function get_name(): string { return 'vsw_banner'; }
    public function get_title(): string { return esc_html__( 'Vesara — Hero Banner', 'vesara-silks-widgets' ); }
    public function get_icon(): string { return 'eicon-slideshow'; }
    public function get_categories(): array { return [ 'vesara-silks' ]; }
    public function get_keywords(): array { return [ 'vesara', 'banner', 'hero', 'slider', 'silk' ]; }
    public function get_style_depends(): array { return [ 'vesara-widgets-style' ]; }
    public function get_script_depends(): array { return [ 'vesara-banner-script' ]; }

    protected function register_controls(): void {

        // ── SLIDES ────────────────────────────────────────────────────────────
        $this->start_controls_section( 'slides_section', [
            'label' => esc_html__( 'Slides', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $repeater = new Repeater();

        $repeater->add_control( 'slide_image', [
            'label'   => esc_html__( 'Background Image (Desktop)', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => '' ],
        ] );

        $repeater->add_control( 'slide_image_mobile', [
            'label'   => esc_html__( 'Background Image (Mobile/Portrait)', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => '' ],
            'description' => esc_html__( 'Optional. Upload a portrait-oriented image for mobile devices. If empty, the desktop image will be used.', 'vesara-silks-widgets' ),
        ] );

        $repeater->add_control( 'slide_bg_size', [
            'label'   => esc_html__( 'Image Fit (Desktop)', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'options' => [
                'cover'   => esc_html__( 'Cover — fill banner, may crop top/bottom', 'vesara-silks-widgets' ),
                'contain' => esc_html__( 'Contain — show full image, no cropping', 'vesara-silks-widgets' ),
                'auto'    => esc_html__( 'Auto — original image size', 'vesara-silks-widgets' ),
                '100% 100%' => esc_html__( 'Stretch — stretch to fill exactly', 'vesara-silks-widgets' ),
            ],
            'default'     => 'cover',
            'description' => esc_html__( 'If top/bottom of image is cut off, switch to "Contain".', 'vesara-silks-widgets' ),
        ] );

        $repeater->add_control( 'slide_bg_position', [
            'label'   => esc_html__( 'Image Focus Point', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'options' => [
                'center center' => esc_html__( 'Center Center (default)', 'vesara-silks-widgets' ),
                'center top'    => esc_html__( 'Center Top — show top of image', 'vesara-silks-widgets' ),
                'center bottom' => esc_html__( 'Center Bottom — show bottom of image', 'vesara-silks-widgets' ),
                'left center'   => esc_html__( 'Left Center', 'vesara-silks-widgets' ),
                'right center'  => esc_html__( 'Right Center', 'vesara-silks-widgets' ),
                'left top'      => esc_html__( 'Left Top', 'vesara-silks-widgets' ),
                'right top'     => esc_html__( 'Right Top', 'vesara-silks-widgets' ),
                'left bottom'   => esc_html__( 'Left Bottom', 'vesara-silks-widgets' ),
                'right bottom'  => esc_html__( 'Right Bottom', 'vesara-silks-widgets' ),
            ],
            'default'     => 'center center',
            'condition'   => [ 'slide_bg_size' => 'cover' ],
            'description' => esc_html__( 'When Image Fit is "Cover", choose which part of the image to keep visible.', 'vesara-silks-widgets' ),
        ] );

        $repeater->add_control( 'slide_bg_color', [
            'label'   => esc_html__( 'Fallback Background Color', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::COLOR,
            'default' => '#1a1210',
        ] );

        $repeater->add_control( 'slide_overlay_color', [
            'label'       => esc_html__( 'Overlay Color', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::COLOR,
            'default'     => 'transparent',
            'description' => esc_html__( 'Leave transparent for no overlay. Use rgba() to add a dark/light tint over the image.', 'vesara-silks-widgets' ),
        ] );

        $repeater->add_control( 'slide_content_align', [
            'label'   => esc_html__( 'Content Alignment', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => esc_html__( 'Left',   'vesara-silks-widgets' ), 'icon' => 'eicon-text-align-left'   ],
                'center' => [ 'title' => esc_html__( 'Center', 'vesara-silks-widgets' ), 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => esc_html__( 'Right',  'vesara-silks-widgets' ), 'icon' => 'eicon-text-align-right'  ],
            ],
            'default' => 'center',
        ] );

        $repeater->add_control( 'slide_eyebrow', [
            'label'   => esc_html__( 'Eyebrow Label (optional)', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => '',
            'placeholder' => 'e.g. New Collection',
        ] );

        $repeater->add_control( 'slide_heading', [
            'label'   => esc_html__( 'Heading', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'Winter.', 'vesara-silks-widgets' ),
        ] );

        $repeater->add_control( 'slide_subtitle', [
            'label'   => esc_html__( 'Subtitle', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => "Celebrating tradition. Supporting craftsmanship.\nSharing silk with purpose.",
            'rows'    => 2,
        ] );

        $repeater->add_control( 'slide_button_text', [
            'label'   => esc_html__( 'Button Text', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'SHOP COLLECTION', 'vesara-silks-widgets' ),
        ] );

        $repeater->add_control( 'slide_button_url', [
            'label'         => esc_html__( 'Button URL', 'vesara-silks-widgets' ),
            'type'          => Controls_Manager::URL,
            'default'       => [ 'url' => '#' ],
            'show_external' => true,
        ] );

        $repeater->add_control( 'slide_banner_link', [
            'label'         => esc_html__( 'Banner Image Link', 'vesara-silks-widgets' ),
            'type'          => Controls_Manager::URL,
            'default'       => [ 'url' => '' ],
            'show_external' => true,
        ] );

        $this->add_control( 'vsw_banner_slides', [
            'label'       => esc_html__( 'Slides', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::REPEATER,
            'fields'      => $repeater->get_controls(),
            'default'     => [
                [
                    'slide_heading'     => 'Winter.',
                    'slide_eyebrow'     => 'New Collection',
                    'slide_subtitle'    => "Celebrating tradition. Supporting craftsmanship.\nSharing silk with purpose.",
                    'slide_button_text' => 'SHOP COLLECTION',
                    'slide_bg_color'      => '#1a1210',
                    'slide_overlay_color' => 'transparent',
                    'slide_content_align' => 'center',
                ],
                [
                    'slide_heading'     => 'Summer.',
                    'slide_eyebrow'     => 'Exclusive Weaves',
                    'slide_subtitle'    => "Premium silk sarees, directly from the artisan.\nTimeless designs for the modern woman.",
                    'slide_button_text' => 'EXPLORE NOW',
                    'slide_bg_color'      => '#1a100a',
                    'slide_overlay_color' => 'transparent',
                    'slide_content_align' => 'center',
                ],
            ],
            'title_field' => '{{{ slide_heading }}}',
        ] );

        $this->end_controls_section();

        // ── SLIDER SETTINGS ───────────────────────────────────────────────────
        $this->start_controls_section( 'banner_settings_section', [
            'label' => esc_html__( 'Slider Settings', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'animation_preset', [
            'label'   => esc_html__( 'Animation Style', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'options' => [
                'fade'       => esc_html__( 'Fade (Default)', 'vesara-silks-widgets' ),
                'ken-burns'  => esc_html__( 'Ken Burns (Zoom)', 'vesara-silks-widgets' ),
                'zoom-out'   => esc_html__( 'Zoom Out', 'vesara-silks-widgets' ),
                'slide-up'   => esc_html__( 'Slide Up', 'vesara-silks-widgets' ),
                'slide-left' => esc_html__( 'Slide Left', 'vesara-silks-widgets' ),
            ],
            'default' => 'fade',
        ] );

        $this->add_control( 'autoplay', [
            'label' => esc_html__( 'Autoplay', 'vesara-silks-widgets' ),
            'type'  => Controls_Manager::SWITCHER,
            'label_on' => esc_html__( 'Yes', 'vesara-silks-widgets' ),
            'label_off' => esc_html__( 'No', 'vesara-silks-widgets' ),
            'return_value' => 'yes',
            'default' => 'yes',
        ] );

        $this->add_control( 'waiting_delay', [
            'label'      => esc_html__( 'Waiting Delay (Seconds)', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::NUMBER,
            'min'        => 1,
            'max'        => 20,
            'step'       => 0.5,
            'default'    => 4,
            'condition'  => [ 'autoplay' => 'yes' ],
        ] );

        $this->add_control( 'transition_speed', [
            'label'      => esc_html__( 'Transition Speed (ms)', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 300, 'max' => 1500, 'step' => 50 ] ],
            'default'    => [ 'size' => 800 ],
        ] );

        $this->add_control( 'show_dots', [
            'label'        => esc_html__( 'Show Dot Indicators', 'vesara-silks-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'banner_height', [
            'label'      => esc_html__( 'Banner Height', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', 'vh' ],
            'range'      => [ 'px' => [ 'min' => 300, 'max' => 1000 ], 'vh' => [ 'min' => 30, 'max' => 100 ] ],
            'default'    => [ 'size' => 680, 'unit' => 'px' ],
        ] );

        $this->end_controls_section();

        // ── CONTENT PLACEMENT ─────────────────────────────────────────────────
        $this->start_controls_section( 'content_placement_section', [
            'label' => esc_html__( 'Content Placement', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'vertical_position', [
            'label'   => esc_html__( 'Vertical Position', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [ 'title' => esc_html__( 'Top', 'vesara-silks-widgets' ), 'icon' => 'eicon-v-align-top' ],
                'center'     => [ 'title' => esc_html__( 'Middle', 'vesara-silks-widgets' ), 'icon' => 'eicon-v-align-middle' ],
                'flex-end'   => [ 'title' => esc_html__( 'Bottom', 'vesara-silks-widgets' ), 'icon' => 'eicon-v-align-bottom' ],
            ],
            'default' => 'center',
            'selectors' => [
                '{{WRAPPER}} .vsw-banner-slide' => 'align-items: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'content_padding', [
            'label'      => esc_html__( 'Content Padding', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em', 'rem' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-banner-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->add_control( 'content_max_width', [
            'label'      => esc_html__( 'Content Max Width', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px', '%' ],
            'range'      => [
                'px' => [ 'min' => 300, 'max' => 1600 ],
                '%'  => [ 'min' => 30, 'max' => 100 ],
            ],
            'default'    => [ 'size' => 1400, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-banner-content' => 'max-width: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->end_controls_section();

        // ── STYLE: COLORS ─────────────────────────────────────────────────────
        $this->start_controls_section( 'banner_style_section', [
            'label' => esc_html__( 'Colors', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'eyebrow_color', [
            'label'     => esc_html__( 'Eyebrow Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [ '{{WRAPPER}} .vsw-banner-eyebrow' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'heading_color', [
            'label'     => esc_html__( 'Heading Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#ffffff',
            'selectors' => [ '{{WRAPPER}} .vsw-banner-heading' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'subtitle_color', [
            'label'     => esc_html__( 'Subtitle Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'rgba(255,255,255,0.80)',
            'selectors' => [ '{{WRAPPER}} .vsw-banner-subtitle' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'button_heading', [
            'label'     => esc_html__( 'Button', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_control( 'button_bg', [
            'label'     => esc_html__( 'Button Background', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => 'transparent',
            'selectors' => [ '{{WRAPPER}} .vsw-banner-btn' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'button_border_color', [
            'label'     => esc_html__( 'Button Border Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [ '{{WRAPPER}} .vsw-banner-btn' => 'border-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'button_text_color', [
            'label'     => esc_html__( 'Button Text Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [ '{{WRAPPER}} .vsw-banner-btn' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'dot_color', [
            'label'     => esc_html__( 'Active Dot Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'separator' => 'before',
            'default'   => '#c9a96e',
            'selectors' => [ '{{WRAPPER}} .vsw-banner-dot.active' => 'background-color: {{VALUE}}; border-color: {{VALUE}};' ],
        ] );

        $this->end_controls_section();

        // ── STYLE: TYPOGRAPHY ─────────────────────────────────────────────────
        // The Global Font applies to ALL text inside the banner —
        // including any text dynamically added or pasted from outside.
        $this->start_controls_section( 'banner_typography_section', [
            'label' => esc_html__( 'Typography', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'global_font_heading', [
            'label' => esc_html__( 'Global Font', 'vesara-silks-widgets' ),
            'type'  => Controls_Manager::HEADING,
            'description' => esc_html__( 'Applies to ALL text inside the banner — including externally pasted or dynamic content.', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'global_font_info', [
            'type'            => Controls_Manager::RAW_HTML,
            'raw'             => '<small style="color:#a4afb7;line-height:1.5;display:block;margin-bottom:4px;">The <strong>Global Font Family</strong> below sets the base font for the entire banner. Individual controls below override per element.</small>',
            'content_classes' => 'elementor-descriptor',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'        => 'global_banner_typo',
            'label'       => esc_html__( 'Global Font Family', 'vesara-silks-widgets' ),
            // Targets the entire banner wrapper AND any child elements (*).
            // This catches externally pasted text or dynamic text nodes too.
            'selector'    => '{{WRAPPER}} .vsw-banner-wrapper, {{WRAPPER}} .vsw-banner-wrapper *',
            'fields_options' => [
                'font_family' => [
                    'label'   => esc_html__( 'Base Font Family (all text)', 'vesara-silks-widgets' ),
                    'default' => 'EB Garamond',
                ],
                // Hide everything except font_family so it's a clean "global font" picker
                'font_size'       => [ 'label' => esc_html__( 'Font Size',       'vesara-silks-widgets' ) ],
                'font_weight'     => [ 'label' => esc_html__( 'Font Weight',     'vesara-silks-widgets' ) ],
                'font_style'      => [ 'label' => esc_html__( 'Font Style',      'vesara-silks-widgets' ) ],
                'letter_spacing'  => [ 'label' => esc_html__( 'Letter Spacing',  'vesara-silks-widgets' ) ],
            ],
        ] );

        $this->add_control( 'eyebrow_typo_heading', [
            'label'     => esc_html__( 'Eyebrow', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'eyebrow_typo',
            'selector' => '{{WRAPPER}} .vsw-banner-eyebrow',
            'fields_options' => [
                'font_family'    => [ 'default' => 'EB Garamond' ],
                'font_size'      => [ 'default' => [ 'unit' => 'rem', 'size' => 0.75 ] ],
                'font_weight'    => [ 'default' => '500' ],
                'letter_spacing' => [ 'default' => [ 'unit' => 'em', 'size' => 0.36 ] ],
            ],
        ] );

        $this->add_control( 'heading_typo_heading', [
            'label'     => esc_html__( 'Heading', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'heading_typo',
            'selector' => '{{WRAPPER}} .vsw-banner-heading',
            'fields_options' => [
                'font_family'  => [ 'default' => 'Cormorant Garamond' ],
                'font_weight'  => [ 'default' => '600' ],
                'font_style'   => [ 'default' => 'italic' ],
            ],
        ] );

        $this->add_control( 'subtitle_typo_heading', [
            'label'     => esc_html__( 'Subtitle', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'subtitle_typo',
            'selector' => '{{WRAPPER}} .vsw-banner-subtitle',
            'fields_options' => [
                'font_family' => [ 'default' => 'EB Garamond' ],
                'font_style'  => [ 'default' => 'italic' ],
            ],
        ] );

        $this->add_control( 'button_typo_heading', [
            'label'     => esc_html__( 'Button', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'button_typo',
            'selector' => '{{WRAPPER}} .vsw-banner-btn',
            'fields_options' => [
                'font_family'    => [ 'default' => 'EB Garamond' ],
                'font_weight'    => [ 'default' => '500' ],
                'letter_spacing' => [ 'default' => [ 'unit' => 'em', 'size' => 0.3 ] ],
            ],
        ] );

        $this->end_controls_section();

        // ── STYLE: ALIGNMENT & SPACING ─────────────────────────────────────────
        $this->start_controls_section( 'banner_spacing_section', [
            'label' => esc_html__( 'Alignment & Spacing', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'eyebrow_align', [
            'label'   => esc_html__( 'Eyebrow Alignment', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => 'Left', 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => 'Right', 'icon' => 'eicon-text-align-right' ],
            ],
            'selectors' => [ '{{WRAPPER}} .vsw-banner-eyebrow' => 'display: block; text-align: {{VALUE}};' ],
        ] );

        $this->add_control( 'eyebrow_margin', [
            'label'      => esc_html__( 'Eyebrow Margin', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-banner-eyebrow' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->add_control( 'heading_align', [
            'label'   => esc_html__( 'Heading Alignment', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => 'Left', 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => 'Right', 'icon' => 'eicon-text-align-right' ],
            ],
            'selectors' => [ '{{WRAPPER}} .vsw-banner-heading' => 'text-align: {{VALUE}};' ],
            'separator' => 'before',
        ] );

        $this->add_control( 'heading_margin', [
            'label'      => esc_html__( 'Heading Margin', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-banner-heading' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->add_control( 'subtitle_align', [
            'label'   => esc_html__( 'Subtitle Alignment', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::CHOOSE,
            'options' => [
                'left'   => [ 'title' => 'Left', 'icon' => 'eicon-text-align-left' ],
                'center' => [ 'title' => 'Center', 'icon' => 'eicon-text-align-center' ],
                'right'  => [ 'title' => 'Right', 'icon' => 'eicon-text-align-right' ],
            ],
            'selectors' => [ '{{WRAPPER}} .vsw-banner-subtitle' => 'text-align: {{VALUE}};' ],
            'separator' => 'before',
        ] );

        $this->add_control( 'subtitle_margin', [
            'label'      => esc_html__( 'Subtitle Margin', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-banner-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->add_control( 'button_margin', [
            'label'      => esc_html__( 'Button Margin', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-banner-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ] );

        $this->add_control( 'button_padding', [
            'label'      => esc_html__( 'Button Padding', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-banner-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'separator'  => 'before',
        ] );

        $this->end_controls_section();
    }


    protected function render(): void {
        $settings    = $this->get_settings_for_display();
        $slides      = $settings['vsw_banner_slides'];
        $autoplay    = $settings['autoplay'] === 'yes' ? 'yes' : 'no';
        if ( ! empty( $settings['waiting_delay'] ) ) {
            $spd = floatval( $settings['waiting_delay'] ) * 1000;
        } else {
            $spd = ! empty( $settings['autoplay_speed']['size'] ) ? intval( $settings['autoplay_speed']['size'] ) : 4000;
        }
        $trans       = ! empty( $settings['transition_speed']['size'] )  ? intval( $settings['transition_speed']['size'] )  : 800;
        $banner_h    = ! empty( $settings['banner_height']['size'] )     ? intval( $settings['banner_height']['size'] )     : 680;
        $banner_unit = ! empty( $settings['banner_height']['unit'] )     ? esc_attr( $settings['banner_height']['unit'] )   : 'px';
        $show_dots   = $settings['show_dots'] === 'yes';
        $animation   = ! empty( $settings['animation_preset'] )          ? esc_attr( $settings['animation_preset'] )        : 'fade';

        if ( empty( $slides ) ) return;
        ?>
        <div class="vsw-banner-wrapper"
             style="min-height:<?php echo esc_attr( $banner_h . $banner_unit ); ?>;"
             data-autoplay="<?php echo esc_attr( $autoplay ); ?>"
             data-speed="<?php echo esc_attr( $spd ); ?>"
             data-transition="<?php echo esc_attr( $trans ); ?>"
             data-animation="<?php echo esc_attr( $animation ); ?>">

            <?php foreach ( $slides as $index => $slide ) :
                $active      = $index === 0 ? ' vsw-slide-active' : '';
                $bg_color    = ! empty( $slide['slide_bg_color'] ) ? $slide['slide_bg_color'] : '#1a1210';
                $overlay     = ! empty( $slide['slide_overlay_color'] ) ? $slide['slide_overlay_color'] : 'transparent';
                $align       = ! empty( $slide['slide_content_align'] ) ? $slide['slide_content_align'] : 'center';
                $img_url     = '';
                if ( ! empty( $slide['slide_image'] ) && is_array( $slide['slide_image'] ) ) {
                    $img_url = $slide['slide_image']['url'] ?? '';
                }
                $mobile_img_url = '';
                if ( ! empty( $slide['slide_image_mobile'] ) && is_array( $slide['slide_image_mobile'] ) ) {
                    $mobile_img_url = $slide['slide_image_mobile']['url'] ?? '';
                }
                $bg_size     = ! empty( $slide['slide_bg_size'] )     ? $slide['slide_bg_size']     : 'cover';
                $bg_position = ! empty( $slide['slide_bg_position'] ) ? $slide['slide_bg_position'] : 'center center';
                $bg_style = 'background-color:' . esc_attr( $bg_color ) . ';';
                $bg_style .= '--vsw-slide-bg-size:' . esc_attr( $bg_size ) . ';';
                $bg_style .= '--vsw-slide-bg-position:' . esc_attr( $bg_position ) . ';';
                if ( $img_url ) {
                    $bg_style .= '--vsw-bg-desktop:url(' . esc_url( $img_url ) . ');';
                }
                if ( $mobile_img_url ) {
                    $bg_style .= '--vsw-bg-mobile:url(' . esc_url( $mobile_img_url ) . ');';
                }

                $btn_obj     = isset( $slide['slide_button_url'] ) ? $slide['slide_button_url'] : [];
                $btn_url     = ! empty( $btn_obj['url'] ) ? $btn_obj['url'] : '#';
                $is_ext      = ! empty( $btn_obj['is_external'] );
                $rel_parts   = $is_ext ? [ 'noopener' ] : [];
                if ( ! empty( $btn_obj['nofollow'] ) ) $rel_parts[] = 'nofollow';
                $target      = $is_ext ? ' target="_blank"' : '';
                $rel         = $rel_parts ? ' rel="' . esc_attr( implode( ' ', $rel_parts ) ) . '"' : '';

                $b_link_obj  = isset( $slide['slide_banner_link'] ) ? $slide['slide_banner_link'] : [];
                $b_link_url  = ! empty( $b_link_obj['url'] ) ? $b_link_obj['url'] : '';
                $b_is_ext    = ! empty( $b_link_obj['is_external'] );
                $b_rel_parts = $b_is_ext ? [ 'noopener' ] : [];
                if ( ! empty( $b_link_obj['nofollow'] ) ) $b_rel_parts[] = 'nofollow';
                $b_target    = $b_is_ext ? ' target="_blank"' : '';
                $b_rel       = $b_rel_parts ? ' rel="' . esc_attr( implode( ' ', $b_rel_parts ) ) . '"' : '';
            ?>
            <div class="vsw-banner-slide vsw-align-<?php echo esc_attr( $align ); ?><?php echo esc_attr( $active ); ?>"
                 style="<?php echo $bg_style; ?>">

                <?php if ( $b_link_url ) : ?>
                <a href="<?php echo esc_url( $b_link_url ); ?>" class="vsw-banner-overall-link"<?php echo $b_target . $b_rel; ?>></a>
                <?php endif; ?>

                <div class="vsw-banner-overlay" style="background:<?php echo esc_attr( $overlay ); ?>;"></div>

                <div class="vsw-banner-content">
                    <?php if ( ! empty( $slide['slide_eyebrow'] ) ) : ?>
                    <span class="vsw-banner-eyebrow"><?php echo esc_html( $slide['slide_eyebrow'] ); ?></span>
                    <?php endif; ?>

                    <h2 class="vsw-banner-heading"><?php echo esc_html( $slide['slide_heading'] ); ?></h2>

                    <?php if ( ! empty( $slide['slide_subtitle'] ) ) : ?>
                    <p class="vsw-banner-subtitle"><?php echo nl2br( esc_html( $slide['slide_subtitle'] ) ); ?></p>
                    <?php endif; ?>

                    <?php if ( ! empty( $slide['slide_button_text'] ) ) : ?>
                    <a class="vsw-banner-btn" href="<?php echo esc_url( $btn_url ); ?>"<?php echo $target . $rel; ?>>
                        <?php echo esc_html( $slide['slide_button_text'] ); ?>
                    </a>
                    <?php endif; ?>
                </div>

            </div>
            <?php endforeach; ?>

            <?php if ( $show_dots && count( $slides ) > 1 ) : ?>
            <div class="vsw-banner-dots">
                <?php foreach ( $slides as $i => $s ) : ?>
                <button class="vsw-banner-dot<?php echo $i === 0 ? ' active' : ''; ?>"
                        data-index="<?php echo esc_attr( $i ); ?>"
                        aria-label="<?php echo esc_attr( sprintf( 'Slide %d', $i + 1 ) ); ?>"></button>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>

        </div>
        <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var slides    = settings.vsw_banner_slides;
        var bannerH   = settings.banner_height ? settings.banner_height.size : 680;
        var bannerU   = settings.banner_height ? settings.banner_height.unit : 'px';
        var showDots  = settings.show_dots === 'yes';
        var spd = 4000;
        if ( settings.waiting_delay ) {
            spd = parseFloat( settings.waiting_delay ) * 1000;
        } else if ( settings.autoplay_speed && settings.autoplay_speed.size ) {
            spd = settings.autoplay_speed.size;
        }
        var trans     = ( settings.transition_speed && settings.transition_speed.size ) ? settings.transition_speed.size : 800;
        var animation = settings.animation_preset || 'fade';
        #>
        <div class="vsw-banner-wrapper"
             style="min-height:{{ bannerH }}{{ bannerU }};"
             data-autoplay="{{ settings.autoplay }}"
             data-speed="{{ spd }}"
             data-transition="{{ trans }}"
             data-animation="{{ animation }}">

            <# if ( slides && slides.length ) { _.each( slides, function( slide, index ) {
                var active   = index === 0 ? ' vsw-slide-active' : '';
                var bgColor  = slide.slide_bg_color || '#1a1210';
                var overlay  = slide.slide_overlay_color || 'transparent';
                var align    = slide.slide_content_align || 'center';
                var imgUrl   = slide.slide_image && slide.slide_image.url ? slide.slide_image.url : '';
                var mImgUrl  = slide.slide_image_mobile && slide.slide_image_mobile.url ? slide.slide_image_mobile.url : '';
                var bgSize     = slide.slide_bg_size     || 'cover';
                var bgPosition = slide.slide_bg_position || 'center center';
                var bgStyle  = 'background-color:' + bgColor + ';';
                bgStyle += '--vsw-slide-bg-size:' + bgSize + ';';
                bgStyle += '--vsw-slide-bg-position:' + bgPosition + ';';
                if ( imgUrl ) bgStyle += '--vsw-bg-desktop:url(' + imgUrl + ');';
                if ( mImgUrl ) bgStyle += '--vsw-bg-mobile:url(' + mImgUrl + ');';

                var bLink    = slide.slide_banner_link && slide.slide_banner_link.url ? slide.slide_banner_link.url : '';
            #>
            <div class="vsw-banner-slide vsw-align-{{ align }}{{ active }}" style="{{ bgStyle }}">
                <# if ( bLink ) { #>
                <a href="{{ bLink }}" class="vsw-banner-overall-link"></a>
                <# } #>
                <div class="vsw-banner-overlay" style="background:{{ overlay }};"></div>
                <div class="vsw-banner-content">
                    <# if ( slide.slide_eyebrow ) { #>
                    <span class="vsw-banner-eyebrow">{{ slide.slide_eyebrow }}</span>
                    <# } #>
                    <h2 class="vsw-banner-heading">{{ slide.slide_heading }}</h2>
                    <# if ( slide.slide_subtitle ) { #>
                    <p class="vsw-banner-subtitle">{{{ slide.slide_subtitle }}}</p>
                    <# } #>
                    <# if ( slide.slide_button_text ) { #>
                    <a class="vsw-banner-btn" href="{{ slide.slide_button_url ? slide.slide_button_url.url : '#' }}">{{ slide.slide_button_text }}</a>
                    <# } #>
                </div>
            </div>
            <# } ); } #>

            <# if ( showDots && slides && slides.length > 1 ) { #>
            <div class="vsw-banner-dots">
                <# _.each( slides, function( s, i ) { #>
                <button class="vsw-banner-dot<# if(i===0){#> active<#}#>" data-index="{{ i }}" aria-label="Slide {{ i+1 }}"></button>
                <# } ); #>
            </div>
            <# } #>

        </div>
        <?php
    }
}
