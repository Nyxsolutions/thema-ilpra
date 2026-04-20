<?php
/*
Template Name: Sustainability
*/

if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_render_sustainability_include(string $filename): void
{
    $include_path = get_template_directory() . '/sustainability/include/' . $filename;

    if (!file_exists($include_path)) {
        echo '<!-- Missing sustainability section: ' . esc_html($filename) . ' -->';
        return;
    }

    $html = file_get_contents($include_path);

    if ($html === false) {
        return;
    }

    $theme_base = get_template_directory_uri() . '/sustainability/';

    $html = preg_replace('#<script\b[^>]*>.*?</script>#is', '', $html);

    $html = str_replace(
        [
            'href="lib/',
            'src="lib/',
            'href="images/',
            'src="images/',
            "url('lib/",
            'url("lib/',
            "url('images/",
            'url("images/',
        ],
        [
            'href="' . $theme_base . 'lib/',
            'src="' . $theme_base . 'lib/',
            'href="' . $theme_base . 'lib/images/',
            'src="' . $theme_base . 'lib/images/',
            "url('" . $theme_base . 'lib/',
            'url("' . $theme_base . 'lib/',
            "url('" . $theme_base . 'lib/images/',
            'url("' . $theme_base . 'lib/images/',
        ],
        $html
    );

    echo $html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

get_header();
?>
<section class="sustainability-page">
    <div class="sustainability-page__inner">
        <div id="sustainability-container" class="sustainability-page__content">
            <?php ilpra_2026_render_sustainability_include('hero.html'); ?>

            <div id="sostenibile" class="sustainability-panel is-active" data-sustainability-panel="sustainability">
                <?php ilpra_2026_render_sustainability_include('sustainability.html'); ?>
            </div>

            <div id="environmental" class="sustainability-panel" data-sustainability-panel="environmental" hidden>
                <?php ilpra_2026_render_sustainability_include('environmental.html'); ?>
            </div>

            <div id="social" class="sustainability-panel" data-sustainability-panel="social" hidden>
                <?php ilpra_2026_render_sustainability_include('social.html'); ?>
            </div>

            <div id="governance" class="sustainability-panel" data-sustainability-panel="governance" hidden>
                <?php ilpra_2026_render_sustainability_include('governance.html'); ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
