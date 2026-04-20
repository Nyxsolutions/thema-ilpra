<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('wp_enqueue_scripts', function (): void {
    $theme = wp_get_theme();

    wp_enqueue_style(
        'ilpra-2026-main',
        get_template_directory_uri() . '/assets/css/main.css',
        [],
        $theme->get('Version')
    );

    wp_enqueue_script(
        'ilpra-2026-main',
        get_template_directory_uri() . '/assets/js/main.js',
        [],
        $theme->get('Version'),
        true
    );

    if (is_page_template('sustainability.php')) {
        wp_enqueue_style(
            'ilpra-2026-sustainability',
            get_template_directory_uri() . '/assets/css/sustainability.css',
            ['ilpra-2026-main'],
            $theme->get('Version')
        );

        wp_enqueue_style(
            'ilpra-2026-sustainability-fontawesome',
            get_template_directory_uri() . '/sustainability/lib/css/font-awesome.css',
            [],
            $theme->get('Version')
        );

        wp_enqueue_script(
            'ilpra-2026-sustainability',
            get_template_directory_uri() . '/assets/js/sustainability.js',
            [],
            $theme->get('Version'),
            true
        );
    }
});
