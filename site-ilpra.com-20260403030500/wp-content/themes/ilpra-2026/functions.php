<?php
if (!defined('ABSPATH')) {
    exit;
}

$ilpra_theme_includes = [
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
