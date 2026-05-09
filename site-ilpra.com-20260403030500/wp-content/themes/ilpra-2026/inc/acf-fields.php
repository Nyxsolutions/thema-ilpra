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
});
