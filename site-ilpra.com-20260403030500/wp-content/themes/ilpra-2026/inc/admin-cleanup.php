<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Tassonomie legacy ancora assegnate ai prodotti ma non lette dal tema nuovo.
 * Per ora le nascondiamo dal backend per evitare errori editoriali.
 */
function ilpra_2026_get_hidden_legacy_taxonomies(): array
{
    return [
        'tipologie_confezionatrici',
        'gruppo_confezionatrice',
    ];
}

function ilpra_2026_get_hidden_legacy_acf_fields(): array
{
    return [];
}

function ilpra_2026_get_hidden_taxonomy_acf_fields_map(): array
{
    return [];
}

function ilpra_2026_get_compact_acf_tab_labels(): array
{
    return [
        'field_623f40b7a3498' => 'Dettagli',
    ];
}

function ilpra_2026_get_hidden_legacy_acf_tab_keys(): array
{
    return [
        'field_623f4258b0440', // 2° Dettaglio
        'field_623f43393c98b', // 3° Dettaglio
        'field_623f43453c98c', // 4° Dettaglio
    ];
}

function ilpra_2026_get_current_admin_post_type(): string
{
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;

    if ($screen && !empty($screen->post_type)) {
        return (string) $screen->post_type;
    }

    if (isset($_GET['post'])) {
        $post_type = get_post_type((int) $_GET['post']);

        if ($post_type) {
            return (string) $post_type;
        }
    }

    if (isset($_POST['post_ID'])) {
        $post_type = get_post_type((int) $_POST['post_ID']);

        if ($post_type) {
            return (string) $post_type;
        }
    }

    if (isset($_GET['post_type'])) {
        return sanitize_key(wp_unslash((string) $_GET['post_type']));
    }

    if (isset($_POST['post_type'])) {
        return sanitize_key(wp_unslash((string) $_POST['post_type']));
    }

    return '';
}

add_action('admin_menu', static function (): void {
    $parent_slug = 'edit.php?post_type=packaging_machine';

    foreach (ilpra_2026_get_hidden_legacy_taxonomies() as $taxonomy) {
        remove_submenu_page(
            $parent_slug,
            sprintf('edit-tags.php?taxonomy=%s&post_type=packaging_machine', $taxonomy)
        );
    }
}, 99);

add_action('add_meta_boxes_packaging_machine', static function (): void {
    foreach (ilpra_2026_get_hidden_legacy_taxonomies() as $taxonomy) {
        remove_meta_box($taxonomy . 'div', 'packaging_machine', 'side');
        remove_meta_box('tagsdiv-' . $taxonomy, 'packaging_machine', 'side');
    }
}, 99);

add_filter('acf/prepare_field', static function ($field) {
    if (!is_array($field)) {
        return $field;
    }

    if (ilpra_2026_get_current_admin_post_type() !== 'packaging_machine') {
        return $field;
    }

    if (!empty($field['key']) && in_array($field['key'], ilpra_2026_get_hidden_legacy_acf_tab_keys(), true)) {
        return false;
    }

    if (empty($field['name'])) {
        return $field;
    }

    if (in_array($field['name'], ilpra_2026_get_hidden_legacy_acf_fields(), true)) {
        return false;
    }

    return $field;
}, 99);

add_filter('acf/prepare_field', static function ($field) {
    if (!is_array($field) || empty($field['name'])) {
        return $field;
    }

    $taxonomy = '';

    if (isset($_GET['taxonomy'])) {
        $taxonomy = sanitize_key(wp_unslash((string) $_GET['taxonomy']));
    } elseif (isset($_POST['taxonomy'])) {
        $taxonomy = sanitize_key(wp_unslash((string) $_POST['taxonomy']));
    }

    if ($taxonomy === '') {
        return $field;
    }

    $hidden_fields_map = ilpra_2026_get_hidden_taxonomy_acf_fields_map();
    $hidden_fields = $hidden_fields_map[$taxonomy] ?? [];

    if (empty($hidden_fields) || !in_array($field['name'], $hidden_fields, true)) {
        return $field;
    }

    return false;
}, 99);

add_filter('acf/prepare_field', static function ($field) {
    if (!is_array($field) || empty($field['key'])) {
        return $field;
    }

    $compact_labels = ilpra_2026_get_compact_acf_tab_labels();

    if (!isset($compact_labels[$field['key']])) {
        return $field;
    }

    if (ilpra_2026_get_current_admin_post_type() !== 'packaging_machine') {
        return $field;
    }

    $field['label'] = $compact_labels[$field['key']];

    return $field;
}, 99);

add_action('admin_head', static function (): void {
    $screen = function_exists('get_current_screen') ? get_current_screen() : null;

    if (!$screen) {
        return;
    }

    $is_packaging_machine_screen = $screen->post_type === 'packaging_machine';
    $is_taxonomy_edit_screen = $screen->base === 'term' && !empty($screen->taxonomy);

    if (!$is_packaging_machine_screen && !$is_taxonomy_edit_screen) {
        return;
    }
    ?>
    <style>
      <?php if ($is_packaging_machine_screen) : ?>
      .post-type-packaging_machine .acf-tab-wrap.-top .acf-hl.acf-tab-group {
        gap: 4px;
      }

      .post-type-packaging_machine .acf-tab-wrap.-top .acf-tab-button {
        padding: 10px 12px;
        font-size: 13px;
        line-height: 1.15;
      }
      <?php endif; ?>

      <?php if ($is_taxonomy_edit_screen) : ?>
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .wrap > form,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> #edittag,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-wrap,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .term-notes-wrap {
        max-width: none;
      }

      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table {
        width: min(100%, 1320px);
      }

      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table th {
        width: 220px;
      }

      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td .acf-fields,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td .acf-field,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td .acf-input,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td .acf-input-wrap,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td input[type="text"],
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td input[type="url"],
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td input[type="number"],
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td textarea,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td select {
        max-width: none;
      }

      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td textarea,
      .taxonomy-<?php echo esc_html($screen->taxonomy); ?> .form-table td .acf-editor-wrap iframe {
        min-height: 180px;
      }
      <?php endif; ?>
    </style>
    <?php
});
