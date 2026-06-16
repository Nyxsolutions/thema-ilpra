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
                'key' => 'field_ilpra_2026_string_packaging_term_format_label',
                'label' => 'Packaging Term Format',
                'name' => 'string_packaging_term_format_label',
                'type' => 'text',
                'instructions' => 'Formato globale per titoli e label industry. Usa %s come placeholder del nome categoria. Esempio EN: "%s Packaging", IT: "Confezionamento %s".',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '%s Packaging',
                'placeholder' => '%s Packaging',
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

function ilpra_2026_get_homepage_link_subfield(string $key, string $label, string $name): array
{
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'link',
        'required' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'return_format' => 'array',
    ];
}

function ilpra_2026_get_homepage_acf_defaults(): array
{
    return [
        'home_hero_kicker' => 'More Than Machinery',
        'home_hero_title' => 'A global partner for your packaging needs',
        'home_hero_content' => 'Complete packaging systems designed, manufactured and supported by ILPRA since 1955',
        'home_hero_video_mp4' => home_url('/wp-content/uploads/2024/11/video_homepage.mp4'),
        'home_hero_video_webm' => home_url('/wp-content/uploads/2024/11/video_homepage.webm'),
        'home_hero_poster' => home_url('/wp-content/uploads/2024/11/videoplayback.svg'),
        'home_industry_title' => 'What product do you need to pack?',
        'home_industry_items' => [
            [
                'image' => 12859,
                'title' => 'Food',
                'content' => 'Efficient and reliable solutions for fresh, ready and processed food packaging.',
                'link' => [
                    'title' => 'View solutions',
                    'url' => home_url('/packaging/'),
                    'target' => '_self',
                ],
            ],
            [
                'image' => 12860,
                'title' => 'Medical & Cosmetics',
                'content' => 'Safe and precise packaging technologies for medical, cosmetic and personal care products.',
                'link' => [
                    'title' => 'View solutions',
                    'url' => home_url('/packaging/'),
                    'target' => '_self',
                ],
            ],
        ],
        'home_machines_title' => 'A wide range of packaging machines',
        'home_machines_content' => "ILPRA designs and manufactures complete packaging machines for the food, medical, cosmetic and non-food sectors.\nSince 1955, we support companies worldwide with reliable systems for tray sealing, thermoforming, filling, forming & filling and automated handling.",
        'home_machine_items' => [
            [
                'image' => 15491,
                'title' => 'Tray sealers',
                'content' => 'Semi-automatic - Automatic - In Line',
                'link' => [
                    'title' => '',
                    'url' => home_url('/packaging-machines/foodpack-traysealers/'),
                    'target' => '_self',
                ],
            ],
            [
                'image' => 15507,
                'title' => 'Fill Sealers',
                'content' => 'Rotary - In Line',
                'link' => [
                    'title' => '',
                    'url' => home_url('/packaging-machines/fill-seal-pot-fillers/'),
                    'target' => '_self',
                ],
            ],
            [
                'image' => 15494,
                'title' => 'Thermoformers',
                'content' => 'Compact - Customisable',
                'link' => [
                    'title' => '',
                    'url' => home_url('/packaging-machines/formpack-thermoformers/'),
                    'target' => '_self',
                ],
            ],
            [
                'image' => 15500,
                'title' => 'Form Fill Seal Machines',
                'content' => 'Automatic',
                'link' => [
                    'title' => '',
                    'url' => home_url('/packaging-machines/form-fill-seal/'),
                    'target' => '_self',
                ],
            ],
            [
                'image' => 15496,
                'title' => 'End of Line Machinery',
                'content' => 'Picking & Palletization',
                'link' => [
                    'title' => '',
                    'url' => home_url('/packaging-machines/end-of-line/'),
                    'target' => '_self',
                ],
            ],
            [
                'image' => 15686,
                'title' => 'ILPRA Group - Packaging Equipment',
                'content' => 'ILPRA Group - Packaging Equipment',
                'link' => [
                    'title' => '',
                    'url' => home_url('/packaging-machines/ilpragroup-packagingequipment/'),
                    'target' => '_self',
                ],
            ],
        ],
        'home_news_title' => 'News & Exhibitions',
    ];
}

function ilpra_2026_get_sustainability_acf_defaults(): array
{
    return [
        'sustainability_hero_title' => 'A Concrete Approach to Sustainability',
        'sustainability_hero_text' => 'In a constantly evolving industrial context, ILPRA adopts a pragmatic approach to sustainability by integrating solutions that improve energy efficiency, reduce the environmental impact of production processes, and promote people’s well-being.',
        'sustainability_tab_label_sustainability' => 'Sustainability',
        'sustainability_tab_label_environmental' => 'Environmental',
        'sustainability_tab_label_social' => 'Social',
        'sustainability_tab_label_governance' => 'Governance',
        'sustainability_quote_text' => "“Sustainability is not an abstract goal, but a series of concrete choices made every day.<br>\nThrough responsible innovation, efficiency, and respect for people and the environment, we build\nlong-term value for industry and society.”",
        'sustainability_sections' => [
            [
                'title' => 'A Concrete Approach to Sustainability',
                'image_position' => 'right',
                'image_asset' => '1_approach.jpg',
                'image_alt' => 'Concrete sustainability approach',
                'content' => '<p>In a constantly evolving industrial context, ILPRA adopts a pragmatic approach to sustainability by integrating solutions that improve energy efficiency, reduce the environmental impact of production processes, and promote people’s well-being.</p><p>Our focus on quality, safety, and innovation translates into conscious choices aimed at responsible, long-term growth, aligned with today’s needs and tomorrow’s challenges.</p>',
                'note' => '',
                'link' => null,
            ],
            [
                'title' => 'Our Sustainability Policy',
                'image_position' => 'left',
                'image_asset' => '3_ecovadis.jpg',
                'image_alt' => 'EcoVadis sustainability assessment',
                'content' => '<p>Our Corporate Sustainability Policy stems from the commitment to integrate environmental, social, and economic responsibility into all activities.</p><p><strong>Certifications and Assessments</strong><br>We participate in the EcoVadis Corporate Assessment. <a href="https://ecovadis.com" target="_blank" rel="noopener" style="color:#89af1e;">ecovadis.com</a></p>',
                'note' => '',
                'link' => null,
            ],
        ],
        'environmental_sections' => [
            [
                'title' => 'Energy Efficiency and Space Upgrades',
                'image_position' => 'right',
                'image_asset' => '4_pannelli solari.jpg',
                'image_alt' => 'Energy efficiency',
                'content' => '<p>We invest in modernizing our facilities by replacing outdated systems with high-efficiency solutions.</p><p>We constantly monitor consumption through smart control systems to optimize every intervention.</p><p>Thanks to photovoltaic panels, a significant portion of our energy needs is covered by green energy, delivering tangible benefits for both the environment and the community.</p>',
                'note' => '',
                'link' => null,
            ],
            [
                'title' => 'Sustainable Mobility',
                'image_position' => 'left',
                'image_asset' => '5_veicoli.jpg',
                'image_alt' => 'Sustainable mobility',
                'content' => '<p>We are converting our corporate fleet to electric and hybrid vehicles, helping reduce emissions.</p>',
                'note' => '',
                'link' => null,
            ],
            [
                'title' => 'Low-Emission Logistics',
                'image_position' => 'right',
                'image_asset' => '6_dhl.jpg',
                'image_alt' => 'Low-emission logistics',
                'content' => '<p>ILPRA is committed to reducing CO₂ emissions from shipments by using sustainable aviation fuel (SAF). For this reason, we have chosen DHL Express as our partner, sharing the goal of making more sustainable choices. Our shipments use the DHL GoGreen Plus service, which employs SAF blended with conventional fuel to cut emissions by up to 80%*.</p>',
                'note' => '*Jet fuel based on CORSIA baseline prescribed by SBTi. SAF LCA values based on ICCT data, assuming full lifecycle emissions from Used cooking oils, and vegetable oils derived from plants.',
                'link' => null,
            ],
            [
                'title' => 'Responsible Building Expansion',
                'image_position' => 'left',
                'image_asset' => '7_terzo.jpg',
                'image_alt' => 'Building expansion',
                'content' => '<p>Our new third floor will be built on a stilt-like structure with seismic resistance and minimal impact on the existing building—an example of safe and sustainable growth.</p>',
                'note' => '',
                'link' => null,
            ],
        ],
        'social_sections' => [
            [
                'title' => 'Corporate Welfare',
                'image_position' => 'right',
                'image_asset' => '8_corporate welfare.jpg',
                'image_alt' => 'Corporate welfare',
                'content' => '<p>We promote welfare initiatives to improve the quality of life for our employees and their families, fostering a healthy work-life balance.</p>',
                'note' => '',
                'link' => null,
            ],
            [
                'title' => 'Wellness Desk',
                'image_position' => 'left',
                'image_asset' => '9_sportello benessere.jpg',
                'image_alt' => 'Wellness desk',
                'content' => '<p>At ILPRA, we believe well-being is not a privilege but an essential part of everyday life. That’s why we created the “Taking Care of Ourselves” Wellness Desk, offering confidential sessions with a psychologist and psychotherapist for emotional support.</p>',
                'note' => '',
                'link' => null,
            ],
            [
                'title' => 'Career Development',
                'image_position' => 'right',
                'image_asset' => '10_career dev.jpg',
                'image_alt' => 'Career development',
                'content' => '<p>We believe in continuous learning and invest in developing technical and leadership skills to build a dynamic, future-oriented workplace.</p>',
                'note' => '',
                'link' => [
                    'title' => 'Work with Us',
                    'url' => 'https://ilpra.com/work-with-us/',
                    'target' => '_blank',
                ],
            ],
            [
                'title' => 'Sponsorships',
                'image_position' => 'left',
                'image_asset' => '11_fisrace.jpg',
                'image_alt' => 'Sponsorships',
                'content' => '<p>We proudly support social and sports initiatives, such as our official sponsorship of <a href="https://en.corporate.ilpra.com/ilpra-sponsor-ufficiale-di-fisip-federazione-italianasport-invernali-paralimpici/" target="_blank" rel="noopener" style="color:#89af1e;">FISIP – Italian Federation of Paralympic Winter Sports</a>.</p>',
                'note' => '',
                'link' => null,
            ],
            [
                'title' => 'Diversity and Inclusion',
                'image_position' => 'right',
                'image_asset' => '12_diversity.jpg',
                'image_alt' => 'Diversity and inclusion',
                'content' => '<p>We foster an inclusive environment where every individual is respected and valued. Diversity is a resource that drives innovation and creativity.</p>',
                'note' => '',
                'link' => null,
            ],
            [
                'title' => 'Academic Partnerships',
                'image_position' => 'left',
                'image_asset' => '13_academic.jpg',
                'image_alt' => 'Academic partnerships',
                'content' => '<p>To attract top talent, we maintain active collaborations with universities, offering curricular internships and delivering courses to share our expertise.</p>',
                'note' => '',
                'link' => null,
            ],
        ],
        'governance_sections' => [
            [
                'title' => 'Code of Ethics',
                'image_position' => 'right',
                'image_asset' => '14_ethics.jpg',
                'image_alt' => 'Code of ethics',
                'content' => '<p>Our Code of Ethics guides every action, promoting integrity, legality, and social responsibility. It is the foundation of our relationships with all stakeholders. To ensure transparency and alignment with our values, we require suppliers and customers to share our commitment. We provide a dedicated form for accepting the Code of Ethics and corporate policies, building strong and transparent relationships.</p>',
                'note' => '',
                'link' => [
                    'title' => 'Code of Ethics',
                    'url' => '/wp-content/uploads/2026/04/codice_etico.pdf',
                    'target' => '_blank',
                ],
            ],
            [
                'title' => 'D.Lgs. 231/2001',
                'image_position' => 'left',
                'image_asset' => '1_approach.jpg',
                'image_alt' => 'D.Lgs. 231/2001',
                'content' => '<p>Within its Governance system, ILPRA S.p.A. has adopted an Organization, Management and Control Model pursuant to Legislative Decree 231/2001, aimed at ensuring corporate management based on transparency, integrity, and full regulatory compliance.</p>',
                'note' => '',
                'link' => [
                    'title' => 'Organization, Management and Control Model',
                    'url' => '/wp-content/uploads/2026/04/modello_di_organizzazione_gestione_e_controllo.pdf',
                    'target' => '_blank',
                ],
            ],
            [
                'title' => 'Whistleblowing System',
                'image_position' => 'left',
                'image_asset' => '15_whistleblowing.jpg',
                'image_alt' => 'Whistleblowing system',
                'content' => '<p>We offer a secure and accessible channel for reporting non-compliant behavior, ensuring confidentiality and transparency.</p>',
                'note' => '',
                'link' => [
                    'title' => 'Whistleblowing',
                    'url' => 'https://digitalroom.bdo.it/Ilpra/home.aspx',
                    'target' => '_blank',
                ],
            ],
        ],
        'sustainability_quote_logo' => 'ilpra-70.svg',
    ];
}

function ilpra_2026_is_packaging_machines_page(int $post_id): bool
{
    if ($post_id <= 0) {
        return false;
    }

    $post = get_post($post_id);

    if (!$post instanceof WP_Post || $post->post_type !== 'page') {
        return false;
    }

    return $post->post_name === 'packaging-machines';
}

function ilpra_2026_get_packaging_machines_acf_defaults(int $post_id = 0): array
{
    $defaults = [
        'packaging_machines_hero_eyebrow' => '',
        'packaging_machines_hero_title' => '',
        'packaging_machines_hero_text' => '',
    ];

    if ($post_id <= 0) {
        return $defaults;
    }

    $rows_count = (int) get_post_meta($post_id, 'nw_flexible_content', true);

    if ($rows_count <= 0) {
        return $defaults;
    }

    for ($index = 0; $index < $rows_count; $index++) {
        $layout = (string) get_post_meta($post_id, 'nw_flexible_content_' . $index . '_acf_fc_layout', true);

        if ($layout !== 'header-1') {
            continue;
        }

        $defaults['packaging_machines_hero_eyebrow'] = trim((string) get_post_meta($post_id, 'nw_flexible_content_' . $index . '_subheading', true));
        $defaults['packaging_machines_hero_title'] = trim((string) get_post_meta($post_id, 'nw_flexible_content_' . $index . '_heading', true));
        $defaults['packaging_machines_hero_text'] = trim((string) get_post_meta($post_id, 'nw_flexible_content_' . $index . '_content', true));
        break;
    }

    return $defaults;
}

function ilpra_2026_import_theme_asset_attachment(string $relative_path, string $alt = ''): int
{
    $relative_path = ltrim($relative_path, '/');

    if ($relative_path === '') {
        return 0;
    }

    $existing_query = new WP_Query([
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => 1,
        'meta_key' => '_ilpra_2026_theme_asset_path',
        'meta_value' => $relative_path,
        'fields' => 'ids',
    ]);

    if (!empty($existing_query->posts)) {
        return (int) $existing_query->posts[0];
    }

    $source_path = get_template_directory() . '/sustainability/lib/images/' . $relative_path;

    if (!file_exists($source_path)) {
        return 0;
    }

    $uploads = wp_upload_dir();

    if (!empty($uploads['error'])) {
        return 0;
    }

    $filename = wp_unique_filename($uploads['path'], basename($source_path));
    $destination = trailingslashit($uploads['path']) . $filename;

    if (!wp_mkdir_p($uploads['path']) || !copy($source_path, $destination)) {
        return 0;
    }

    $filetype = wp_check_filetype($filename, null);
    $attachment_id = wp_insert_attachment([
        'post_mime_type' => $filetype['type'] ?? '',
        'post_title' => sanitize_file_name(pathinfo($filename, PATHINFO_FILENAME)),
        'post_status' => 'inherit',
    ], $destination);

    if (!$attachment_id || is_wp_error($attachment_id)) {
        return 0;
    }

    if (!function_exists('wp_generate_attachment_metadata')) {
        require_once ABSPATH . 'wp-admin/includes/image.php';
    }

    $metadata = wp_generate_attachment_metadata($attachment_id, $destination);

    if (!empty($metadata) && !is_wp_error($metadata)) {
        wp_update_attachment_metadata($attachment_id, $metadata);
    }

    update_post_meta($attachment_id, '_ilpra_2026_theme_asset_path', $relative_path);

    if ($alt !== '') {
        update_post_meta($attachment_id, '_wp_attachment_image_alt', $alt);
    }

    return (int) $attachment_id;
}

function ilpra_2026_prepare_seed_default_value(string $field_name, $default_value)
{
    if (!is_array($default_value)) {
        if ($field_name === 'sustainability_quote_logo' && is_string($default_value) && $default_value !== '') {
            return ilpra_2026_import_theme_asset_attachment($default_value);
        }

        return $default_value;
    }

    if (!in_array($field_name, ilpra_2026_get_seeded_repeater_field_names(), true)) {
        return $default_value;
    }

    foreach ($default_value as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $asset = trim((string) ($row['image_asset'] ?? ''));
        $alt = trim((string) ($row['image_alt'] ?? ''));

        if ($asset !== '') {
            $default_value[$index]['image'] = ilpra_2026_import_theme_asset_attachment($asset, $alt);
        }

        unset($default_value[$index]['image_asset']);
    }

    return $default_value;
}

function ilpra_2026_get_homepage_card_repeater(string $key, string $label, string $name, string $button_label): array
{
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'repeater',
        'required' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'layout' => 'row',
        'button_label' => $button_label,
        'sub_fields' => [
            [
                'key' => $key . '_image',
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
                'key' => $key . '_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'required' => 0,
                'wrapper' => [
                    'width' => '25',
                    'class' => '',
                    'id' => '',
                ],
            ],
            [
                'key' => $key . '_content',
                'label' => 'Content',
                'name' => 'content',
                'type' => 'textarea',
                'required' => 0,
                'wrapper' => [
                    'width' => '35',
                    'class' => '',
                    'id' => '',
                ],
                'rows' => 3,
                'new_lines' => 'br',
            ],
            ilpra_2026_get_homepage_link_subfield($key . '_link', 'Link', 'link'),
        ],
    ];
}

function ilpra_2026_get_sustainability_section_repeater(string $key, string $label, string $name, string $button_label): array
{
    return [
        'key' => $key,
        'label' => $label,
        'name' => $name,
        'type' => 'repeater',
        'required' => 0,
        'wrapper' => [
            'width' => '',
            'class' => '',
            'id' => '',
        ],
        'layout' => 'block',
        'button_label' => $button_label,
        'sub_fields' => [
            [
                'key' => $key . '_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
                'required' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
            ],
            [
                'key' => $key . '_image_position',
                'label' => 'Image Position',
                'name' => 'image_position',
                'type' => 'select',
                'required' => 0,
                'wrapper' => [
                    'width' => '20',
                    'class' => '',
                    'id' => '',
                ],
                'choices' => [
                    'right' => 'Image Right',
                    'left' => 'Image Left',
                ],
                'default_value' => 'right',
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
            ],
            [
                'key' => $key . '_image',
                'label' => 'Image',
                'name' => 'image',
                'type' => 'image',
                'required' => 0,
                'wrapper' => [
                    'width' => '30',
                    'class' => '',
                    'id' => '',
                ],
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
            ],
            [
                'key' => $key . '_image_alt',
                'label' => 'Image Alt',
                'name' => 'image_alt',
                'type' => 'text',
                'required' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
            ],
            [
                'key' => $key . '_content',
                'label' => 'Content',
                'name' => 'content',
                'type' => 'wysiwyg',
                'required' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
                'delay' => 0,
            ],
            [
                'key' => $key . '_note',
                'label' => 'Note',
                'name' => 'note',
                'type' => 'textarea',
                'required' => 0,
                'wrapper' => [
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ],
                'rows' => 2,
                'new_lines' => 'br',
            ],
            ilpra_2026_get_homepage_link_subfield($key . '_link', 'Button Link', 'link'),
        ],
    ];
}

add_action('acf/init', static function (): void {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group([
        'key' => 'group_ilpra_2026_homepage_content',
        'title' => 'Homepage Content',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_homepage_content_tab_hero',
                'label' => 'Hero',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_home_hero_kicker',
                'label' => 'Hero Kicker',
                'name' => 'home_hero_kicker',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_home_hero_title',
                'label' => 'Hero Title',
                'name' => 'home_hero_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_home_hero_content',
                'label' => 'Hero Content',
                'name' => 'home_hero_content',
                'type' => 'textarea',
                'rows' => 3,
                'new_lines' => 'br',
            ],
            [
                'key' => 'field_ilpra_2026_home_hero_video_mp4',
                'label' => 'Hero Video MP4 URL',
                'name' => 'home_hero_video_mp4',
                'type' => 'url',
            ],
            [
                'key' => 'field_ilpra_2026_home_hero_video_webm',
                'label' => 'Hero Video WEBM URL',
                'name' => 'home_hero_video_webm',
                'type' => 'url',
            ],
            [
                'key' => 'field_ilpra_2026_home_hero_poster',
                'label' => 'Hero Poster URL',
                'name' => 'home_hero_poster',
                'type' => 'url',
            ],
            [
                'key' => 'field_ilpra_2026_homepage_content_tab_industries',
                'label' => 'Industries',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_home_industry_title',
                'label' => 'Industries Title',
                'name' => 'home_industry_title',
                'type' => 'text',
            ],
            ilpra_2026_get_homepage_card_repeater(
                'field_ilpra_2026_home_industry_items',
                'Industry Cards',
                'home_industry_items',
                'Add Industry Card'
            ),
            [
                'key' => 'field_ilpra_2026_homepage_content_tab_machines',
                'label' => 'Machines',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_home_machines_title',
                'label' => 'Machines Title',
                'name' => 'home_machines_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_home_machines_content',
                'label' => 'Machines Intro Content',
                'name' => 'home_machines_content',
                'type' => 'textarea',
                'rows' => 4,
                'new_lines' => 'br',
            ],
            ilpra_2026_get_homepage_card_repeater(
                'field_ilpra_2026_home_machine_items',
                'Machine Cards',
                'home_machine_items',
                'Add Machine Card'
            ),
            [
                'key' => 'field_ilpra_2026_homepage_content_tab_news',
                'label' => 'News',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_home_news_title',
                'label' => 'News Section Title',
                'name' => 'home_news_title',
                'type' => 'text',
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
        'active' => true,
        'show_in_rest' => 0,
    ]);

    acf_add_local_field_group([
        'key' => 'group_ilpra_2026_sustainability_content',
        'title' => 'Sustainability Content',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_sustainability_tab_hero',
                'label' => 'Hero',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_hero_title',
                'label' => 'Hero Title',
                'name' => 'sustainability_hero_title',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_hero_text',
                'label' => 'Hero Text',
                'name' => 'sustainability_hero_text',
                'type' => 'textarea',
                'rows' => 4,
                'new_lines' => 'br',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_tab_tabs',
                'label' => 'Tabs',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_tab_label_sustainability',
                'label' => 'Sustainability Tab Label',
                'name' => 'sustainability_tab_label_sustainability',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_tab_label_environmental',
                'label' => 'Environmental Tab Label',
                'name' => 'sustainability_tab_label_environmental',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_tab_label_social',
                'label' => 'Social Tab Label',
                'name' => 'sustainability_tab_label_social',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_tab_label_governance',
                'label' => 'Governance Tab Label',
                'name' => 'sustainability_tab_label_governance',
                'type' => 'text',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_tab_sustainability',
                'label' => 'Sustainability',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            ilpra_2026_get_sustainability_section_repeater(
                'field_ilpra_2026_sustainability_sections',
                'Sustainability Sections',
                'sustainability_sections',
                'Add Sustainability Section'
            ),
            [
                'key' => 'field_ilpra_2026_sustainability_tab_environmental',
                'label' => 'Environmental',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            ilpra_2026_get_sustainability_section_repeater(
                'field_ilpra_2026_environmental_sections',
                'Environmental Sections',
                'environmental_sections',
                'Add Environmental Section'
            ),
            [
                'key' => 'field_ilpra_2026_sustainability_tab_social',
                'label' => 'Social',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            ilpra_2026_get_sustainability_section_repeater(
                'field_ilpra_2026_social_sections',
                'Social Sections',
                'social_sections',
                'Add Social Section'
            ),
            [
                'key' => 'field_ilpra_2026_sustainability_tab_governance',
                'label' => 'Governance',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            ilpra_2026_get_sustainability_section_repeater(
                'field_ilpra_2026_governance_sections',
                'Governance Sections',
                'governance_sections',
                'Add Governance Section'
            ),
            [
                'key' => 'field_ilpra_2026_sustainability_tab_quote',
                'label' => 'Quote',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_quote_text',
                'label' => 'Quote Text',
                'name' => 'sustainability_quote_text',
                'type' => 'textarea',
                'rows' => 4,
                'new_lines' => 'br',
            ],
            [
                'key' => 'field_ilpra_2026_sustainability_quote_logo',
                'label' => 'Quote Logo',
                'name' => 'sustainability_quote_logo',
                'type' => 'image',
                'return_format' => 'id',
                'preview_size' => 'medium',
                'library' => 'all',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'sustainability.php',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'show_in_rest' => 0,
    ]);

    acf_add_local_field_group([
        'key' => 'group_ilpra_2026_packaging_machines_page_content',
        'title' => 'Packaging Machines Page Content',
        'fields' => [
            [
                'key' => 'field_ilpra_2026_packaging_machines_tab_hero',
                'label' => 'Hero',
                'name' => '',
                'type' => 'tab',
                'placement' => 'top',
            ],
            [
                'key' => 'field_ilpra_2026_packaging_machines_hero_eyebrow',
                'label' => 'Hero Eyebrow',
                'name' => 'packaging_machines_hero_eyebrow',
                'type' => 'text',
                'instructions' => 'Testo piccolo sopra al titolo principale.',
            ],
            [
                'key' => 'field_ilpra_2026_packaging_machines_hero_title',
                'label' => 'Hero Title',
                'name' => 'packaging_machines_hero_title',
                'type' => 'text',
                'instructions' => 'Titolo principale della pagina.',
            ],
            [
                'key' => 'field_ilpra_2026_packaging_machines_hero_text',
                'label' => 'Hero Text',
                'name' => 'packaging_machines_hero_text',
                'type' => 'textarea',
                'rows' => 3,
                'new_lines' => 'br',
                'instructions' => 'Sottotitolo/testo introduttivo sotto al titolo.',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ],
            ],
        ],
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
        'show_in_rest' => 0,
    ]);
}, 30);

function ilpra_2026_get_acf_default_value_by_name(string $field_name, $post_id = 0)
{
    $post_id = is_numeric($post_id) ? (int) $post_id : 0;
    $front_page_id = function_exists('get_option') ? (int) get_option('page_on_front') : 0;
    $is_front_page = $post_id > 0 && $post_id === $front_page_id;
    $is_sustainability_page = $post_id > 0 && get_page_template_slug($post_id) === 'sustainability.php';

    if ($is_front_page) {
        $home_defaults = ilpra_2026_get_homepage_acf_defaults();

        if (array_key_exists($field_name, $home_defaults)) {
            return $home_defaults[$field_name];
        }
    }

    if ($is_sustainability_page) {
        $sustainability_defaults = ilpra_2026_get_sustainability_acf_defaults();

        if (array_key_exists($field_name, $sustainability_defaults)) {
            return $sustainability_defaults[$field_name];
        }
    }

    if ($post_id > 0 && ilpra_2026_is_packaging_machines_page($post_id)) {
        $packaging_machines_defaults = ilpra_2026_get_packaging_machines_acf_defaults($post_id);

        if (array_key_exists($field_name, $packaging_machines_defaults)) {
            return $packaging_machines_defaults[$field_name];
        }
    }

    return null;
}

function ilpra_2026_is_effectively_empty_repeater_row(string $field_name, array $row): bool
{
    $checks_map = [
        'home_industry_items' => ['image', 'title', 'content', 'link'],
        'home_machine_items' => ['image', 'title', 'content', 'link'],
        'sustainability_sections' => ['title', 'image', 'image_alt', 'content', 'note', 'link'],
        'environmental_sections' => ['title', 'image', 'image_alt', 'content', 'note', 'link'],
        'social_sections' => ['title', 'image', 'image_alt', 'content', 'note', 'link'],
        'governance_sections' => ['title', 'image', 'image_alt', 'content', 'note', 'link'],
    ];

    $keys_to_check = $checks_map[$field_name] ?? [];

    if (empty($keys_to_check)) {
        return false;
    }

    foreach ($keys_to_check as $key) {
        $value = $row[$key] ?? null;

        if (is_array($value)) {
            $url = trim((string) ($value['url'] ?? ''));

            if ($url !== '') {
                return false;
            }

            continue;
        }

        if (is_string($value) && trim($value) !== '') {
            return false;
        }

        if (is_numeric($value) && (int) $value > 0) {
            return false;
        }

        if (is_bool($value) && $value) {
            return false;
        }
    }

    return true;
}

function ilpra_2026_is_effectively_empty_repeater_value(string $field_name, $value): bool
{
    if (!is_array($value) || empty($value)) {
        return true;
    }

    foreach ($value as $row) {
        if (!is_array($row)) {
            return false;
        }

        if (!ilpra_2026_is_effectively_empty_repeater_row($field_name, $row)) {
            return false;
        }
    }

    return true;
}

function ilpra_2026_get_seeded_repeater_field_names(): array
{
    return [
        'home_industry_items',
        'home_machine_items',
        'sustainability_sections',
        'environmental_sections',
        'social_sections',
        'governance_sections',
    ];
}

add_filter('acf/load_value', static function ($value, $post_id, $field) {
    if (!is_array($field) || empty($field['name'])) {
        return $value;
    }

    $default_value = ilpra_2026_get_acf_default_value_by_name((string) $field['name'], $post_id);

    if ($default_value === null) {
        return $value;
    }

    if ((string) $field['name'] === 'sustainability_quote_logo') {
        return $value;
    }

    if (in_array((string) $field['name'], ilpra_2026_get_seeded_repeater_field_names(), true)) {
        return $value;
    }

    if (is_array($value)) {
        if (ilpra_2026_is_effectively_empty_repeater_value((string) $field['name'], $value)) {
            return $default_value;
        }

        return !empty($value) ? $value : $default_value;
    }

    if (is_string($value)) {
        return trim($value) !== '' ? $value : $default_value;
    }

    return empty($value) ? $default_value : $value;
}, 20, 3);

function ilpra_2026_get_homepage_seed_field_keys(): array
{
    return [
        'home_hero_kicker' => 'field_ilpra_2026_home_hero_kicker',
        'home_hero_title' => 'field_ilpra_2026_home_hero_title',
        'home_hero_content' => 'field_ilpra_2026_home_hero_content',
        'home_hero_video_mp4' => 'field_ilpra_2026_home_hero_video_mp4',
        'home_hero_video_webm' => 'field_ilpra_2026_home_hero_video_webm',
        'home_hero_poster' => 'field_ilpra_2026_home_hero_poster',
        'home_industry_title' => 'field_ilpra_2026_home_industry_title',
        'home_industry_items' => 'field_ilpra_2026_home_industry_items',
        'home_machines_title' => 'field_ilpra_2026_home_machines_title',
        'home_machines_content' => 'field_ilpra_2026_home_machines_content',
        'home_machine_items' => 'field_ilpra_2026_home_machine_items',
        'home_news_title' => 'field_ilpra_2026_home_news_title',
    ];
}

function ilpra_2026_get_sustainability_seed_field_keys(): array
{
    return [
        'sustainability_hero_title' => 'field_ilpra_2026_sustainability_hero_title',
        'sustainability_hero_text' => 'field_ilpra_2026_sustainability_hero_text',
        'sustainability_tab_label_sustainability' => 'field_ilpra_2026_sustainability_tab_label_sustainability',
        'sustainability_tab_label_environmental' => 'field_ilpra_2026_sustainability_tab_label_environmental',
        'sustainability_tab_label_social' => 'field_ilpra_2026_sustainability_tab_label_social',
        'sustainability_tab_label_governance' => 'field_ilpra_2026_sustainability_tab_label_governance',
        'sustainability_sections' => 'field_ilpra_2026_sustainability_sections',
        'environmental_sections' => 'field_ilpra_2026_environmental_sections',
        'social_sections' => 'field_ilpra_2026_social_sections',
        'governance_sections' => 'field_ilpra_2026_governance_sections',
        'sustainability_quote_text' => 'field_ilpra_2026_sustainability_quote_text',
        'sustainability_quote_logo' => 'field_ilpra_2026_sustainability_quote_logo',
    ];
}

function ilpra_2026_get_packaging_machines_seed_field_keys(): array
{
    return [
        'packaging_machines_hero_eyebrow' => 'field_ilpra_2026_packaging_machines_hero_eyebrow',
        'packaging_machines_hero_title' => 'field_ilpra_2026_packaging_machines_hero_title',
        'packaging_machines_hero_text' => 'field_ilpra_2026_packaging_machines_hero_text',
    ];
}

function ilpra_2026_seed_acf_defaults_if_needed(int $post_id, array $defaults, array $field_keys, string $flag_meta_key): void
{
    if (
        $post_id <= 0 ||
        !function_exists('get_field') ||
        !function_exists('update_field') ||
        get_post_meta($post_id, $flag_meta_key, true) === 'done'
    ) {
        return;
    }

    foreach ($defaults as $field_name => $default_value) {
        $field_key = $field_keys[$field_name] ?? '';

        if ($field_key === '') {
            continue;
        }

        $current_value = get_field($field_name, $post_id);

        if (is_array($default_value)) {
            if (!ilpra_2026_is_effectively_empty_repeater_value($field_name, $current_value)) {
                continue;
            }
        } elseif (is_string($current_value) && trim($current_value) !== '') {
            continue;
        } elseif (!is_string($current_value) && !empty($current_value)) {
            continue;
        }

        update_field($field_key, ilpra_2026_prepare_seed_default_value($field_name, $default_value), $post_id);
    }

    update_post_meta($post_id, $flag_meta_key, 'done');
}

add_action('current_screen', static function ($screen): void {
    if (!is_admin() || !is_object($screen) || ($screen->base ?? '') !== 'post') {
        return;
    }

    $post_id = isset($_GET['post']) ? (int) $_GET['post'] : 0;

    if ($post_id <= 0) {
        return;
    }

    $front_page_id = function_exists('get_option') ? (int) get_option('page_on_front') : 0;

    if ($post_id === $front_page_id) {
        ilpra_2026_seed_acf_defaults_if_needed(
            $post_id,
            ilpra_2026_get_homepage_acf_defaults(),
            ilpra_2026_get_homepage_seed_field_keys(),
            '_ilpra_2026_homepage_defaults_seeded'
        );
    }

    if (get_page_template_slug($post_id) === 'sustainability.php') {
        ilpra_2026_seed_acf_defaults_if_needed(
            $post_id,
            ilpra_2026_get_sustainability_acf_defaults(),
            ilpra_2026_get_sustainability_seed_field_keys(),
            '_ilpra_2026_sustainability_defaults_seeded'
        );
    }

    if (ilpra_2026_is_packaging_machines_page($post_id)) {
        ilpra_2026_seed_acf_defaults_if_needed(
            $post_id,
            ilpra_2026_get_packaging_machines_acf_defaults($post_id),
            ilpra_2026_get_packaging_machines_seed_field_keys(),
            '_ilpra_2026_packaging_machines_defaults_seeded'
        );
    }
});
