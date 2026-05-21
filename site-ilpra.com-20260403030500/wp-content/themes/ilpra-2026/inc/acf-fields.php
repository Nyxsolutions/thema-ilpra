<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', static function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_ilpra_2026_packaging_machine_links',
        'title' => 'Packaging Machine Links',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_external_product_url',
                'label' => 'External Product URL',
                'name' => 'external_product_url',
                'type' => 'url',
                'instructions' => 'Se compilato, il pulsante "View Product" nelle liste aprira questo URL in una nuova scheda.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => 'https://example.com/',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'packaging_machine',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ]);

    acf_add_local_field_group([
        'key' => 'group_ilpra_2026_packaging_machine_technology',
        'title' => 'Packaging Machine Technology',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_technology_modal_description',
                'label' => 'Modal Description',
                'name' => 'technology_modal_description',
                'type' => 'wysiwyg',
                'instructions' => 'Testo mostrato nella lightbox informativa della tecnologia. Se vuoto, il tema usera il fallback storico dove presente.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'tecnologia_confezionatrice',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ]);

    acf_add_local_field_group([
        'key' => 'group_ilpra_2026_packaging_machine_category',
        'title' => 'Packaging Machine Category',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_category_modal_description',
                'label' => 'Parent Modal Description',
                'name' => 'category_modal_description',
                'type' => 'wysiwyg',
                'instructions' => 'Testo mostrato nella lightbox informativa della categoria padre. Se vuoto, il tema usera la Description standard di WordPress come fallback.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_category_technology_modal_items',
                'label' => 'Technology Modal Descriptions',
                'name' => 'category_technology_modal_items',
                'type' => 'repeater',
                'instructions' => 'Descrizioni lightbox specifiche per ogni voce del sottomenu tecnologia di questa categoria.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'layout' => 'row',
                'button_label' => 'Add Technology Description',
                'sub_fields' => [
                    [
                        'key' => 'field_ilpra_2026_category_technology_modal_term',
                        'label' => 'Technology',
                        'name' => 'technology_term',
                        'type' => 'taxonomy',
                        'taxonomy' => 'tecnologia_confezionatrice',
                        'field_type' => 'select',
                        'return_format' => 'id',
                        'add_term' => 0,
                        'save_terms' => 0,
                        'load_terms' => 0,
                        'allow_null' => 0,
                        'multiple' => 0,
                    ],
                    [
                        'key' => 'field_ilpra_2026_category_technology_modal_description',
                        'label' => 'Modal Description',
                        'name' => 'modal_description',
                        'type' => 'wysiwyg',
                        'tabs' => 'visual',
                        'toolbar' => 'basic',
                        'media_upload' => 0,
                        'delay' => 0,
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'taxonomy',
                    'operator' => '==',
                    'value' => 'tipologia_confezionatrice',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ]);

});

function ilpra_2026_run_category_modal_migration(bool $force = false): void
{
    if (!function_exists('update_field') || !function_exists('get_field')) {
        return;
    }

    if (!$force && get_option('ilpra_2026_category_modal_migration_v1') === 'done') {
        return;
    }

    $category_terms = get_terms([
        'taxonomy' => 'tipologia_confezionatrice',
        'hide_empty' => false,
        'orderby' => 'term_order',
        'order' => 'ASC',
    ]);

    if (is_wp_error($category_terms) || empty($category_terms)) {
        return;
    }

    $all_technology_terms = get_terms([
        'taxonomy' => 'tecnologia_confezionatrice',
        'hide_empty' => false,
        'orderby' => 'term_order',
        'order' => 'ASC',
    ]);

    if (is_wp_error($all_technology_terms)) {
        return;
    }

    foreach ($category_terms as $category_term) {
        $existing_rows = get_field('category_technology_modal_items', 'term_' . $category_term->term_id);

        if (!empty($existing_rows)) {
            continue;
        }

        $legacy_descriptions = [];

        for ($index = 1; $index <= 6; $index++) {
            $legacy_value = (string) get_term_meta($category_term->term_id, 'description_for_tab_' . $index, true);

            if (trim($legacy_value) !== '') {
                $legacy_descriptions[$index] = $legacy_value;
            }
        }

        if (empty($legacy_descriptions)) {
            continue;
        }

        $machine_ids = get_posts([
            'post_type' => 'packaging_machine',
            'posts_per_page' => -1,
            'fields' => 'ids',
            'tax_query' => [
                [
                    'taxonomy' => 'tipologia_confezionatrice',
                    'field' => 'term_id',
                    'terms' => $category_term->term_id,
                ],
            ],
        ]);

        $technology_terms = array_values(array_filter($all_technology_terms, static function ($term) use ($machine_ids): bool {
            foreach ($machine_ids as $machine_id) {
                $tech = get_field('tecnologia_confezionatrice', $machine_id);

                if (
                    (is_array($tech) && in_array($term->term_id, $tech, true)) ||
                    (is_object($tech) && isset($tech->term_id) && (int) $tech->term_id === (int) $term->term_id) ||
                    ((int) $tech === (int) $term->term_id)
                ) {
                    return true;
                }
            }

            return false;
        }));

        if (empty($technology_terms)) {
            continue;
        }

        $rows = [];

        foreach ($legacy_descriptions as $position => $legacy_description) {
            $technology_term = $technology_terms[$position - 1] ?? null;

            if (!$technology_term instanceof WP_Term) {
                continue;
            }

            $rows[] = [
                'field_ilpra_2026_category_technology_modal_term' => (int) $technology_term->term_id,
                'field_ilpra_2026_category_technology_modal_description' => $legacy_description,
            ];
        }

        if (!empty($rows)) {
            update_field('field_ilpra_2026_category_technology_modal_items', $rows, 'term_' . $category_term->term_id);
        }
    }

    update_option('ilpra_2026_category_modal_migration_v1', 'done', false);
}

add_action('acf/init', static function (): void {
    ilpra_2026_run_category_modal_migration();
}, 20);

add_action('admin_init', static function (): void {
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }

    $trigger = isset($_GET['ilpra_run_lightbox_migration']) ? sanitize_key(wp_unslash((string) $_GET['ilpra_run_lightbox_migration'])) : '';

    if ($trigger !== '1') {
        return;
    }

    delete_option('ilpra_2026_category_modal_migration_v1');
    ilpra_2026_run_category_modal_migration(true);

    $redirect_url = remove_query_arg(['ilpra_run_lightbox_migration']);
    $redirect_url = add_query_arg('ilpra_lightbox_migration', 'done', $redirect_url);

    wp_safe_redirect($redirect_url);
    exit;
});

add_action('admin_notices', static function (): void {
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }

    if (!isset($_GET['ilpra_lightbox_migration']) || wp_unslash((string) $_GET['ilpra_lightbox_migration']) !== 'done') {
        return;
    }
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php esc_html_e('Lightbox migration eseguita correttamente.', 'ilpra-2026'); ?></p>
    </div>
    <?php
});
