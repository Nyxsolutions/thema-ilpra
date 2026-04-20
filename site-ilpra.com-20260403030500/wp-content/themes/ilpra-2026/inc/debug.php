<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_should_show_template_badge(): bool
{
    if (!is_user_logged_in()) {
        return false;
    }

    $user = wp_get_current_user();

    return $user instanceof WP_User && $user->exists() && $user->user_login === 'nyx';
}

function ilpra_2026_render_template_badge(): void
{
    if (!ilpra_2026_should_show_template_badge()) {
        return;
    }

    global $template;

    $template_path = is_string($template) ? $template : '';
    $theme_dir = trailingslashit(get_template_directory());
    $template_label = $template_path !== '' ? str_replace($theme_dir, '', $template_path) : 'n/d';

    $object_id = get_queried_object_id();
    $assigned_template = '';

    if ($object_id) {
        $assigned_template = (string) get_page_template_slug($object_id);
    }

    if ($assigned_template === '') {
        $assigned_template = 'default';
    }

    echo '<div class="ilpra-template-badge" aria-live="polite">';
    echo '<strong>Template:</strong> ' . esc_html($template_label);
    echo '<br><strong>Assegnato:</strong> ' . esc_html($assigned_template);
    echo '</div>';
}
add_action('wp_footer', 'ilpra_2026_render_template_badge', 9999);

function ilpra_2026_template_badge_styles(): void
{
    if (!ilpra_2026_should_show_template_badge()) {
        return;
    }
    ?>
    <style id="ilpra-template-badge-styles">
        .ilpra-template-badge {
            position: fixed;
            left: 16px;
            bottom: 16px;
            z-index: 999999;
            max-width: min(460px, calc(100vw - 32px));
            padding: 10px 12px;
            border-radius: 12px;
            background: rgba(16, 24, 32, 0.92);
            color: #7dffb0;
            font: 600 12px/1.45 Menlo, Monaco, Consolas, "Liberation Mono", monospace;
            box-shadow: 0 16px 32px rgba(16, 24, 32, 0.24);
            pointer-events: none;
            word-break: break-word;
        }

        .ilpra-template-badge strong {
            color: #ffffff;
        }
    </style>
    <?php
}
add_action('wp_head', 'ilpra_2026_template_badge_styles', 9999);
