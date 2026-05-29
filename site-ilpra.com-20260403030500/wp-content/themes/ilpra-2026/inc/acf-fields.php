<?php
if (!defined('ABSPATH')) {
    exit;
}

add_action('acf/init', static function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    if (function_exists('acf_add_options_page')) {
        acf_add_options_page([
            'page_title' => 'Stringhe Sito',
            'menu_title' => 'Stringhe Sito',
            'menu_slug' => 'ilpra-theme-strings',
            'capability' => 'edit_posts',
            'redirect' => false,
            'position' => 61,
            'icon_url' => 'dashicons-translation',
            'update_button' => 'Aggiorna stringhe',
            'updated_message' => 'Stringhe aggiornate',
        ]);

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
        'key' => 'group_ilpra_2026_theme_strings',
        'title' => 'Theme Strings',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_strings_tab_cta',
                'label' => 'Header',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_string_open_menu_label',
                'label' => 'Open Menu Label',
                'name' => 'string_open_menu_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label del bottone apertura menu.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Open menu',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_primary_navigation_label',
                'label' => 'Primary Navigation Label',
                'name' => 'string_primary_navigation_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label della navigazione principale.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Primary Navigation',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_search_packaging_machines_label',
                'label' => 'Search Packaging Machines Label',
                'name' => 'string_search_packaging_machines_label',
                'type' => 'text',
                'instructions' => 'Etichetta per il campo e il bottone di ricerca macchine.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Search packaging machines',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_machine_model_search_placeholder',
                'label' => 'Machine Model Search Placeholder',
                'name' => 'string_machine_model_search_placeholder',
                'type' => 'text',
                'instructions' => 'Placeholder del campo ricerca macchine.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Machine model search',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_strings_tab_header',
                'label' => 'CTA',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_string_contact_button_label',
                'label' => 'Contact Button Label',
                'name' => 'string_contact_button_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale per i pulsanti contatto.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Contact Us',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_cta_eyebrow',
                'label' => 'CTA Eyebrow',
                'name' => 'string_cta_eyebrow',
                'type' => 'text',
                'instructions' => 'Occhiello globale per le CTA finali.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Get in touch',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_cta_title',
                'label' => 'CTA Title',
                'name' => 'string_cta_title',
                'type' => 'text',
                'instructions' => 'Titolo globale per le CTA finali.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Speak to one of our experts',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_cta_text',
                'label' => 'CTA Text',
                'name' => 'string_cta_text',
                'type' => 'textarea',
                'instructions' => 'Testo globale per le CTA finali.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '100',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Get in touch with our team for tailored advice on which packaging solution is right for your products.',
                'rows' => 3,
                'new_lines' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_support_button_label',
                'label' => 'Support Button Label',
                'name' => 'string_support_button_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale per i pulsanti di supporto nelle pagine industry.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Need Help? Talk with us',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_strings_tab_buttons',
                'label' => 'Buttons',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_string_product_range_label',
                'label' => 'Product Range Button Label',
                'name' => 'string_product_range_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale fallback per i pulsanti serie confezionatrici.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'View Product Range',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_view_product_label',
                'label' => 'View Product Label',
                'name' => 'string_view_product_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale fallback per i pulsanti prodotto.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'View Product',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_quote_label',
                'label' => 'Quote Button Label',
                'name' => 'string_quote_button_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale fallback per il pulsante preventivo.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Request a Quote',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_read_more_label',
                'label' => 'Read More Label',
                'name' => 'string_read_more_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale per i pulsanti "leggi di piu".',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Read more',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_read_less_label',
                'label' => 'Read Less Label',
                'name' => 'string_read_less_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale per i pulsanti "leggi meno".',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Read less',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_modal_confirm_label',
                'label' => 'Modal Confirm Label',
                'name' => 'string_modal_confirm_label',
                'type' => 'text',
                'instructions' => 'Etichetta del pulsante conferma nelle modali informative.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Got it',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_strings_tab_news',
                'label' => 'News',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_string_latest_news_label',
                'label' => 'Latest News Label',
                'name' => 'string_latest_news_label',
                'type' => 'text',
                'instructions' => 'Titolo fallback per l archivio news.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Latest news',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_more_ilpra_news_label',
                'label' => 'More ILPRA News Label',
                'name' => 'string_more_ilpra_news_label',
                'type' => 'text',
                'instructions' => 'Titolo della sezione news correlate.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'More ILPRA News',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_strings_tab_labels',
                'label' => 'Labels',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_string_faq_label',
                'label' => 'FAQ Label',
                'name' => 'string_faq_label',
                'type' => 'text',
                'instructions' => 'Titolo globale fallback per le sezioni FAQ.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'FAQ',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_packaging_suffix_label',
                'label' => 'Packaging Suffix Label',
                'name' => 'string_packaging_suffix_label',
                'type' => 'text',
                'instructions' => 'Suffix globale usato nei titoli industry, es. "Packaging".',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Packaging',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_full_description_label',
                'label' => 'Full Description Label',
                'name' => 'string_full_description_label',
                'type' => 'text',
                'instructions' => 'Titolo globale fallback per la sezione descrizione completa.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Full Description',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_technical_data_label',
                'label' => 'Technical Data Label',
                'name' => 'string_technical_data_label',
                'type' => 'text',
                'instructions' => 'Titolo globale fallback per la sezione dati tecnici.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Technical Data',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_videos_label',
                'label' => 'Videos Label',
                'name' => 'string_videos_label',
                'type' => 'text',
                'instructions' => 'Titolo globale fallback per la sezione video.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Videos',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_technology_label',
                'label' => 'Technology Label',
                'name' => 'string_technology_label',
                'type' => 'text',
                'instructions' => 'Titolo globale fallback per la sezione tecnologie.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Technology',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_product_gallery_label',
                'label' => 'Product Gallery Label',
                'name' => 'string_product_gallery_label',
                'type' => 'text',
                'instructions' => 'Titolo globale fallback per la galleria prodotto.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Product Gallery',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_available_packaging_solutions_label',
                'label' => 'Available Packaging Solutions Label',
                'name' => 'string_available_packaging_solutions_label',
                'type' => 'text',
                'instructions' => 'Titolo globale fallback per la sezione soluzioni disponibili.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Available Packaging Solutions',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_machine_technologies_label',
                'label' => 'Machine Technologies Label',
                'name' => 'string_machine_technologies_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label del menu tecnologie macchina.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Machine technologies',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_by_industry_navigation_label',
                'label' => 'By Industry Navigation Label',
                'name' => 'string_by_industry_navigation_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label della navigazione by industry.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'By industry navigation',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_view_solutions_label',
                'label' => 'View Solutions Label',
                'name' => 'string_view_solutions_label',
                'type' => 'text',
                'instructions' => 'Etichetta globale per i pulsanti delle soluzioni industry.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'View Solutions',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_strings_tab_accessibility',
                'label' => 'Accessibility',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_string_previous_category_label',
                'label' => 'Previous Category Label',
                'name' => 'string_previous_category_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label per la categoria precedente.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Previous category',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_next_category_label',
                'label' => 'Next Category Label',
                'name' => 'string_next_category_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label per la categoria successiva.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Next category',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_previous_industries_label',
                'label' => 'Previous Industries Label',
                'name' => 'string_previous_industries_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label per la voce industry precedente.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Previous industries',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_next_industries_label',
                'label' => 'Next Industries Label',
                'name' => 'string_next_industries_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label per la voce industry successiva.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Next industries',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_open_technology_information_label',
                'label' => 'Open Technology Information Label',
                'name' => 'string_open_technology_information_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label del bottone info tecnologia.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Open technology information',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_close_dialog_label',
                'label' => 'Close Dialog Label',
                'name' => 'string_close_dialog_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label per la chiusura delle modali.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Close dialog',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_previous_gallery_items_label',
                'label' => 'Previous Gallery Items Label',
                'name' => 'string_previous_gallery_items_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label per la galleria precedente.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Previous gallery items',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_next_gallery_items_label',
                'label' => 'Next Gallery Items Label',
                'name' => 'string_next_gallery_items_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label per la galleria successiva.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Next gallery items',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_strings_tab_footer',
                'label' => 'Footer',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_string_footer_other_information_heading',
                'label' => 'Footer Other Information Heading',
                'name' => 'string_footer_other_information_heading',
                'type' => 'text',
                'instructions' => 'Titolo del primo gruppo accordion footer.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Other information',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_footer_welcome_heading',
                'label' => 'Footer Welcome Heading',
                'name' => 'string_footer_welcome_heading',
                'type' => 'text',
                'instructions' => 'Titolo del secondo gruppo accordion footer.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Welcome to ILPRA',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_footer_branches_heading',
                'label' => 'Footer Branches Heading',
                'name' => 'string_footer_branches_heading',
                'type' => 'text',
                'instructions' => 'Titolo del gruppo sedi globali nel footer.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Our Global Branches',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_footer_accreditations_heading',
                'label' => 'Footer Accreditations Heading',
                'name' => 'string_footer_accreditations_heading',
                'type' => 'text',
                'instructions' => 'Titolo del gruppo accreditamenti nel footer.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Accreditations',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_footer_navigation_label',
                'label' => 'Footer Navigation Label',
                'name' => 'string_footer_navigation_label',
                'type' => 'text',
                'instructions' => 'Etichetta aria-label della navigazione footer.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Footer Navigation',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_privacy_policy_label',
                'label' => 'Privacy Policy Label',
                'name' => 'string_privacy_policy_label',
                'type' => 'text',
                'instructions' => 'Etichetta del link privacy policy.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Privacy Policy',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_cookie_policy_label',
                'label' => 'Cookie Policy Label',
                'name' => 'string_cookie_policy_label',
                'type' => 'text',
                'instructions' => 'Etichetta del link cookie policy.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Cookie Policy',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_string_quality_policy_label',
                'label' => 'Quality Policy Label',
                'name' => 'string_quality_policy_label',
                'type' => 'text',
                'instructions' => 'Etichetta del link quality policy.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '34',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'Quality Policy',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'ilpra-theme-strings',
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
        'key' => 'group_ilpra_2026_packaging_machine_faq',
        'title' => 'Packaging Machine FAQ',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_machine_faq_tab',
                'label' => 'FAQ Macchina',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_machine_faq_items',
                'label' => 'FAQ',
                'name' => 'machine_faq_items',
                'type' => 'repeater',
                'instructions' => 'Domande e risposte mostrate nella pagina della singola macchina.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'layout' => 'row',
                'button_label' => 'Add FAQ',
                'sub_fields' => [
                    [
                        'key' => 'field_ilpra_2026_machine_faq_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_ilpra_2026_machine_faq_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'wysiwyg',
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
        'key' => 'group_ilpra_2026_homepage_fairs',
        'title' => 'Homepage Fairs',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_homepage_fairs_tab',
                'label' => 'Fiere Homepage',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_homepage_fairs',
                'label' => 'Fiere',
                'name' => 'homepage_fairs',
                'type' => 'repeater',
                'instructions' => 'Gestione editoriale delle fiere mostrate in homepage. Inserisci qui le card che devono comparire nel blocco News & Exhibitions.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'layout' => 'row',
                'button_label' => 'Aggiungi fiera',
                'sub_fields' => [
                    [
                        'key' => 'field_ilpra_2026_homepage_fair_city_date',
                        'label' => 'City / Date',
                        'name' => 'city_date',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '30',
                            'class' => '',
                            'id' => '',
                        ],
                    ],
                    [
                        'key' => 'field_ilpra_2026_homepage_fair_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '20',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'id',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ],
                    [
                        'key' => 'field_ilpra_2026_homepage_fair_stand',
                        'label' => 'Stand',
                        'name' => 'stand',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '15',
                            'class' => '',
                            'id' => '',
                        ],
                    ],
                    [
                        'key' => 'field_ilpra_2026_homepage_fair_hall',
                        'label' => 'Hall',
                        'name' => 'hall',
                        'type' => 'text',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '15',
                            'class' => '',
                            'id' => '',
                        ],
                    ],
                    [
                        'key' => 'field_ilpra_2026_homepage_fair_link',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'link',
                        'required' => 0,
                        'wrapper' => [
                            'width' => '20',
                            'class' => '',
                            'id' => '',
                        ],
                        'return_format' => 'array',
                    ],
                ],
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
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
                'key' => 'field_ilpra_2026_category_tab_overview',
                'label' => 'Card Serie',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_category_overview_title',
                'label' => 'Overview Title',
                'name' => 'category_overview_title',
                'type' => 'text',
                'instructions' => 'Titolo mostrato nella pagina elenco serie confezionatrici. Se vuoto, il tema usa il nome della categoria.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_category_overview_subtitle',
                'label' => 'Overview Subtitle',
                'name' => 'category_overview_subtitle',
                'type' => 'text',
                'instructions' => 'Sottotitolo mostrato nella pagina elenco serie confezionatrici.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_category_overview_description',
                'label' => 'Overview Description',
                'name' => 'category_overview_description',
                'type' => 'wysiwyg',
                'instructions' => 'Descrizione mostrata nella pagina elenco serie confezionatrici. Se vuota, il tema usa la descrizione categoria esistente.',
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
                'key' => 'field_ilpra_2026_category_overview_image',
                'label' => 'Overview Image',
                'name' => 'category_overview_image',
                'type' => 'image',
                'instructions' => 'Immagine principale mostrata nella pagina elenco serie confezionatrici. Se vuota, il tema usa l’immagine categoria esistente o la prima macchina disponibile.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ],
            [
                'key' => 'field_ilpra_2026_category_overview_button_label',
                'label' => 'Overview Button Label',
                'name' => 'category_overview_button_label',
                'type' => 'text',
                'instructions' => 'Etichetta pulsante della card serie.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => 'View Product Range',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ],
            [
                'key' => 'field_ilpra_2026_category_overview_highlights',
                'label' => 'Overview Highlights',
                'name' => 'category_overview_highlights',
                'type' => 'repeater',
                'instructions' => 'Elenco highlight mostrati sotto il pulsante nella pagina elenco serie confezionatrici.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'layout' => 'row',
                'button_label' => 'Add Highlight',
                'sub_fields' => [
                    [
                        'key' => 'field_ilpra_2026_category_overview_highlight_text',
                        'label' => 'Highlight',
                        'name' => 'item',
                        'type' => 'text',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                ],
            ],
            [
                'key' => 'field_ilpra_2026_category_tab_category_page',
                'label' => 'Pagina Categoria',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
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
                'key' => 'field_ilpra_2026_category_tab_faq',
                'label' => 'FAQ Categoria',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_ilpra_2026_category_faq_items',
                'label' => 'Category FAQ',
                'name' => 'category_faq_items',
                'type' => 'repeater',
                'instructions' => 'Domande e risposte mostrate nella pagina padre della categoria.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'layout' => 'row',
                'button_label' => 'Add Category FAQ',
                'sub_fields' => [
                    [
                        'key' => 'field_ilpra_2026_category_faq_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ],
                    [
                        'key' => 'field_ilpra_2026_category_faq_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'wysiwyg',
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
            ],
            [
                'key' => 'field_ilpra_2026_category_tab_technology',
                'label' => 'Linee / Tecnologie',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
                'endpoint' => 0,
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
