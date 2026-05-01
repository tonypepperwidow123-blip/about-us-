<?php
namespace Vesara_Silks\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Our_Purpose_Widget extends Widget_Base {

    public function get_name(): string { return 'vsw_our_purpose'; }
    public function get_title(): string { return esc_html__( 'Vesara — Our Purpose', 'vesara-silks-widgets' ); }
    public function get_icon(): string { return 'eicon-favorite'; }
    public function get_categories(): array { return [ 'vesara-silks' ]; }
    public function get_keywords(): array { return [ 'vesara', 'purpose', 'about', 'silk', 'brand' ]; }
    public function get_style_depends(): array { return [ 'vesara-widgets-style' ]; }

    protected function register_controls(): void {

        $this->start_controls_section( 'section_purpose_content', [
            'label' => esc_html__( 'Content', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'purpose_icon', [
            'label'       => esc_html__( 'Icon', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::ICONS,
            'default'     => [ 'value' => 'fas fa-heart', 'library' => 'fa-solid' ],
            'label_block' => true,
        ] );

        $this->add_control( 'purpose_svg_override', [
            'label'       => esc_html__( 'Or Upload Custom SVG Icon', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::MEDIA,
            'media_types' => [ 'svg' ],
            'default'     => [ 'url' => '' ],
            'description' => esc_html__( 'Upload an SVG file. If set, this will replace the icon above.', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'purpose_title', [
            'label'   => esc_html__( 'Title', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'OUR PURPOSE', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'purpose_intro', [
            'label'   => esc_html__( 'Intro Content', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::WYSIWYG,
            'default' => '<p>We believe silk sarees are more than garments — they are a reflection of heritage, culture, and identity.</p><p>Through Vesara Silks, our goal is to:</p>',
        ] );

        $this->add_control( 'purpose_bullets', [
            'label'       => esc_html__( 'Bullet Points (one per line)', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::TEXTAREA,
            'default'     => "Make premium silk sarees reachable for saree lovers\nEmpower weaving communities\nPreserve and pass on our traditions to the next generation",
            'rows'        => 5,
            'description' => esc_html__( 'Enter each bullet on a new line.', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'purpose_image', [
            'label'   => esc_html__( 'Image', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => '' ],
        ] );

        $this->add_control( 'purpose_image_position', [
            'label'   => esc_html__( 'Image Position', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::SELECT,
            'default' => 'left',
            'options' => [
                'left'  => esc_html__( 'Image Left', 'vesara-silks-widgets' ),
                'right' => esc_html__( 'Image Right', 'vesara-silks-widgets' ),
            ],
        ] );

        $this->end_controls_section();

        // STYLE TAB
        $this->start_controls_section( 'purpose_style', [
            'label' => esc_html__( 'Style', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'purpose_bg', [
            'label'     => esc_html__( 'Background Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f5ede0',
            'selectors' => [ '{{WRAPPER}} .vsw-section-outer' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'purpose_badge_bg', [
            'label'     => esc_html__( 'Icon Badge Background', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#4a1e0e',
            'selectors' => [ '{{WRAPPER}} .vsw-icon-badge' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'purpose_icon_heading', [
            'label'     => esc_html__( 'Icon Adjustments', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_control( 'purpose_icon_color', [
            'label'     => esc_html__( 'Icon Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [
                '{{WRAPPER}} .vsw-icon-badge i'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-icon-badge svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_responsive_control( 'purpose_icon_size', [
            'label'      => esc_html__( 'Icon Size', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 10, 'max' => 80 ] ],
            'default'    => [ 'size' => 22, 'unit' => 'px' ],
            'selectors'  => [
                '{{WRAPPER}} .vsw-icon-badge i'  => 'font-size: {{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .vsw-icon-badge svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
            ],
        ] );

        $this->add_responsive_control( 'purpose_badge_size', [
            'label'      => esc_html__( 'Badge Circle Size', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 120 ] ],
            'default'    => [ 'size' => 56, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-icon-badge' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'purpose_icon_margin', [
            'label'       => esc_html__( 'Icon Position (Margin)', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::DIMENSIONS,
            'size_units'  => [ 'px', '%', 'em' ],
            'selectors'   => [ '{{WRAPPER}} .vsw-icon-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            'description' => esc_html__( 'Use margin to manually move the icon up, down, left, or right.', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'purpose_gold', [
            'label'     => esc_html__( 'Gold Accent Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [
                '{{WRAPPER}} .vsw-section-title'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-title-rule'     => 'background: {{VALUE}};',
                '{{WRAPPER}} .vsw-bullet::before' => 'background: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'purpose_text_color', [
            'label'     => esc_html__( 'Text Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#3a2210',
            'selectors' => [
                '{{WRAPPER}} .vsw-section-body' => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-bullet'       => 'color: {{VALUE}};',
            ],
        ] );

        $this->add_responsive_control( 'purpose_padding_y', [
            'label'      => esc_html__( 'Vertical Padding', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 160 ] ],
            'default'    => [ 'size' => 80, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-section-wrap' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_control( 'purpose_img_radius', [
            'label'      => esc_html__( 'Image Border Radius', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'size' => 4, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-section-img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'purpose_title_typo',
            'selector' => '{{WRAPPER}} .vsw-section-title',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'purpose_body_typo',
            'selector' => '{{WRAPPER}} .vsw-section-body',
        ] );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings  = $this->get_settings_for_display();
        $img_pos   = $settings['purpose_image_position'] === 'left' ? 'vsw-layout--img-left' : 'vsw-layout--img-right';
        $has_image = ! empty( $settings['purpose_image']['url'] );
        $svg_url   = ! empty( $settings['purpose_svg_override']['url'] ) ? $settings['purpose_svg_override']['url'] : '';
        $bullets   = array_filter( array_map( 'trim', explode( "\n", $settings['purpose_bullets'] ) ) );
        ?>
        <div class="vsw-section-outer">
            <div class="vsw-section-wrap <?php echo esc_attr( $img_pos ); ?>">
                <div class="vsw-section-text">
                    <div class="vsw-section-header">
                        <span class="vsw-icon-badge" aria-hidden="true">
                            <?php if ( $svg_url ) : ?>
                                <img src="<?php echo esc_url( $svg_url ); ?>" alt="" class="vsw-svg-icon" aria-hidden="true">
                            <?php else : ?>
                                <?php Icons_Manager::render_icon( $settings['purpose_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php endif; ?>
                        </span>
                        <h2 class="vsw-section-title"><?php echo esc_html( $settings['purpose_title'] ); ?></h2>
                    </div>
                    <span class="vsw-title-rule" aria-hidden="true"></span>
                    <div class="vsw-section-body">
                        <?php echo wp_kses_post( $settings['purpose_intro'] ); ?>
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
                    <img class="vsw-section-img" src="<?php echo esc_url( $settings['purpose_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['purpose_title'] ); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var imgPos     = settings.purpose_image_position === 'left' ? 'vsw-layout--img-left' : 'vsw-layout--img-right';
        var svgUrl     = ( settings.purpose_svg_override && settings.purpose_svg_override.url ) ? settings.purpose_svg_override.url : '';
        var iconHTML   = elementor.helpers.renderIcon( view, settings.purpose_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
        var bulletsRaw = settings.purpose_bullets || '';
        var bullets    = bulletsRaw.split('\n').filter( function(b) { return b.trim() !== ''; } );
        #>
        <div class="vsw-section-outer">
            <div class="vsw-section-wrap {{ imgPos }}">
                <div class="vsw-section-text">
                    <div class="vsw-section-header">
                        <span class="vsw-icon-badge" aria-hidden="true">
                            <# if ( svgUrl ) { #>
                                <img src="{{ svgUrl }}" alt="" class="vsw-svg-icon" aria-hidden="true">
                            <# } else if ( iconHTML && iconHTML.value ) { #>
                                {{{ iconHTML.value }}}
                            <# } #>
                        </span>
                        <h2 class="vsw-section-title">{{ settings.purpose_title }}</h2>
                    </div>
                    <span class="vsw-title-rule" aria-hidden="true"></span>
                    <div class="vsw-section-body">
                        {{{ settings.purpose_intro }}}
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
                    <# if ( settings.purpose_image && settings.purpose_image.url ) { #>
                    <img class="vsw-section-img" src="{{ settings.purpose_image.url }}" alt="{{ settings.purpose_title }}">
                    <# } #>
                </div>
            </div>
        </div>
        <?php
    }
}
