<?php
/**
 * Plugin Name: Vesara Silks Widgets
 * Description: Seven reusable Elementor widgets for the Vesara Silks website.
 * Version: 1.1.1
 * Requires Plugins: elementor
 * Author: Dharani
 * Text Domain: vesara-silks-widgets
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'VSW_VERSION', '1.1.1' );
define( 'VSW_PATH', plugin_dir_path( __FILE__ ) );
define( 'VSW_URL',  plugin_dir_url( __FILE__ )  );

// ── Enqueue Google Fonts via PHP (not CSS @import — avoids host CSP/firewall blocks) ──
function vsw_enqueue_google_fonts() {
    wp_enqueue_style(
        'vesara-google-fonts',
        'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=EB+Garamond:ital,wght@0,400;0,500;1,400&display=swap',
        [],
        null
    );
}
add_action( 'wp_enqueue_scripts',                'vsw_enqueue_google_fonts' );
add_action( 'elementor/preview/enqueue_styles',  'vsw_enqueue_google_fonts' );

// ── Register plugin assets ─────────────────────────────────────────────────────
function vsw_register_assets() {
    wp_register_style(
        'vesara-widgets-style',
        VSW_URL . 'assets/css/vesara-widgets.css',
        [ 'vesara-google-fonts' ],
        VSW_VERSION
    );
    wp_register_script(
        'vesara-banner-script',
        VSW_URL . 'assets/js/vesara-banner.js',
        [ 'jquery' ],
        VSW_VERSION,
        true   // load in footer
    );
}
add_action( 'wp_enqueue_scripts',                'vsw_register_assets' );
add_action( 'elementor/preview/enqueue_styles',  'vsw_register_assets' );
add_action( 'elementor/preview/enqueue_scripts', 'vsw_register_assets' );

// ── Register custom Elementor widget category ──────────────────────────────────
function vsw_register_category( $elements_manager ) {
    $elements_manager->add_category( 'vesara-silks', [
        'title' => esc_html__( 'Vesara Silks', 'vesara-silks-widgets' ),
        'icon'  => 'fa fa-gem',
    ] );
}
add_action( 'elementor/elements/categories_registered', 'vsw_register_category' );

// ── Register all 7 widgets ─────────────────────────────────────────────────────
function vsw_register_widgets( $widgets_manager ) {
    $widgets = [
        'widget-banner',
        'widget-about-hero',
        'widget-our-promise',
        'widget-our-purpose',
        'widget-our-approach',
        'widget-thought-behind',
        'widget-about-vesara',
    ];
    foreach ( $widgets as $file ) {
        require_once VSW_PATH . 'widgets/' . $file . '.php';
    }
    $widgets_manager->register( new \Vesara_Silks\Widgets\Banner_Widget() );
    $widgets_manager->register( new \Vesara_Silks\Widgets\About_Hero_Widget() );
    $widgets_manager->register( new \Vesara_Silks\Widgets\Our_Promise_Widget() );
    $widgets_manager->register( new \Vesara_Silks\Widgets\Our_Purpose_Widget() );
    $widgets_manager->register( new \Vesara_Silks\Widgets\Our_Approach_Widget() );
    $widgets_manager->register( new \Vesara_Silks\Widgets\Thought_Behind_Widget() );
    $widgets_manager->register( new \Vesara_Silks\Widgets\About_Vesara_Widget() );
}
add_action( 'elementor/widgets/register', 'vsw_register_widgets' );
