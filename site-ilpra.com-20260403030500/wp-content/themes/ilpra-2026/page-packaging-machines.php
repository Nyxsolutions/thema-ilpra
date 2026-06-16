<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $rows = get_field('nw_flexible_content');
    $hero = null;
    $cta = null;
    $legacy_machine_sections = [];
    $product_range_button_label = ilpra_2026_get_theme_string('string_product_range_label', 'View Product Range', 'Scopri la gamma');
    $contact_button_label = ilpra_2026_get_theme_string('string_contact_button_label', 'Contact Us', 'Contattaci');

    if (is_array($rows)) {
        foreach ($rows as $row) {
            if (!is_array($row) || empty($row['acf_fc_layout'])) {
                continue;
            }

            if ($row['acf_fc_layout'] === 'header-1' && $hero === null) {
                $hero = $row;
                continue;
            }

            if ($row['acf_fc_layout'] === 'crosslink-4') {
                $legacy_machine_sections[] = $row;
                continue;
            }

            if ($row['acf_fc_layout'] === 'cta-8' && $cta === null) {
                $cta = $row;
            }
        }
    }

    $hero_eyebrow = function_exists('get_field') ? trim((string) get_field('packaging_machines_hero_eyebrow')) : '';
    $hero_title = function_exists('get_field') ? trim((string) get_field('packaging_machines_hero_title')) : '';
    $hero_text = function_exists('get_field') ? trim((string) get_field('packaging_machines_hero_text')) : '';

    if ($hero && is_array($hero)) {
        $hero_eyebrow = $hero_eyebrow !== '' ? $hero_eyebrow : trim((string) ($hero['subheading'] ?? ''));
        $hero_title = $hero_title !== '' ? $hero_title : trim((string) ($hero['heading'] ?? ''));
        $hero_text = $hero_text !== '' ? $hero_text : trim((string) ($hero['content'] ?? ''));
    }

    $series_terms = get_terms([
        'taxonomy' => 'tipologia_confezionatrice',
        'hide_empty' => false,
        'parent' => 0,
        'orderby' => 'term_order',
        'order' => 'ASC',
    ]);

    $resolve_image_id = static function ($value): int {
        if (is_array($value) && isset($value['ID'])) {
            return (int) $value['ID'];
        }

        if (is_numeric($value)) {
            return (int) $value;
        }

        return 0;
    };

    $normalize_url_path_slug = static function (string $url): string {
        if ($url === '') {
            return '';
        }

        $path = (string) wp_parse_url($url, PHP_URL_PATH);
        $path = trim($path, '/');

        if ($path === '') {
            return '';
        }

        $segments = explode('/', $path);

        return sanitize_title((string) end($segments));
    };

    $series_cards = [];
    $series_terms_by_slug = [];

    if (!is_wp_error($series_terms) && !empty($series_terms)) {
        foreach ($series_terms as $term) {
            if (!$term instanceof WP_Term) {
                continue;
            }

            $series_terms_by_slug[$term->slug] = $term;
        }
    }

    $build_series_card = static function (WP_Term $term, ?array $legacy_section = null) use ($resolve_image_id, $normalize_url_path_slug, $product_range_button_label): ?array {
        $term_key = 'term_' . $term->term_id;
        $overview_title = trim((string) get_field('category_overview_title', $term_key));
        $overview_subtitle = trim((string) get_field('category_overview_subtitle', $term_key));
        $overview_description = (string) get_field('category_overview_description', $term_key);
        $modal_description = (string) get_field('category_modal_description', $term_key);
        $description = trim((string) ($overview_description !== '' ? $overview_description : ($modal_description !== '' ? $modal_description : term_description($term->term_id, 'tipologia_confezionatrice'))));
        $overview_image_id = $resolve_image_id(get_field('category_overview_image', $term_key));
        $banner_image_id = $resolve_image_id(get_field('category_banner_image', $term_key));
        $button_label = trim((string) get_field('category_overview_button_label', $term_key));
        $highlights = get_field('category_overview_highlights', $term_key);
        $term_link = get_term_link($term);

        if (is_wp_error($term_link)) {
            return null;
        }

        if (is_array($legacy_section)) {
            if ($overview_title === '' && !empty($legacy_section['heading'])) {
                $overview_title = trim((string) $legacy_section['heading']);
            }

            if ($overview_subtitle === '' && !empty($legacy_section['subheading'])) {
                $overview_subtitle = trim((string) $legacy_section['subheading']);
            }

            if ($description === '' && !empty($legacy_section['content'])) {
                $description = trim((string) $legacy_section['content']);
            }
        }

        $image_id = $overview_image_id > 0 ? $overview_image_id : $banner_image_id;

        if ($image_id <= 0 && is_array($legacy_section) && !empty($legacy_section['image'])) {
            $image_id = (int) $legacy_section['image'];
        }

        if ($image_id <= 0) {
            $fallback_machine_ids = get_posts([
                'post_type' => 'packaging_machine',
                'posts_per_page' => 1,
                'fields' => 'ids',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'tax_query' => [
                    [
                        'taxonomy' => 'tipologia_confezionatrice',
                        'field' => 'term_id',
                        'terms' => $term->term_id,
                    ],
                ],
            ]);

            $fallback_machine_id = !empty($fallback_machine_ids) ? (int) $fallback_machine_ids[0] : 0;
            $image_id = $fallback_machine_id ? (int) get_post_thumbnail_id($fallback_machine_id) : 0;
        }

        $normalized_highlights = [];

        if (is_array($highlights)) {
            foreach ($highlights as $highlight) {
                $highlight_text = trim((string) ($highlight['item'] ?? ''));

                if ($highlight_text !== '') {
                    $normalized_highlights[] = $highlight_text;
                }
            }
        }

        if (empty($normalized_highlights) && is_array($legacy_section) && !empty($legacy_section['listed_items']) && is_array($legacy_section['listed_items'])) {
            foreach ($legacy_section['listed_items'] as $highlight) {
                $highlight_text = trim((string) ($highlight['item'] ?? ''));

                if ($highlight_text !== '') {
                    $normalized_highlights[] = $highlight_text;
                }
            }
        }

        if ($button_label === '') {
            $button_label = trim((string) ($legacy_section['link']['title'] ?? ''));
        }

        $button_label = $button_label !== '' ? $button_label : $product_range_button_label;

        return [
            'title' => $overview_title !== '' ? $overview_title : $term->name,
            'subtitle' => $overview_subtitle,
            'description' => $description,
            'highlights' => $normalized_highlights,
            'image_id' => $image_id,
            'url' => $term_link,
            'button_label' => $button_label,
            'slug' => $term->slug,
            'has_editorial_content' => $overview_subtitle !== '' || $description !== '' || !empty($normalized_highlights) || $image_id > 0,
        ];
    };

    $added_term_slugs = [];

    foreach ($legacy_machine_sections as $legacy_section) {
        if (!is_array($legacy_section)) {
            continue;
        }

        $legacy_link_slug = $normalize_url_path_slug((string) ($legacy_section['link']['url'] ?? ''));

        if ($legacy_link_slug === '' || !isset($series_terms_by_slug[$legacy_link_slug])) {
            continue;
        }

        $term = $series_terms_by_slug[$legacy_link_slug];
        $series_card = $build_series_card($term, $legacy_section);

        if ($series_card === null) {
            continue;
        }

        $series_cards[] = $series_card;
        $added_term_slugs[$term->slug] = true;
    }

    if (!is_wp_error($series_terms) && !empty($series_terms)) {
        foreach ($series_terms as $term) {
            if (!$term instanceof WP_Term || isset($added_term_slugs[$term->slug])) {
                continue;
            }

            $series_card = $build_series_card($term);

            if ($series_card === null || empty($series_card['has_editorial_content'])) {
                continue;
            }

            $series_cards[] = $series_card;
        }
    }
    ?>

    <section class="packaging-page">
        <?php if ($hero_eyebrow !== '' || $hero_title !== '' || $hero_text !== '') : ?>
            <section class="packaging-page__hero">
                <div class="packaging-page__inner packaging-page__inner--narrow">
                    <div class="packaging-page__hero-copy">
                        <?php if ($hero_eyebrow !== '') : ?>
                            <p class="packaging-page__eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
                        <?php endif; ?>

                        <?php if ($hero_title !== '') : ?>
                            <h1 class="packaging-page__hero-title"><?php echo esc_html($hero_title); ?></h1>
                        <?php endif; ?>

                        <?php if ($hero_text !== '') : ?>
                            <p class="packaging-page__hero-text"><?php echo esc_html($hero_text); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($series_cards)) : ?>
            <section class="packaging-page__catalog">
                <div class="packaging-page__inner">
                    <?php foreach ($series_cards as $index => $series_card) : ?>
                        <?php $is_reversed = $index % 2 === 1; ?>
                        <article class="packaging-category<?php echo $is_reversed ? ' packaging-category--reverse' : ''; ?>">
                            <div class="packaging-category__media">
                                <?php if ($series_card['image_id']) : ?>
                                    <?php echo wp_get_attachment_image($series_card['image_id'], 'large', false, ['class' => 'packaging-category__image']); ?>
                                <?php endif; ?>
                            </div>

                            <div class="packaging-category__panel">
                                <div class="packaging-category__content">
                                    <h2 class="packaging-category__title"><?php echo esc_html($series_card['title']); ?></h2>

                                    <?php if ($series_card['subtitle'] !== '') : ?>
                                        <p class="packaging-category__subtitle"><?php echo esc_html($series_card['subtitle']); ?></p>
                                    <?php endif; ?>

                                    <?php if ($series_card['description'] !== '') : ?>
                                        <div class="packaging-category__text">
                                            <?php echo wp_kses_post($series_card['description']); ?>
                                        </div>
                                    <?php endif; ?>

                                    <a class="home-button packaging-category__button" href="<?php echo esc_url($series_card['url']); ?>">
                                        <?php echo esc_html($series_card['button_label']); ?>
                                    </a>

                                    <?php if (!empty($series_card['highlights'])) : ?>
                                        <ul class="packaging-category__list" aria-label="<?php echo esc_attr($series_card['title']); ?>">
                                            <?php foreach ($series_card['highlights'] as $highlight) : ?>
                                                <li><?php echo esc_html($highlight); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($cta) : ?>
            <section class="packaging-page__cta">
                <div class="packaging-page__inner packaging-page__inner--narrow">
                    <div class="packaging-page__cta-card">
                        <?php if (!empty($cta['subheading'])) : ?>
                            <p class="packaging-page__eyebrow"><?php echo esc_html($cta['subheading']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($cta['heading'])) : ?>
                            <h2 class="packaging-page__cta-title"><?php echo esc_html($cta['heading']); ?></h2>
                        <?php endif; ?>

                        <?php if (!empty($cta['content'])) : ?>
                            <p class="packaging-page__cta-text"><?php echo esc_html($cta['content']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($cta['link']['url']) && !empty($cta['link']['title'])) : ?>
                            <a
                                class="home-button packaging-page__cta-button"
                                href="<?php echo esc_url(home_url('/contact-us/')); ?>"
                            >
                                <?php echo esc_html($cta['link']['title'] ?: $contact_button_label); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </section>
<?php endwhile; ?>
<?php
get_footer();
