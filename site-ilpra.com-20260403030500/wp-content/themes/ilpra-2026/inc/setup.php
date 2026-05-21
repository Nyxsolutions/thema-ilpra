<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('after_setup_theme', function (): void {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    register_nav_menus([
        'primary' => __('Primary Navigation', 'ilpra-2026'),
        'footer' => __('Footer Navigation', 'ilpra-2026'),
    ]);
});

add_action('widgets_init', function (): void {
    $sidebars = [
        'footer-widget-1' => __('Footer Widget 1', 'ilpra-2026'),
        'footer-widget-2' => __('Footer Widget 2', 'ilpra-2026'),
        'footer-widget-3' => __('Footer Widget 3', 'ilpra-2026'),
        'footer-widget-4' => __('Footer Widget 4', 'ilpra-2026'),
        'footer-widget-5' => __('Footer Widget 5', 'ilpra-2026'),
    ];

    foreach ($sidebars as $id => $name) {
        register_sidebar([
            'name' => $name,
            'id' => $id,
            'before_widget' => '<div class="widget %2$s" id="%1$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        ]);
    }
});

add_filter('register_post_type_args', static function (array $args, string $post_type): array {
    if ($post_type !== 'packaging_machine') {
        return $args;
    }

    // Il CPT arriva da una registrazione esterna con una vecchia URL remota come icona.
    // Forziamo una dashicon locale stabile per evitare menu senza icona nel backend.
    $args['menu_icon'] = 'dashicons-hammer';

    return $args;
}, 20, 2);
