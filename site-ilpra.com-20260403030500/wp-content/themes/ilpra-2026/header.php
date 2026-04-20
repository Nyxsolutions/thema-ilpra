<?php
if (!defined('ABSPATH')) {
    exit;
}
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="site-shell">
    <header class="<?php echo esc_attr(ilpra_2026_site_header_classes()); ?>">
        <div class="site-header__inner">
            <div class="site-branding">
                <a class="site-branding__link" href="<?php echo esc_url(home_url('/')); ?>">
                    <img class="site-branding__logo site-branding__logo--full" src="<?php echo esc_url(ilpra_2026_get_logo_url(false)); ?>" alt="<?php echo esc_attr(ilpra_2026_get_logo_alt()); ?>">
                    <img class="site-branding__logo site-branding__logo--compact" src="<?php echo esc_url(ilpra_2026_get_logo_url(true)); ?>" alt="<?php echo esc_attr(ilpra_2026_get_logo_alt()); ?>">
                </a>
            </div>

            <button class="site-header__toggle" type="button" aria-expanded="false" aria-controls="site-nav-panel" aria-label="<?php esc_attr_e('Apri menu', 'ilpra-2026'); ?>">
                <span class="site-header__toggle-icon site-header__toggle-icon--open" aria-hidden="true">&#9776;</span>
                <span class="site-header__toggle-icon site-header__toggle-icon--close" aria-hidden="true">&times;</span>
            </button>

            <nav class="site-nav" id="site-nav-panel" aria-label="<?php esc_attr_e('Primary Navigation', 'ilpra-2026'); ?>">
                <?php ilpra_2026_render_primary_navigation(); ?>
            </nav>
        </div>
    </header>

    <div class="site-search-panel" hidden>
        <div class="site-search-panel__inner">
            <form class="site-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
                <label class="screen-reader-text" for="site-machine-search"><?php esc_html_e('Search packaging machines', 'ilpra-2026'); ?></label>
                <input id="site-machine-search" class="site-search-form__input" type="search" name="s" placeholder="<?php esc_attr_e('Machine model search', 'ilpra-2026'); ?>" autocomplete="off">
                <input type="hidden" name="post_type" value="packaging_machine">
                <input type="hidden" name="ilpra_search_scope" value="machines">
                <button class="site-search-form__submit" type="submit" aria-label="<?php esc_attr_e('Search packaging machines', 'ilpra-2026'); ?>">
                    <span class="site-nav__search-icon" aria-hidden="true"></span>
                </button>
            </form>
        </div>
    </div>

    <main class="site-main" id="content">
