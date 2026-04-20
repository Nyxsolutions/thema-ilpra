<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="content-frame">
    <div class="content-frame__inner">
        <article class="entry-card">
            <h1 class="entry-card__title"><?php esc_html_e('Pagina non trovata', 'ilpra-2026'); ?></h1>
            <div class="entry-card__content">
                <p><?php esc_html_e('Il contenuto richiesto non e\' disponibile o e\' stato spostato.', 'ilpra-2026'); ?></p>
            </div>
        </article>
    </div>
</section>
<?php
get_footer();

