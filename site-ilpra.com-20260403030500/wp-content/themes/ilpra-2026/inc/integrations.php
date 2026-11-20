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

function ilpra_2026_render_dynamics_form(): void
{
    ilpra_2026_enqueue_dynamics_form_assets();
    ?>
    <div
        data-form-id="32912203-b6c7-f111-aaaf-0022489fcb59"
        data-form-api-url="https://public-eur.mkt.dynamics.com/api/v1.0/orgs/e2e5ac00-951e-ee11-a7ee-000d3a486a6b/landingpageforms"
        data-cached-form-url="https://assets1-eur.mkt.dynamics.com/e2e5ac00-951e-ee11-a7ee-000d3a486a6b/digitalassets/forms/32912203-b6c7-f111-aaaf-0022489fcb59"
    ></div>
    <?php
}

function ilpra_2026_enqueue_dynamics_form_assets(): void
{
    static $assets_enqueued = false;

    if ($assets_enqueued) {
        return;
    }

    $assets_enqueued = true;
    $handle = 'ilpra-2026-dynamics-form-loader';
    $website_url_script = <<<'JS'
(function () {
    'use strict';

    const fieldName = 'websiteurl';
    const pageUrl = window.location.href;

    function setWebsiteUrl() {
        const field = document.querySelector('form.marketingForm [name="' + fieldName + '"]');

        if (!field) {
            return false;
        }

        field.value = pageUrl;
        return true;
    }

    if (setWebsiteUrl()) {
        return;
    }

    const observer = new MutationObserver(function () {
        if (setWebsiteUrl()) {
            observer.disconnect();
        }
    });

    observer.observe(document.documentElement, {
        childList: true,
        subtree: true
    });

    setTimeout(function () {
        observer.disconnect();
    }, 15000);
})();
JS;

    wp_enqueue_script(
        $handle,
        'https://formui-usa1.mkt.dynamics.com/eur/FormLoader/FormLoader.bundle.js',
        [],
        null,
        true
    );
    wp_add_inline_script($handle, $website_url_script, 'after');
}

