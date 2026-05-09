<?php
if (!defined('ABSPATH')) {
    exit;
}

$ilpra_theme_includes = [
    '/inc/acf-fields.php',
    '/inc/setup.php',
    '/inc/enqueue.php',
    '/inc/careers.php',
    '/inc/helpers.php',
    '/inc/integrations.php',
    '/inc/home-data.php',
    '/inc/debug.php',
];

foreach ($ilpra_theme_includes as $ilpra_theme_include) {
    $ilpra_theme_file = get_template_directory() . $ilpra_theme_include;

    if (file_exists($ilpra_theme_file)) {
        require_once $ilpra_theme_file;
    }
}

/**
 * Disabilita completamente i commenti in tutto WordPress
 */
add_action('init', function() {

    // 1. Disabilita supporto commenti per tutti i post type
    foreach (get_post_types() as $post_type) {
        remove_post_type_support($post_type, 'comments');
        remove_post_type_support($post_type, 'trackbacks');
    }
});

// 2. Chiude eventuali commenti ancora aperti
add_filter('comments_open', '__return_false', 20, 2);
add_filter('pings_open', '__return_false', 20, 2);

// 3. Nasconde del tutto l’esistente UI dei commenti
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');  // Voce "Commenti"
});

// 4. Nasconde il widget "Commenti recenti" nella bacheca
add_action('admin_init', function () {
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
});

// 5. Nasconde i campi commenti nel profilo utente
add_action('admin_init', function () {
    remove_action('personal_options_update', 'edit_user_comment_shortcuts');
    remove_action('edit_user_profile_update', 'edit_user_comment_shortcuts');
});

// 6. Reindirizza eventuali accessi diretti alla pagina commenti
add_action('admin_init', function() {
    global $pagenow;
    if ($pagenow === 'edit-comments.php') {
        wp_redirect(admin_url());
        exit;
    }
});

// 7. Rimuove il feed RSS dei commenti
add_filter('feed_links_show_comments_feed', '__return_false');
