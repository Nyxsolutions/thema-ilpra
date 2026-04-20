<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_site_header_classes(): string
{
    $classes = ['site-header'];

    if (is_front_page()) {
        $classes[] = 'site-header--front-page';
    }

    return implode(' ', $classes);
}

function ilpra_2026_get_logo_url(bool $compact = false): string
{
    return home_url('/wp-content/uploads/2025/01/ILPRA-70.svg');
}

function ilpra_2026_get_logo_alt(): string
{
    return get_bloginfo('name');
}

function ilpra_2026_render_primary_navigation(): void
{
    $locations = get_nav_menu_locations();
    $menu_id = $locations['primary'] ?? 0;

    if (!$menu_id) {
        return;
    }

    $items = wp_get_nav_menu_items($menu_id, ['update_post_term_cache' => false]);

    if (empty($items)) {
        return;
    }

    $tree = ilpra_2026_build_menu_tree($items);

    echo '<ul class="site-nav__menu">';
    ilpra_2026_render_menu_level($tree, 0);
    echo '</ul>';
}

function ilpra_2026_render_footer_navigation(): void
{
    wp_nav_menu([
        'theme_location' => 'footer',
        'menu' => 'Footer Menu',
        'container' => false,
        'menu_class' => 'site-footer__menu',
        'fallback_cb' => false,
    ]);
}

function ilpra_2026_get_legacy_footer_widget_map(): array
{
    return [
        'footer-widget-1' => [2],
        'footer-widget-2' => [3],
        'footer-widget-3' => [4],
        'footer-widget-4' => [5],
        'footer-widget-5' => [6],
    ];
}

function ilpra_2026_render_legacy_custom_html_widget(int $widget_id): void
{
    $widgets = get_option('widget_custom_html');

    if (empty($widgets[$widget_id]['content'])) {
        return;
    }

    echo '<section class="widget widget_custom_html widget_custom_html--legacy">';
    echo '<div class="textwidget custom-html-widget">';
    echo do_shortcode((string) $widgets[$widget_id]['content']);
    echo '</div>';
    echo '</section>';
}

function ilpra_2026_render_footer_sidebar(string $sidebar_id): void
{
    if (is_active_sidebar($sidebar_id)) {
        dynamic_sidebar($sidebar_id);
    }

    $map = ilpra_2026_get_legacy_footer_widget_map();

    if (empty($map[$sidebar_id])) {
        return;
    }

    foreach ($map[$sidebar_id] as $widget_id) {
        ilpra_2026_render_legacy_custom_html_widget((int) $widget_id);
    }
}

function ilpra_2026_is_elementor_built(?int $post_id = null): bool
{
    $post_id = $post_id ?: get_the_ID();

    if (!$post_id) {
        return false;
    }

    if (!did_action('elementor/loaded')) {
        return false;
    }

    if (!class_exists('\Elementor\Plugin')) {
        return false;
    }

    return \Elementor\Plugin::$instance->documents->get($post_id)?->is_built_with_elementor() ?? false;
}

function ilpra_2026_build_menu_tree(array $items): array
{
    $indexed = [];
    $tree = [];

    foreach ($items as $item) {
        $item->children = [];
        $indexed[$item->ID] = $item;
    }

    foreach ($indexed as $item) {
        $parent_id = (int) $item->menu_item_parent;

        if ($parent_id && isset($indexed[$parent_id])) {
            $indexed[$parent_id]->children[] = $item;
            continue;
        }

        $tree[] = $item;
    }

    return $tree;
}

function ilpra_2026_get_language_flag_map(): array
{
    $base = get_template_directory_uri() . '/assets/img/flags';

    return [
        'us-flag' => $base . '/uk.svg',
        'italian-flag' => $base . '/italy.svg',
        'spain-flag' => $base . '/spain.svg',
        'france-flag' => $base . '/france.svg',
    ];
}

function ilpra_2026_get_weglot_language_entry(string $language_code): ?object
{
    if (!function_exists('weglot_get_languages_available')) {
        return null;
    }

    foreach ((array) weglot_get_languages_available() as $language) {
        if (!is_object($language) || !method_exists($language, 'getInternalCode')) {
            continue;
        }

        $internal_code = (string) $language->getInternalCode();
        $external_code = method_exists($language, 'getExternalCode') ? (string) $language->getExternalCode() : '';

        if ($internal_code === $language_code || $external_code === $language_code) {
            return $language;
        }
    }

    return null;
}

function ilpra_2026_get_weglot_switch_url(string $language_code): string
{
    if (
        !function_exists('weglot_get_request_url_service') ||
        !function_exists('weglot_create_url_object')
    ) {
        return '';
    }

    $language_entry = ilpra_2026_get_weglot_language_entry($language_code);

    if (!$language_entry) {
        return '';
    }

    try {
        $request_service = weglot_get_request_url_service();
        $current_full_url = $request_service->get_full_url();
        $url_object = weglot_create_url_object($current_full_url);
        $translated_url = $url_object->getForLanguage($language_entry);

        return is_string($translated_url) ? $translated_url : '';
    } catch (Throwable $exception) {
        return '';
    }
}

function ilpra_2026_render_menu_level(array $items, int $depth = 0): void
{
    foreach ($items as $item) {
        $classes = array_filter((array) $item->classes);
        $has_children = !empty($item->children);
        $is_group = in_array('ilpra-group', $classes, true);
        $is_search = in_array('search_ajax', $classes, true) || in_array('hide_search', $classes, true);
        $is_language = in_array('language-selector', $classes, true);

        $item_classes = ['site-nav__item', 'site-nav__item--depth-' . $depth];

        if ($has_children) {
            $item_classes[] = 'site-nav__item--has-children';
        }

        if ($is_group) {
            $item_classes[] = 'site-nav__item--group';
        }

        if ($is_search) {
            $item_classes[] = 'site-nav__item--search';
        }

        if ($is_language) {
            $item_classes[] = 'site-nav__item--language';
        }

        echo '<li class="' . esc_attr(implode(' ', $item_classes)) . '">';

        if ($is_language) {
            ilpra_2026_render_language_menu_item($item, $classes);
        } else {
            $label_classes = ['site-nav__link'];

            if ($is_group) {
                $label_classes[] = 'site-nav__link--group';
            }

            if ($is_search) {
                $label_classes[] = 'site-nav__link--search';
            }

            echo '<a class="' . esc_attr(implode(' ', $label_classes)) . '" href="' . esc_url($item->url ?: '#') . '">';

            if ($is_search) {
                echo '<span class="site-nav__search-icon" aria-hidden="true"></span>';
            } else {
                echo '<span class="site-nav__label">' . wp_kses_post($item->title) . '</span>';
            }

            if ($has_children && $depth === 0) {
                echo '<span class="site-nav__caret" aria-hidden="true"></span>';
            }

            echo '</a>';
        }

        if ($has_children) {
            echo '<button class="site-nav__submenu-toggle" type="button" aria-expanded="false">';
            echo '<span class="site-nav__caret" aria-hidden="true"></span>';
            echo '</button>';
            echo '<ul class="site-nav__submenu">';
            ilpra_2026_render_menu_level($item->children, $depth + 1);
            echo '</ul>';
        }

        echo '</li>';
    }
}

function ilpra_2026_render_language_menu_item(object $item, array $classes): void
{
    $flags = ilpra_2026_get_language_flag_map();
    $flag_url = '';
    $link_url = (string) ($item->url ?: '#');
    $uses_weglot = false;

    foreach ($classes as $class_name) {
        if (!empty($flags[$class_name])) {
            $flag_url = $flags[$class_name];
            break;
        }
    }

    if (in_array('france-flag', $classes, true)) {
        $french_url = ilpra_2026_get_weglot_switch_url('fr');

        if ($french_url !== '') {
            $link_url = $french_url;
            $uses_weglot = true;
        }
    }

    if (
        !$uses_weglot &&
        in_array('us-flag', $classes, true) &&
        function_exists('weglot_get_current_language') &&
        weglot_get_current_language() === 'fr'
    ) {
        $english_url = ilpra_2026_get_weglot_switch_url('en');

        if ($english_url !== '') {
            $link_url = $english_url;
        }
    }

    echo '<a class="site-nav__link site-nav__link--language" href="' . esc_url($link_url) . '">';

    if ($flag_url !== '') {
        echo '<img class="site-nav__flag" src="' . esc_url($flag_url) . '" alt="' . esc_attr(wp_strip_all_tags($item->title)) . '">';
    } else {
        echo '<span class="site-nav__label">' . esc_html($item->title) . '</span>';
    }

    echo '</a>';
}

function ilpra_2026_get_social_icon_url(string $network): string
{
    $base = get_template_directory_uri() . '/assets/img/social';

    $icons = [
        'linkedin' => $base . '/linkedin.svg',
        'youtube' => $base . '/youtube.svg',
        'instagram' => $base . '/instagram.svg',
        'facebook' => $base . '/facebook.svg',
    ];

    return $icons[$network] ?? '';
}

function ilpra_2026_is_machine_search_request(): bool
{
    $scope = isset($_GET['ilpra_search_scope']) ? sanitize_text_field(wp_unslash((string) $_GET['ilpra_search_scope'])) : '';

    if ($scope === 'machines') {
        return true;
    }

    $requested_post_type = $_GET['post_type'] ?? '';

    if (is_array($requested_post_type)) {
        $requested_post_type = reset($requested_post_type) ?: '';
    }

    $requested_post_type = sanitize_key(wp_unslash((string) $requested_post_type));

    return in_array($requested_post_type, ['packaging_machine', 'packaging-machines'], true);
}

function ilpra_2026_get_current_search_term(): string
{
    $query_term = get_query_var('ilpra_search_term', '');

    if (is_string($query_term) && $query_term !== '') {
        return $query_term;
    }

    $request_term = $_GET['s'] ?? '';

    if (is_array($request_term)) {
        $request_term = reset($request_term) ?: '';
    }

    return sanitize_text_field(wp_unslash((string) $request_term));
}

function ilpra_2026_get_machine_search_tokens(string $search_term): array
{
    $normalized = strtolower(remove_accents(wp_strip_all_tags($search_term)));
    $tokens = preg_split('/[^[:alnum:]]+/u', $normalized) ?: [];

    $tokens = array_values(array_unique(array_filter($tokens, static function ($token): bool {
        return strlen((string) $token) >= 2;
    })));

    if (empty($tokens) && $normalized !== '') {
        $tokens[] = $normalized;
    }

    return $tokens;
}

function ilpra_2026_get_machine_search_ids(string $search_term): array
{
    global $wpdb;

    $tokens = ilpra_2026_get_machine_search_tokens($search_term);

    if (empty($tokens)) {
        return [];
    }

    $taxonomies = get_object_taxonomies('packaging_machine', 'names');
    $params = ['packaging_machine', 'publish'];
    $token_groups = [];

    foreach ($tokens as $token) {
        $like = '%' . $wpdb->esc_like($token) . '%';

        $group = [
            '(LOWER(p.post_title) LIKE %s OR LOWER(p.post_excerpt) LIKE %s OR LOWER(p.post_content) LIKE %s)',
            'EXISTS (
                SELECT 1
                FROM ' . $wpdb->postmeta . ' pm
                WHERE pm.post_id = p.ID
                    AND pm.meta_key NOT LIKE %s
                    AND LOWER(pm.meta_value) LIKE %s
            )',
        ];

        array_push($params, $like, $like, $like, '\_%', $like);

        if (!empty($taxonomies)) {
            $taxonomy_placeholders = implode(', ', array_fill(0, count($taxonomies), '%s'));

            $group[] = 'EXISTS (
                SELECT 1
                FROM ' . $wpdb->term_relationships . ' tr
                INNER JOIN ' . $wpdb->term_taxonomy . ' tt ON tt.term_taxonomy_id = tr.term_taxonomy_id
                INNER JOIN ' . $wpdb->terms . ' t ON t.term_id = tt.term_id
                WHERE tr.object_id = p.ID
                    AND tt.taxonomy IN (' . $taxonomy_placeholders . ')
                    AND (
                        LOWER(t.name) LIKE %s
                        OR LOWER(t.slug) LIKE %s
                        OR LOWER(tt.description) LIKE %s
                    )
            )';

            foreach ($taxonomies as $taxonomy) {
                $params[] = $taxonomy;
            }

            array_push($params, $like, $like, $like);
        }

        $token_groups[] = '(' . implode(' OR ', $group) . ')';
    }

    $sql = '
        SELECT DISTINCT p.ID
        FROM ' . $wpdb->posts . ' p
        WHERE p.post_type = %s
            AND p.post_status = %s
            AND ' . implode(' AND ', $token_groups) . '
        ORDER BY p.menu_order ASC, p.post_title ASC
    ';

    $prepared_sql = $wpdb->prepare($sql, $params);

    if (!$prepared_sql) {
        return [];
    }

    $ids = $wpdb->get_col($prepared_sql);

    return array_values(array_map('intval', array_unique($ids)));
}

add_action('pre_get_posts', static function (WP_Query $query): void {
    if (is_admin() || !$query->is_main_query() || !$query->is_search()) {
        return;
    }

    if (!ilpra_2026_is_machine_search_request()) {
        return;
    }

    $search_term = (string) $query->get('s');
    $machine_ids = ilpra_2026_get_machine_search_ids($search_term);

    $query->set('ilpra_search_term', $search_term);
    $query->set('s', '');
    $query->set('post_type', ['packaging_machine']);
    $query->set('post__in', empty($machine_ids) ? [0] : $machine_ids);
    $query->set('posts_per_page', 12);
    $query->set('orderby', 'post__in');
});
