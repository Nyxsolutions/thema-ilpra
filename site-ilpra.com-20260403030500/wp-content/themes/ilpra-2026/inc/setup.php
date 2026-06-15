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
    if ($post_type === 'packaging_machine') {
        // Il CPT arriva da una registrazione esterna con una vecchia URL remota come icona.
        // Forziamo una dashicon locale stabile per evitare menu senza icona nel backend.
        $args['menu_icon'] = 'dashicons-hammer';
    }

    if (!ilpra_2026_use_custom_post_type_slugs()) {
        return $args;
    }

    if ($post_type === 'packaging_machine') {
        $rewrite_slug = ilpra_2026_get_post_type_rewrite_slug('packaging_machine', 'packaging-machines');
        $archive_slug = ilpra_2026_get_post_type_archive_slug('packaging_machine', $rewrite_slug);

        $args['rewrite'] = is_array($args['rewrite'] ?? null) ? $args['rewrite'] : [];
        $args['rewrite']['slug'] = $rewrite_slug;
        $args['has_archive'] = $archive_slug;
    }

    if ($post_type === 'careers') {
        $rewrite_slug = ilpra_2026_get_post_type_rewrite_slug('careers', 'careers');
        $archive_slug = ilpra_2026_get_post_type_archive_slug('careers', $rewrite_slug);

        $args['rewrite'] = is_array($args['rewrite'] ?? null) ? $args['rewrite'] : [];
        $args['rewrite']['slug'] = $rewrite_slug;
        $args['has_archive'] = $archive_slug;
    }

    return $args;
}, 20, 2);

add_filter('register_taxonomy_args', static function (array $args, string $taxonomy): array {
    if (!ilpra_2026_use_custom_post_type_slugs()) {
        return $args;
    }

    $rewrite_slug = ilpra_2026_get_taxonomy_rewrite_slug($taxonomy, '');

    if ($rewrite_slug === '') {
        return $args;
    }

    $args['rewrite'] = is_array($args['rewrite'] ?? null) ? $args['rewrite'] : [];
    $args['rewrite']['slug'] = $rewrite_slug;

    return $args;
}, 20, 2);

function ilpra_2026_register_machine_series_route(): void
{
    if (!ilpra_2026_use_custom_post_type_slugs()) {
        return;
    }

    $series_slug = trim(ilpra_2026_get_machine_series_taxonomy_slug(), '/');

    if ($series_slug === '') {
        return;
    }

    // Quando la pagina overview usa la stessa base della tassonomia
    // (es. /macchine-confezionatrici/), forziamo esplicitamente il segmento
    // successivo verso l'archivio di tassonomia invece che verso una child page.
    add_rewrite_rule(
        '^' . preg_quote($series_slug, '#') . '/(.+?)/?$',
        'index.php?tipologia_confezionatrice=$matches[1]',
        'top'
    );
}
add_action('init', 'ilpra_2026_register_machine_series_route', 6);

add_filter('term_link', static function (string $termlink, $term, string $taxonomy): string {
    if (!$term instanceof WP_Term || $taxonomy !== 'tipologia_confezionatrice' || !ilpra_2026_use_custom_post_type_slugs()) {
        return $termlink;
    }

    $series_slug = trim(ilpra_2026_get_machine_series_taxonomy_slug(), '/');

    if ($series_slug === '') {
        return $termlink;
    }

    return home_url('/' . $series_slug . '/' . $term->slug . '/');
}, 20, 3);

add_action('init', static function (): void {
    $rewrite_version = 'ilpra-2026-custom-taxonomy-route-' . ilpra_2026_get_slug_config_hash();

    if (get_option('ilpra_2026_machine_series_rewrite_version') === $rewrite_version) {
        return;
    }

    ilpra_2026_register_machine_series_route();
    flush_rewrite_rules(false);
    update_option('ilpra_2026_machine_series_rewrite_version', $rewrite_version, false);
}, 21);
