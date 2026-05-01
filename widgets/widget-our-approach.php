<?php
namespace Vesara_Silks\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class Our_Approach_Widget extends Widget_Base {

    public function get_name(): string {
        return 'vsw_our_approach';
    }

    public function get_title(): string {
        return esc_html__( 'Vesara — Our Approach', 'vesara-silks-widgets' );
    }

    public function get_icon(): string {
        return 'eicon-heart';
    }

    public function get_categories(): array {
        return [ 'vesara-silks' ];
    }

    public function get_keywords(): array {
        return [ 'vesara', 'approach', 'about', 'silk', 'brand' ];
    }

    public function get_style_depends(): array {
        return [ 'vesara-widgets-style' ];
    }

    protected function register_controls(): void {

        // ── CONTENT TAB ──────────────────────────────────────────────────────

        $this->start_controls_section( 'section_approach_content', [
            'label' => esc_html__( 'Content', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'approach_icon', [
            'label'   => esc_html__( 'Icon Class', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => 'eicon-heart',
        ] );

        $this->add_control( 'approach_title', [
            'label'   => esc_html__( 'Title', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'OUR APPROACH', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'approach_intro', [
            'label'   => esc_html__( 'Intro Content', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::WYSIWYG,
            'default' => '<p>Vesara Silks works closely with weavers and artisan communities, sourcing sarees directly from those who create them.</p><p>By reducing multiple layers between the maker and the customer, we aim to:</p>',
        ] );

        $this->add_control( 'approach_bullets', [
            'label'       => esc_html__( 'Bullet Points (one per line)', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => "Support the livelihood of skilled weavers\nEnsure fair and consistent opportunities for artisan communities\nMaintain authenticity in every weave\nOffer premium silk sarees at more accessible prices",
            'rows'        => 6,
            'description' => esc_html__( 'Enter each bullet on a new line.', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'approach_image', [
            'label'   => esc_html__( 'Image', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => '' ],
        ] );

        $this->add_control( 'approach_image_position', [
            'label'   => esc_html__( 'Image Position', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'right',
            'options' => [
                'left'  => esc_html__( 'Image Left', 'vesara-silks-widgets' ),
                'right' => esc_html__( 'Image Right', 'vesara-silks-widgets' ),
            ],
        ] );

        $this->end_controls_section();

        // ── STYLE TAB ─────────────────────────────────────────────────────────

        $this->start_controls_section( 'approach_style', [
            'label' => esc_html__( 'Style', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'approach_bg', [
            'label'     => esc_html__( 'Background Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f5ede0',
            'selectors' => [ '{{WRAPPER}} .vsw-section-outer' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'approach_badge_bg', [
            'label'     => esc_html__( 'Icon Badge Background', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#4a1e0e',
            'selectors' => [ '{{WRAPPER}} .vsw-icon-badge' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'approach_icon_heading', [
            'label'     => esc_html__( 'Icon Adjustments', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_responsive_control( 'approach_icon_size', [
            'label'      => esc_html__( 'Icon Size', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 10, 'max' => 80 ] ],
            'selectors'  => [ '{{WRAPPER}} .vsw-icon-badge i' => 'font-size: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'approach_badge_size', [
            'label'      => esc_html__( 'Badge Circle Size', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 120 ] ],
            'selectors'  => [ '{{WRAPPER}} .vsw-icon-badge' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'approach_icon_margin', [
            'label'      => esc_html__( 'Icon Position (Margin)', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%', 'em' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-icon-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            'description'=> esc_html__( 'Use margin to manually move the icon up, down, left, or right.', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'approach_gold', [
            'label'     => esc_html__( 'Gold Accent Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [
                '{{WRAPPER}} .vsw-section-title'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-title-rule'     => 'background: {{VALUE}};',
                '{{WRAPPER}} .vsw-icon-badge i'   => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-bullet::before' => 'background: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'approach_text_color', [
            'label'     => esc_html__( 'Text Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#3a2210',
            'selectors' => [
                '{{WRAPPER}} .vsw-section-body' => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-bullet'       => 'color: {{VALUE}};',
            ],
        ] );

        $this->add_responsive_control( 'approach_padding_y', [
            'label'      => esc_html__( 'Vertical Padding', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 160 ] ],
            'default'    => [ 'size' => 80, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-section-wrap' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->add_control( 'approach_img_radius', [
            'label'      => esc_html__( 'Image Border Radius', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'size' => 4, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-section-img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'approach_title_typo',
            'selector' => '{{WRAPPER}} .vsw-section-title',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'approach_body_typo',
            'selector' => '{{WRAPPER}} .vsw-section-body',
        ] );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings   = $this->get_settings_for_display();
        $img_pos    = $settings['approach_image_position'] === 'left' ? 'vsw-layout--img-left' : 'vsw-layout--img-right';
        $icon_class = esc_attr( $settings['approach_icon'] );
        $has_image  = ! empty( $settings['approach_image']['url'] );
        $bullets    = array_filter( array_map( 'trim', explode( "\n", $settings['approach_bullets'] ) ) );
        ?>
        <div class="vsw-section-outer">
            <div class="vsw-section-wrap <?php echo esc_attr( $img_pos ); ?>">

                <div class="vsw-section-text">
                    <div class="vsw-section-header">
                        <span class="vsw-icon-badge" aria-hidden="true">
                            <i class="<?php echo $icon_class; ?>"></i>
                        </span>
                        <h2 class="vsw-section-title"><?php echo esc_html( $settings['approach_title'] ); ?></h2>
                    </div>
                    <span class="vsw-title-rule" aria-hidden="true"></span>
                    <div class="vsw-section-body">
                        <?php echo wp_kses_post( $settings['approach_intro'] ); ?>
                        <?php if ( ! empty( $bullets ) ) : ?>
                        <ul class="vsw-bullets">
                            <?php foreach ( $bullets as $item ) : ?>
                            <li class="vsw-bullet"><?php echo esc_html( $item ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="vsw-section-media">
                    <?php if ( $has_image ) : ?>
                    <img class="vsw-section-img"
                         src="<?php echo esc_url( $settings['approach_image']['url'] ); ?>"
                         alt="<?php echo esc_attr( $settings['approach_title'] ); ?>"
                         loading="lazy">
                    <?php endif; ?>
                </div>

            </div>
        </div>
        <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var imgPos     = settings.approach_image_position === 'left' ? 'vsw-layout--img-left' : 'vsw-layout--img-right';
        var iconClass  = settings.approach_icon;
        var bulletsRaw = settings.approach_bullets || '';
        var bullets    = bulletsRaw.split('\n').filter( function(b) { return b.trim() !== ''; } );
        #>
        <div class="vsw-section-outer">
            <div class="vsw-section-wrap {{ imgPos }}">

                <div class="vsw-section-text">
                    <div class="vsw-section-header">
                        <span class="vsw-icon-badge" aria-hidden="true">
                            <i class="{{ iconClass }}"></i>
                        </span>
                        <h2 class="vsw-section-title">{{ settings.approach_title }}</h2>
                    </div>
                    <span class="vsw-title-rule" aria-hidden="true"></span>
                    <div class="vsw-section-body">
                        {{{ settings.approach_intro }}}
                        <# if ( bullets.length ) { #>
                        <ul class="vsw-bullets">
                            <# _.each( bullets, function( item ) { #>
                            <li class="vsw-bullet">{{ item.trim() }}</li>
                            <# } ); #>
                        </ul>
                        <# } #>
                    </div>
                </div>

                <div class="vsw-section-media">
                    <# if ( settings.approach_image && settings.approach_image.url ) { #>
                    <img class="vsw-section-img"
                         src="{{ settings.approach_image.url }}"
                         alt="{{ settings.approach_title }}">
                    <# } #>
                </div>

            </div>
        </div>
        <?php
    }
}
