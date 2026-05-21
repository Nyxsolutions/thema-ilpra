<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_get_production_cleanup_field_keys(): array
{
    return [
        // Confezionatrici
        'field_6241b2d47d285',
        'field_629720064fad4',
        'field_629721064fad5',
        'field_629721414fad6',
        'field_629721994fad7',
        'field_629721d24fad8',
        'field_629722084fad9',
        'field_6297223f4fada',
        'field_629722744fadb',
        'field_62a070c2f2908',
        'field_62a0710cf2909',
        'field_62a07148f290a',
        'field_62a07184f290b',
        'field_62ab26018c6a4',
        'field_62ab26128c6a5',
        'field_62ab269b8c6a6',
        'field_62ab26cf8c6a7',
        'field_65cf3c502ad0d',
        'field_67289283565a6',
        'field_65cf72e097f76',
        'field_65cf65f0bade4',
        'field_65cf3c722ad0e',
        'field_65cf6610bade5',
        'field_65d613c941976',
        'field_65d6138d0d5bd',
        'field_65d6161c3ddc6',
        'field_65d616273ddc7',

        // Categoria Confezionatrici
        'field_6250399ac4c26',
        'field_6263e109d5b9e',
        'field_6241d6f759968',
        'field_6241d73b59969',
        'field_62baab602e285',
        'field_62baabc22e286',
        'field_62baabe52e287',
        'field_62baabfa2e288',
        'field_639314c9df505',
        'field_6397164130f99',
        'field_65cc896cf612c',
        'field_65cc8995f612d',
        'field_65cc8998f612e',
        'field_65cc899af612f',
        'field_65cc899cf6130',
        'field_65cc89a0f6131',

        // Categoria Alimentari e Medicali
        'field_62c2d939ea4a9',
        'field_62c2d992d1324',
        'field_62c2ddc110a4b',
        'field_62c2de0510a4c',
        'field_62c2de8d9df03',
        'field_62c2deac9df04',
        'field_62c2dec79df05',
        'field_62c2df0901937',
        'field_62c2df1d01938',
        'field_62c2df2301939',
    ];
}

function ilpra_2026_get_production_cleanup_postmeta_keys(): array
{
    return [
        'colore_della_serie',
        'ciclo_sealing',
        'ciclo_gas_flush',
        'ciclo_map_atp',
        'ciclo_vacuum',
        'ciclo_skin',
        'ciclo_over_skin',
        'ciclo_extraskin',
        'ciclo_extraskin_on_cardboard',
        'ciclo_gas_flush_fill',
        'ciclo_map_atp_fill',
        'ciclo_vacuum_fill',
        'ciclo_sealing_fill',
        'ciclo_sealing_form',
        'ciclo_map_atp_form',
        'ciclo_vacuum_form',
        'ciclo_skin_form',
        'link_ilpra_group',
        'crosslink_heading',
        'manual_population',
        'packaging_details',
        'technical_details',
    ];
}

function ilpra_2026_get_production_cleanup_postmeta_prefixes(): array
{
    return [
        'crosslink_6_repeater',
        'crosslink_6_repeater_manual',
    ];
}

function ilpra_2026_get_production_cleanup_termmeta_keys(): array
{
    return [
        'descrizione_categoria_confezionatrici',
        'immagine_categoria',
        'colore_della_categoria_conf',
        'colore_della_categoria',
        'serie_categoria',
        'valore_tab_1',
        'valore_tab_2',
        'valore_tab_3',
        'valore_tab_4',
        'valore_tab_5',
        'valore_tab_6',
        'tabs_serie_valore_tab_1',
        'tabs_serie_valore_tab_2',
        'tabs_serie_valore_tab_3',
        'tabs_serie_valore_tab_4',
        'tabs_serie_valore_tab_5',
        'tabs_serie_valore_tab_6',
        'description_for_tab_1',
        'description_for_tab_2',
        'description_for_tab_3',
        'description_for_tab_4',
        'description_for_tab_5',
        'description_for_tab_6',
        'etichetta_tipo_di_confezione_uno',
        'immagine_tipo_di_confezione_uno',
        'descrizione__tipo_di_confezione_uno',
        'etichetta_tipo_di_confezione_due',
        'immagine_tipo_di_confezione_due',
        'descrizione_tipo_di_confezione_due',
        'etichetta_tipo_di_confezione_tre',
        'immagine_tipo_di_confezione_tre',
        'descrizione_tipo_di_confezione_tre',
    ];
}

function ilpra_2026_delete_meta_keys(string $table, array $keys): int
{
    global $wpdb;

    $deleted_rows = 0;

    foreach ($keys as $key) {
        $deleted_rows += (int) $wpdb->delete($table, ['meta_key' => $key], ['%s']);
        $deleted_rows += (int) $wpdb->delete($table, ['meta_key' => '_' . $key], ['%s']);
    }

    return $deleted_rows;
}

function ilpra_2026_delete_meta_prefixes(string $table, array $prefixes): int
{
    global $wpdb;

    $deleted_rows = 0;

    foreach ($prefixes as $prefix) {
        $deleted_rows += (int) $wpdb->query(
            $wpdb->prepare("DELETE FROM {$table} WHERE meta_key LIKE %s", $wpdb->esc_like($prefix) . '%')
        );
        $deleted_rows += (int) $wpdb->query(
            $wpdb->prepare("DELETE FROM {$table} WHERE meta_key LIKE %s", $wpdb->esc_like('_' . $prefix) . '%')
        );
    }

    return $deleted_rows;
}

function ilpra_2026_run_production_acf_cleanup(bool $force = false): array
{
    if (!$force && get_option('ilpra_2026_production_acf_cleanup_v1') === 'done') {
        return [
            'status' => 'skipped',
            'fields_deleted' => 0,
            'postmeta_deleted' => 0,
            'termmeta_deleted' => 0,
            'message' => 'La pulizia era gia stata eseguita.',
        ];
    }

    global $wpdb;

    $result = [
        'status' => 'done',
        'fields_deleted' => 0,
        'postmeta_deleted' => 0,
        'termmeta_deleted' => 0,
        'message' => 'Pulizia ACF/DB eseguita correttamente.',
    ];

    if (function_exists('acf_get_field') && function_exists('acf_delete_field')) {
        foreach (ilpra_2026_get_production_cleanup_field_keys() as $field_key) {
            $field = acf_get_field($field_key);

            if (!$field) {
                continue;
            }

            if (acf_delete_field($field_key)) {
                $result['fields_deleted']++;
            }
        }
    } else {
        $result['status'] = 'warning';
        $result['message'] = 'ACF non disponibile: puliti solo i meta DB.';
    }

    $result['postmeta_deleted'] += ilpra_2026_delete_meta_keys($wpdb->postmeta, ilpra_2026_get_production_cleanup_postmeta_keys());
    $result['postmeta_deleted'] += ilpra_2026_delete_meta_prefixes($wpdb->postmeta, ilpra_2026_get_production_cleanup_postmeta_prefixes());

    $result['termmeta_deleted'] += ilpra_2026_delete_meta_keys($wpdb->termmeta, ilpra_2026_get_production_cleanup_termmeta_keys());

    update_option('ilpra_2026_production_acf_cleanup_v1', 'done', false);

    return $result;
}

add_action('admin_init', static function (): void {
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }

    $trigger = isset($_GET['ilpra_run_acf_cleanup']) ? sanitize_key(wp_unslash((string) $_GET['ilpra_run_acf_cleanup'])) : '';

    if ($trigger !== '1') {
        return;
    }

    $result = ilpra_2026_run_production_acf_cleanup();
    set_transient('ilpra_2026_production_acf_cleanup_result_' . get_current_user_id(), $result, MINUTE_IN_SECONDS * 5);

    $redirect_url = remove_query_arg(['ilpra_run_acf_cleanup']);
    $redirect_url = add_query_arg('ilpra_acf_cleanup', $result['status'], $redirect_url);

    wp_safe_redirect($redirect_url);
    exit;
});

add_action('admin_notices', static function (): void {
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }

    if (!isset($_GET['ilpra_acf_cleanup'])) {
        return;
    }

    $result = get_transient('ilpra_2026_production_acf_cleanup_result_' . get_current_user_id());

    if (!is_array($result)) {
        return;
    }

    delete_transient('ilpra_2026_production_acf_cleanup_result_' . get_current_user_id());

    $notice_class = $result['status'] === 'warning' ? 'notice-warning' : 'notice-success';
    ?>
    <div class="notice <?php echo esc_attr($notice_class); ?> is-dismissible">
        <p><?php echo esc_html($result['message']); ?></p>
        <p>
            <?php
            echo esc_html(
                sprintf(
                    'Field ACF rimossi: %d | Postmeta rimossi: %d | Termmeta rimossi: %d',
                    (int) $result['fields_deleted'],
                    (int) $result['postmeta_deleted'],
                    (int) $result['termmeta_deleted']
                )
            );
            ?>
        </p>
    </div>
    <?php
});
