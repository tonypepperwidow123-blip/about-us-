<?php
namespace Vesara_Silks\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Thought_Behind_Widget extends Widget_Base {

    public function get_name(): string { return 'vsw_thought_behind'; }
    public function get_title(): string { return esc_html__( 'Vesara — The Thought Behind', 'vesara-silks-widgets' ); }
    public function get_icon(): string { return 'eicon-bulb'; }
    public function get_categories(): array { return [ 'vesara-silks' ]; }
    public function get_keywords(): array { return [ 'vesara', 'thought', 'story', 'about', 'silk' ]; }
    public function get_style_depends(): array { return [ 'vesara-widgets-style' ]; }

    protected function register_controls(): void {

        $this->start_controls_section( 'section_thought_content', [
            'label' => esc_html__( 'Content', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_CONTENT,
        ] );

        $this->add_control( 'thought_icon', [
            'label'       => esc_html__( 'Icon', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::ICONS,
            'default'     => [ 'value' => 'fas fa-lightbulb', 'library' => 'fa-solid' ],
            'skin'        => 'inline',
            'label_block' => false,
        ] );

        $this->add_control( 'thought_title_line1', [
            'label'   => esc_html__( 'Title Line 1', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'THE THOUGHT BEHIND', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'thought_title_line2', [
            'label'   => esc_html__( 'Title Line 2', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::TEXT,
            'default' => esc_html__( 'VESARA', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'thought_content', [
            'label'   => esc_html__( 'Content', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::WYSIWYG,
            'default' => '<p>During her journey as a saree enthusiast, she observed a growing concern — premium silk sarees were often priced far beyond reach, making it difficult for many saree lovers to experience true quality.</p><p>More importantly, this disconnect risked distancing future generations from the rich tradition of silk sarees.</p><p>This realization led to a deeper exploration of the saree ecosystem.</p>',
        ] );

        $this->add_control( 'thought_image', [
            'label'   => esc_html__( 'Image', 'vesara-silks-widgets' ),
            'type'    => Controls_Manager::MEDIA,
            'default' => [ 'url' => '' ],
        ] );

        $this->add_control( 'thought_image_position', [
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
        $this->start_controls_section( 'thought_style', [
            'label' => esc_html__( 'Style', 'vesara-silks-widgets' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );

        $this->add_control( 'thought_bg', [
            'label'     => esc_html__( 'Background Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#f5ede0',
            'selectors' => [ '{{WRAPPER}} .vsw-section-outer' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'thought_badge_bg', [
            'label'     => esc_html__( 'Icon Badge Background', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#4a1e0e',
            'selectors' => [ '{{WRAPPER}} .vsw-icon-badge' => 'background-color: {{VALUE}};' ],
        ] );

        $this->add_control( 'thought_icon_heading', [
            'label'     => esc_html__( 'Icon Adjustments', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::HEADING,
            'separator' => 'before',
        ] );

        $this->add_control( 'thought_icon_color', [
            'label'     => esc_html__( 'Icon Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [
                '{{WRAPPER}} .vsw-icon-badge i'  => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-icon-badge svg' => 'fill: {{VALUE}};',
            ],
        ] );

        $this->add_responsive_control( 'thought_icon_size', [
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

        $this->add_responsive_control( 'thought_badge_size', [
            'label'      => esc_html__( 'Badge Circle Size', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 120 ] ],
            'default'    => [ 'size' => 56, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-icon-badge' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_responsive_control( 'thought_icon_margin', [
            'label'       => esc_html__( 'Icon Position (Margin)', 'vesara-silks-widgets' ),
            'type'        => Controls_Manager::DIMENSIONS,
            'size_units'  => [ 'px', '%', 'em' ],
            'selectors'   => [ '{{WRAPPER}} .vsw-icon-badge' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ],
            'description' => esc_html__( 'Use margin to manually move the icon up, down, left, or right.', 'vesara-silks-widgets' ),
        ] );

        $this->add_control( 'thought_gold', [
            'label'     => esc_html__( 'Gold Accent Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#c9a96e',
            'selectors' => [
                '{{WRAPPER}} .vsw-section-title' => 'color: {{VALUE}};',
                '{{WRAPPER}} .vsw-title-rule'    => 'background: {{VALUE}};',
            ],
        ] );

        $this->add_control( 'thought_text_color', [
            'label'     => esc_html__( 'Text Color', 'vesara-silks-widgets' ),
            'type'      => Controls_Manager::COLOR,
            'default'   => '#3a2210',
            'selectors' => [ '{{WRAPPER}} .vsw-section-body' => 'color: {{VALUE}};' ],
        ] );

        $this->add_responsive_control( 'thought_padding_y', [
            'label'      => esc_html__( 'Vertical Padding', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 20, 'max' => 160 ] ],
            'default'    => [ 'size' => 80, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-section-wrap' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_control( 'thought_img_radius', [
            'label'      => esc_html__( 'Image Border Radius', 'vesara-silks-widgets' ),
            'type'       => Controls_Manager::SLIDER,
            'size_units' => [ 'px' ],
            'range'      => [ 'px' => [ 'min' => 0, 'max' => 50 ] ],
            'default'    => [ 'size' => 4, 'unit' => 'px' ],
            'selectors'  => [ '{{WRAPPER}} .vsw-section-img' => 'border-radius: {{SIZE}}{{UNIT}};' ],
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'thought_title_typo',
            'selector' => '{{WRAPPER}} .vsw-section-title',
        ] );

        $this->add_group_control( Group_Control_Typography::get_type(), [
            'name'     => 'thought_body_typo',
            'selector' => '{{WRAPPER}} .vsw-section-body',
        ] );

        $this->end_controls_section();
    }

    protected function render(): void {
        $settings  = $this->get_settings_for_display();
        $img_pos   = $settings['thought_image_position'] === 'left' ? 'vsw-layout--img-left' : 'vsw-layout--img-right';
        $has_image = ! empty( $settings['thought_image']['url'] );
        ?>
        <div class="vsw-section-outer">
            <div class="vsw-section-wrap <?php echo esc_attr( $img_pos ); ?>">
                <div class="vsw-section-text">
                    <div class="vsw-section-header">
                        <span class="vsw-icon-badge" aria-hidden="true">
                            <?php Icons_Manager::render_icon( $settings['thought_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                        <h2 class="vsw-section-title">
                            <?php echo esc_html( $settings['thought_title_line1'] ); ?><br>
                            <?php echo esc_html( $settings['thought_title_line2'] ); ?>
                        </h2>
                    </div>
                    <span class="vsw-title-rule" aria-hidden="true"></span>
                    <div class="vsw-section-body">
                        <?php echo wp_kses_post( $settings['thought_content'] ); ?>
                    </div>
                </div>
                <div class="vsw-section-media">
                    <?php if ( $has_image ) : ?>
                    <img class="vsw-section-img" src="<?php echo esc_url( $settings['thought_image']['url'] ); ?>" alt="<?php echo esc_attr( $settings['thought_title_line1'] . ' ' . $settings['thought_title_line2'] ); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function content_template(): void {
        ?>
        <#
        var imgPos   = settings.thought_image_position === 'left' ? 'vsw-layout--img-left' : 'vsw-layout--img-right';
        var iconHTML = elementor.helpers.renderIcon( view, settings.thought_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
        #>
        <div class="vsw-section-outer">
            <div class="vsw-section-wrap {{ imgPos }}">
                <div class="vsw-section-text">
                    <div class="vsw-section-header">
                        <span class="vsw-icon-badge" aria-hidden="true">
                            <# if ( iconHTML && iconHTML.value ) { #>{{{ iconHTML.value }}}<# } #>
                        </span>
                        <h2 class="vsw-section-title">
                            {{ settings.thought_title_line1 }}<br>
                            {{ settings.thought_title_line2 }}
                        </h2>
                    </div>
                    <span class="vsw-title-rule" aria-hidden="true"></span>
                    <div class="vsw-section-body">
                        {{{ settings.thought_content }}}
                    </div>
                </div>
                <div class="vsw-section-media">
                    <# if ( settings.thought_image && settings.thought_image.url ) { #>
                    <img class="vsw-section-img" src="{{ settings.thought_image.url }}" alt="{{ settings.thought_title_line1 }} {{ settings.thought_title_line2 }}">
                    <# } #>
                </div>
            </div>
        </div>
        <?php
    }
}
