<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_get_careers_listing_template_path(): string
{
    return get_template_directory() . '/templates/careers/page-careers.php';
}

function ilpra_2026_get_careers_single_template_path(): string
{
    return get_template_directory() . '/templates/careers/single-careers.php';
}

function ilpra_2026_is_careers_virtual_page(): bool
{
    return (bool) get_query_var('ilpra_careers_page');
}

function ilpra_2026_register_careers_route(): void
{
    add_rewrite_rule('^career/?$', 'index.php?ilpra_careers_page=1', 'top');
}
add_action('init', 'ilpra_2026_register_careers_route', 5);

add_filter('query_vars', static function (array $vars): array {
    $vars[] = 'ilpra_careers_page';
    return $vars;
});

add_filter('theme_page_templates', static function (array $templates): array {
    $templates['templates/careers/page-careers.php'] = 'Careers Listing';
    return $templates;
});

add_filter('template_include', static function (string $template): string {
    $listing_template = ilpra_2026_get_careers_listing_template_path();

    if (ilpra_2026_is_careers_virtual_page() && file_exists($listing_template)) {
        status_header(200);
        return $listing_template;
    }

    if (is_page() && get_page_template_slug() === 'templates/careers/page-careers.php' && file_exists($listing_template)) {
        return $listing_template;
    }

    return $template;
}, 99);

add_filter('single_template', static function (string $template): string {
    $single_template = ilpra_2026_get_careers_single_template_path();

    if (is_singular('careers') && file_exists($single_template)) {
        return $single_template;
    }

    return $template;
}, 99);

function ilpra_2026_enqueue_careers_assets(): void
{
    $theme_uri = get_template_directory_uri() . '/templates/careers/assets/css';
    $theme_path = get_template_directory() . '/templates/careers/assets/css';

    if ((ilpra_2026_is_careers_virtual_page() || is_page_template('templates/careers/page-careers.php')) && file_exists($theme_path . '/careers.css')) {
        wp_enqueue_style(
            'ilpra-2026-careers',
            $theme_uri . '/careers.css',
            [],
            (string) filemtime($theme_path . '/careers.css')
        );
    }

    if (is_singular('careers') && file_exists($theme_path . '/careers-single.css')) {
        wp_enqueue_style(
            'ilpra-2026-careers-single',
            $theme_uri . '/careers-single.css',
            [],
            (string) filemtime($theme_path . '/careers-single.css')
        );
    }
}
add_action('wp_enqueue_scripts', 'ilpra_2026_enqueue_careers_assets', 20);

add_action('init', static function (): void {
    $rewrite_version = 'ilpra-2026-careers-route-v1';

    if (get_option('ilpra_2026_rewrite_version') === $rewrite_version) {
        return;
    }

    ilpra_2026_register_careers_route();
    flush_rewrite_rules(false);
    update_option('ilpra_2026_rewrite_version', $rewrite_version, false);
}, 20);
