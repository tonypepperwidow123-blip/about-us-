<?php
namespace Vesara_Silks\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class About_Hero_Widget extends Widget_Base {

    public function get_name(): string {
        return 'vsw_about_hero';
    }

    public function get_title(): string {
        return esc_html__( 'Vesara — About Hero', 'vesara-silks-widgets' );
    }

    public function get_icon(): string {
        return 'eicon-heading';
    }

    public function get_categories(): array {
        return [ 'vesara-silks' ];
    }

    public function get_keywords(): array {
        return [ 'vesara', 'about', 'hero', 'brand', 'silk' ];
    }

    public function get_style_depends(): array {
        return [ 'vesara-widgets-style' ];
    }

    protected function register_controls(): void {

        // ── CONTENT TAB ──────────────────────────────────────────────────────

        $this->start_controls_section( 'section_hero_content', [
            'label' => esc_html__( 'Content', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'vsw_hero_brand', [
            'label'   => esc_html__( 'Brand Name', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'VESARA SILKS', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'vsw_hero_tagline', [
            'label'   => esc_html__( 'Tagline', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXTAREA,
            'default' => "Celebrating tradition. Supporting craftsmanship.\nSharing silk with purpose.",
            'rows'    => 3,
        ] );

        $this->add_control( 'vsw_hero_show_ornament', [
            'label'        => esc_html__( 'Show Ornament', 'vesara-silks-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'vesara-silks-widgets' ),
            'label_off'    => esc_html__( 'No', 'vesara-silks-widgets' ),
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->add_control( 'vsw_hero_show_dots', [
            'label'        => esc_html__( 'Show Dot Pattern', 'vesara-silks-widgets' ),
            'type'         => Controls_Manager::SWITCHER,
            'label_on'     => esc_html__( 'Yes', 'vesara-silks-widgets' ),
            'label_off'    => esc_html__( 'No', 'vesara-silks-widgets' ),
            'return_value' => 'yes',
            'default'      => 'yes',
        ] );

        $this->end_controls_section();

        // ── STYLE TAB ─────────────────────────────────────────────────────────

        $this->start_controls_section( 'hero_style_section', [
            'label' => esc_html__( 'Style', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'hero_bg_color', [
            'label'     => esc_html__( 'Background Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f5ede0',
            'selectors' => [ '{{WRAPPER}} .vsw-about-hero' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'hero_brand_color', [
            'label'     => esc_html__( 'Brand Name Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [ '{{WRAPPER}} .vsw-hero-brand' => 'color: {{VALUE}};' ],
        ] );

        $this->add_control( 'hero_tagline_color', [
            'label'     => esc_html__( 'Tagline Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [ '{{WRAPPER}} .vsw-hero-tagline' => 'color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'hero_padding_y', [
            'label'      => esc_html__( 'Vertical Padding', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 160 ] ],
            'default'    => [ 'size' => 64, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-about-hero' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'hero_brand_typo',
            'selector' => '{{WRAPPER}} .vsw-hero-brand',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'hero_tagline_typo',
            'selector' => '{{WRAPPER}} .vsw-hero-tagline',
        ] );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="vsw-about-hero">

            <?php if ( 'yes' === $settings['vsw_hero_show_ornament'] ) : ?>
            <div class="vsw-hero-ornament" aria-hidden="true">
                <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="60" cy="60" r="55" stroke="#c9a96e" stroke-width="0.6"/>
                    <circle cx="60" cy="60" r="40" stroke="#c9a96e" stroke-width="0.6"/>
                    <circle cx="60" cy="60" r="25" stroke="#c9a96e" stroke-width="0.6"/>
                    <line x1="60" y1="5" x2="60" y2="115" stroke="#c9a96e" stroke-width="0.5"/>
                    <line x1="5" y1="60" x2="115" y2="60" stroke="#c9a96e" stroke-width="0.5"/>
                    <line x1="21" y1="21" x2="99" y2="99" stroke="#c9a96e" stroke-width="0.5"/>
                    <line x1="99" y1="21" x2="21" y2="99" stroke="#c9a96e" stroke-width="0.5"/>
                    <polygon points="60,2 63,8 60,14 57,8" fill="#c9a96e"/>
                    <polygon points="60,118 63,112 60,106 57,112" fill="#c9a96e"/>
                    <polygon points="2,60 8,63 14,60 8,57" fill="#c9a96e"/>
                    <polygon points="118,60 112,63 106,60 112,57" fill="#c9a96e"/>
                </svg>
            </div>
            <?php endif; ?>

            <?php if ( 'yes' === $settings['vsw_hero_show_dots'] ) : ?>
            <div class="vsw-hero-dots" aria-hidden="true"></div>
            <?php endif; ?>

            <div class="vsw-hero-inner">
                <h1 class="vsw-hero-brand"><?php echo esc_html( $settings['vsw_hero_brand'] ); ?></h1>

                <div class="vsw-hero-divider" aria-hidden="true">
                    <svg width="180" height="14" viewBox="0 0 180 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="7" x2="76" y2="7" stroke="#c9a96e" stroke-width="1"/>
                        <rect x="82" y="1" width="12" height="12" transform="rotate(45 90 7)" fill="#c9a96e"/>
                        <line x1="104" y1="7" x2="180" y2="7" stroke="#c9a96e" stroke-width="1"/>
                    </svg>
                </div>

                <p class="vsw-hero-tagline"><?php echo nl2br( esc_html( $settings['vsw_hero_tagline'] ) ); ?></p>
            </div>

        </div>
        <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var showOrnament = settings.vsw_hero_show_ornament === 'yes';
        var showDots     = settings.vsw_hero_show_dots === 'yes';
        #>
        <div class="vsw-about-hero">

            <# if ( showOrnament ) { #>
            <div class="vsw-hero-ornament" aria-hidden="true">
                <svg viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="60" cy="60" r="55" stroke="#c9a96e" stroke-width="0.6"/>
                    <circle cx="60" cy="60" r="40" stroke="#c9a96e" stroke-width="0.6"/>
                    <circle cx="60" cy="60" r="25" stroke="#c9a96e" stroke-width="0.6"/>
                    <line x1="60" y1="5" x2="60" y2="115" stroke="#c9a96e" stroke-width="0.5"/>
                    <line x1="5" y1="60" x2="115" y2="60" stroke="#c9a96e" stroke-width="0.5"/>
                    <line x1="21" y1="21" x2="99" y2="99" stroke="#c9a96e" stroke-width="0.5"/>
                    <line x1="99" y1="21" x2="21" y2="99" stroke="#c9a96e" stroke-width="0.5"/>
                    <polygon points="60,2 63,8 60,14 57,8" fill="#c9a96e"/>
                    <polygon points="60,118 63,112 60,106 57,112" fill="#c9a96e"/>
                    <polygon points="2,60 8,63 14,60 8,57" fill="#c9a96e"/>
                    <polygon points="118,60 112,63 106,60 112,57" fill="#c9a96e"/>
                </svg>
            </div>
            <# } #>

            <# if ( showDots ) { #>
            <div class="vsw-hero-dots" aria-hidden="true"></div>
            <# } #>

            <div class="vsw-hero-inner">
                <h1 class="vsw-hero-brand">{{ settings.vsw_hero_brand }}</h1>

                <div class="vsw-hero-divider" aria-hidden="true">
                    <svg width="180" height="14" viewBox="0 0 180 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <line x1="0" y1="7" x2="76" y2="7" stroke="#c9a96e" stroke-width="1"/>
                        <rect x="82" y="1" width="12" height="12" transform="rotate(45 90 7)" fill="#c9a96e"/>
                        <line x1="104" y1="7" x2="180" y2="7" stroke="#c9a96e" stroke-width="1"/>
                    </svg>
                </div>

                <p class="vsw-hero-tagline">{{{ settings.vsw_hero_tagline }}}</p>
            </div>

        </div>
        <?php
    }
}
