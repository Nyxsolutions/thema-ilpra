<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_render_elementor_template(int $template_id): void
{
    if ($template_id <= 0) {
        return;
    }

    echo do_shortcode(sprintf('[elementor-template id="%d"]', $template_id));
}

function ilpra_2026_render_cf7_form(string $form_id): void
{
    $form_id = trim($form_id);

    if ($form_id === '') {
        return;
    }

    echo do_shortcode(sprintf('[contact-form-7 id="%s"]', esc_attr($form_id)));
}

