<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$current_term = get_queried_object();

if (!$current_term instanceof WP_Term || $current_term->taxonomy !== 'tipologia_confezionatrice') {
    get_footer();
    return;
}

$all_terms = get_terms([
    'taxonomy' => 'tipologia_confezionatrice',
    'orderby' => 'term_order',
    'order' => 'ASC',
    'hide_empty' => true,
]);

$machine_ids = get_posts([
    'post_type' => 'packaging_machine',
    'posts_per_page' => -1,
    'fields' => 'ids',
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'tax_query' => [
        [
            'taxonomy' => 'tipologia_confezionatrice',
            'field' => 'term_id',
            'terms' => $current_term->term_id,
        ],
    ],
]);

$technology_terms = get_terms([
    'taxonomy' => 'tecnologia_confezionatrice',
    'hide_empty' => true,
    'orderby' => 'term_order',
    'order' => 'ASC',
]);

$normalize_term_id = static function ($value): int {
    if (is_array($value)) {
        if (isset($value['term_id'])) {
            return (int) $value['term_id'];
        }

        if (isset($value[0])) {
            return (int) $value[0];
        }
    }

    if (is_object($value) && isset($value->term_id)) {
        return (int) $value->term_id;
    }

    return (int) $value;
};

$technology_terms = array_values(array_filter($technology_terms, static function ($term) use ($machine_ids): bool {
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

$category_modal_description = (string) get_field('category_modal_description', 'term_' . $current_term->term_id);
$category_description = trim((string) ($category_modal_description !== '' ? $category_modal_description : term_description($current_term->term_id, 'tipologia_confezionatrice')));
$category_faq_items = get_field('category_faq_items', 'term_' . $current_term->term_id);

$category_technology_modal_rows = get_field('category_technology_modal_items', 'term_' . $current_term->term_id);
$category_technology_modal_descriptions = [];

if (is_array($category_technology_modal_rows)) {
    foreach ($category_technology_modal_rows as $row) {
        $technology_term_id = $normalize_term_id($row['technology_term'] ?? null);

        if ($technology_term_id <= 0) {
            continue;
        }

        $category_technology_modal_descriptions[$technology_term_id] = trim((string) ($row['modal_description'] ?? ''));
    }
}

$technology_modal_descriptions = [];

foreach ($technology_terms as $term) {
    $technology_modal_description = (string) get_field('technology_modal_description', 'term_' . $term->term_id);
    $technology_term_description = trim((string) term_description($term->term_id, 'tecnologia_confezionatrice'));
    $category_specific_modal_description = $category_technology_modal_descriptions[$term->term_id] ?? '';

    $technology_modal_descriptions[$term->term_id] = trim((string) (
        $category_specific_modal_description !== ''
            ? $category_specific_modal_description
            : ($technology_modal_description !== '' ? $technology_modal_description : $technology_term_description)
    ));
}

$requested_technology_slug = isset($_GET['tech']) ? sanitize_title(wp_unslash((string) $_GET['tech'])) : '';
$requested_technology = null;

if ($requested_technology_slug !== '') {
    foreach ($technology_terms as $technology_term) {
        if ($technology_term->slug === $requested_technology_slug) {
            $requested_technology = $technology_term;
            break;
        }
    }
}

$has_technology_groups = !empty($technology_terms);
$is_overview_mode = $has_technology_groups && !$requested_technology;
$active_technology = $requested_technology;
$active_technology_description = $active_technology ? ($technology_modal_descriptions[$active_technology->term_id] ?? '') : '';
$active_machine_ids = [];
$previous_category_label = ilpra_2026_get_theme_string('string_previous_category_label', 'Previous category', 'Categoria precedente');
$next_category_label = ilpra_2026_get_theme_string('string_next_category_label', 'Next category', 'Categoria successiva');
$view_product_label = ilpra_2026_get_theme_string('string_view_product_label', 'View Product', 'Scopri prodotto');
$faq_label = ilpra_2026_get_theme_string('string_faq_label', 'FAQ', 'FAQ');
$open_technology_information_label = ilpra_2026_get_theme_string('string_open_technology_information_label', 'Open technology information', 'Apri informazioni tecnologia');
$machine_technologies_label = ilpra_2026_get_theme_string('string_machine_technologies_label', 'Machine technologies', 'Tecnologie macchina');
$cta_eyebrow = ilpra_2026_get_theme_string('string_cta_eyebrow', 'Get in touch', 'Contattaci');
$cta_title = ilpra_2026_get_theme_string('string_cta_title', 'Speak to one of our experts', 'Parla con uno dei nostri esperti');
$cta_text = ilpra_2026_get_theme_string('string_cta_text', 'Get in touch with our team for tailored advice on which packaging solution is right for your products.', 'Contatta il nostro team per ricevere un consiglio su misura e trovare la soluzione di confezionamento piu adatta ai tuoi prodotti.');
$contact_button_label = ilpra_2026_get_theme_string('string_contact_button_label', 'Contact Us', 'Contattaci');
$close_dialog_label = ilpra_2026_get_theme_string('string_close_dialog_label', 'Close dialog', 'Chiudi finestra');
$modal_confirm_label = ilpra_2026_get_theme_string('string_modal_confirm_label', 'Got it', 'Ho capito');

if ($active_technology) {
    foreach ($machine_ids as $machine_id) {
        $tech_id = $normalize_term_id(get_field('tecnologia_confezionatrice', $machine_id));

        if ($tech_id === (int) $active_technology->term_id) {
            $active_machine_ids[] = (int) $machine_id;
        }
    }
}

$machine_query_args = [
    'post_type' => 'packaging_machine',
    'posts_per_page' => -1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'tax_query' => [
        [
            'taxonomy' => 'tipologia_confezionatrice',
            'field' => 'term_id',
            'terms' => $current_term->term_id,
        ],
    ],
];

if ($active_technology) {
    $machine_query_args['post__in'] = !empty($active_machine_ids) ? $active_machine_ids : [0];
    $machine_query_args['orderby'] = 'post__in';
}

$machines_query = new WP_Query($machine_query_args);
$group_cards = [];

if ($is_overview_mode) {
    foreach ($technology_terms as $technology_term) {
        $technology_machine_ids = [];

        foreach ($machine_ids as $machine_id) {
            $tech_id = $normalize_term_id(get_field('tecnologia_confezionatrice', $machine_id));

            if ($tech_id === (int) $technology_term->term_id) {
                $technology_machine_ids[] = (int) $machine_id;
            }
        }

        if (empty($technology_machine_ids)) {
            continue;
        }

        $technology_machine_query = new WP_Query([
            'post_type' => 'packaging_machine',
            'posts_per_page' => 1,
            'orderby' => 'post__in',
            'post__in' => $technology_machine_ids,
        ]);

        if (!$technology_machine_query->have_posts()) {
            wp_reset_postdata();
            continue;
        }

        $technology_machine_query->the_post();

        $group_cards[] = [
            'name' => $technology_term->name,
            'subtitle' => trim(wp_strip_all_tags($technology_modal_descriptions[$technology_term->term_id] ?? '')),
            'image_html' => has_post_thumbnail() ? get_the_post_thumbnail(get_the_ID(), 'large') : '',
            'url' => add_query_arg('tech', $technology_term->slug, get_term_link($current_term)),
        ];

        wp_reset_postdata();
    }
}
?>

<section class="tm-shell">
    <section class="tm-section tm-section--slider">
        <div class="tm-inner">
            <div class="tm-pills-nav">
                <button class="tm-arrow tm-arrow-prev" type="button" aria-label="<?php echo esc_attr($previous_category_label); ?>">
                    <span>&lsaquo;</span>
                </button>

                <div class="tm-pills-track" data-tm-pills-track>
                    <?php foreach ($all_terms as $term) : ?>
                        <?php
                        $image_id = (int) get_field('category_banner_image', 'term_' . $term->term_id);
                        $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';
                        $is_active = (int) $term->term_id === (int) $current_term->term_id;
                        ?>
                        <a href="<?php echo esc_url(get_term_link($term)); ?>" class="tm-pill<?php echo $is_active ? ' active' : ''; ?>">
                            <span class="tm-pill-image">
                                <?php if ($image_id) : ?>
                                    <?php echo wp_get_attachment_image($image_id, 'medium', false, ['alt' => $image_alt]); ?>
                                <?php endif; ?>
                            </span>
                            <span class="tm-pill-title"><?php echo esc_html($term->name); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>

                <button class="tm-arrow tm-arrow-next" type="button" aria-label="<?php echo esc_attr($next_category_label); ?>">
                    <span>&rsaquo;</span>
                </button>
            </div>
        </div>
    </section>

    <section class="tm-section tm-section--products">
        <div class="tm-inner">
            <?php if ($is_overview_mode) : ?>
                <div class="tm-group-header">
                    <h1 class="tm-group-title">
                        <span class="tm-title-text"><?php echo esc_html($current_term->name); ?></span>
                    </h1>

                    <?php if ($category_description !== '') : ?>
                        <div class="tm-group-description">
                            <?php echo wp_kses_post($category_description); ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($group_cards)) : ?>
                    <div class="tm-product-grid tm-product-grid--group">
                        <?php foreach ($group_cards as $group_card) : ?>
                            <a href="<?php echo esc_url($group_card['url']); ?>" class="tm-product-card tm-product-card--group">
                                <span class="tm-product-image tm-product-image--group">
                                    <?php echo $group_card['image_html']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </span>
                                <span class="tm-product-content tm-product-content--group">
                                    <span class="tm-product-title tm-product-title--group"><?php echo esc_html($group_card['name']); ?></span>
                                    <?php if ($group_card['subtitle'] !== '') : ?>
                                        <span class="tm-product-excerpt tm-product-excerpt--group"><?php echo esc_html($group_card['subtitle']); ?></span>
                                    <?php endif; ?>
                                    <span class="tm-product-footer tm-product-footer--group">
                                        <span class="tm-product-button" aria-hidden="true"><?php echo esc_html($view_product_label); ?></span>
                                    </span>
                                </span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <?php
                $has_category_faq_items = false;

                if (is_array($category_faq_items)) {
                    foreach ($category_faq_items as $faq_item) {
                        $question = trim((string) ($faq_item['question'] ?? ''));
                        $answer = trim((string) ($faq_item['answer'] ?? ''));

                        if ($question !== '' && $answer !== '') {
                            $has_category_faq_items = true;
                            break;
                        }
                    }
                }
                ?>

                <?php if ($has_category_faq_items) : ?>
                    <section class="tm-faq">
                        <div class="tm-faq__header">
                            <h2 class="tm-faq__title"><?php echo esc_html($faq_label); ?></h2>
                        </div>

                        <div class="pm-accordion">
                            <?php foreach ($category_faq_items as $faq_item) : ?>
                                <?php
                                $question = trim((string) ($faq_item['question'] ?? ''));
                                $answer = trim((string) ($faq_item['answer'] ?? ''));

                                if ($question === '' || $answer === '') {
                                    continue;
                                }
                                ?>
                                <article class="pm-accordion__item">
                                    <button class="pm-accordion__header" type="button" aria-expanded="false">
                                        <span class="pm-accordion__title"><?php echo esc_html($question); ?></span>
                                        <span class="pm-accordion__icon"></span>
                                    </button>

                                    <div class="pm-accordion__content">
                                        <div class="pm-accordion__inner">
                                            <div class="tm-faq__answer"><?php echo wp_kses_post($answer); ?></div>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </section>
                <?php endif; ?>
            <?php else : ?>
                <div class="tm-products-header">
                    <div class="tm-products-heading">
                        <h1 class="tm-products-title">
                            <span class="tm-title-text">
                                <?php
                                if ($active_technology) {
                                    echo esc_html($active_technology->name . ' - ' . $current_term->name);
                                } else {
                                    echo esc_html($current_term->name);
                                }
                                ?>
                            </span>
                            <button
                                class="tm-info-trigger"
                                type="button"
                                aria-label="<?php echo esc_attr($open_technology_information_label); ?>"
                                data-title="<?php echo esc_attr($active_technology ? ($active_technology->name . ' - ' . $current_term->name) : $current_term->name); ?>"
                                data-description="<?php echo esc_attr(wp_kses_post($active_technology ? $active_technology_description : $category_description)); ?>"
                            >
                                i
                            </button>
                        </h1>

                    </div>

                    <?php if (!empty($technology_terms)) : ?>
                        <nav class="tm-tech-nav" aria-label="<?php echo esc_attr($machine_technologies_label); ?>">
                            <?php foreach ($technology_terms as $term) : ?>
                                <a
                                    href="<?php echo esc_url(add_query_arg('tech', $term->slug, get_term_link($current_term))); ?>"
                                    class="tm-tech-button<?php echo ($active_technology && (int) $term->term_id === (int) $active_technology->term_id) ? ' active' : ''; ?>"
                                    data-tech="<?php echo esc_attr((string) $term->term_id); ?>"
                                    data-name="<?php echo esc_attr($term->name); ?>"
                                    data-description="<?php echo esc_attr(wp_kses_post($technology_modal_descriptions[$term->term_id] ?? '')); ?>"
                                >
                                    <?php echo esc_html($term->name); ?>
                                </a>
                            <?php endforeach; ?>
                        </nav>
                    <?php endif; ?>
                </div>

                <div class="tm-product-grid">
                    <?php if ($machines_query->have_posts()) : ?>
                        <?php while ($machines_query->have_posts()) : $machines_query->the_post(); ?>
                            <?php
                            $tech = get_field('tecnologia_confezionatrice');
                            $tech_id = $normalize_term_id($tech);
                            $tech_term = $tech_id ? get_term($tech_id, 'tecnologia_confezionatrice') : null;
                            $excerpt = (string) get_field('descrizione_breve_confezionatrice');
                            $external_product_url = trim((string) get_field('external_product_url'));
                            $product_button_url = $external_product_url !== '' ? $external_product_url : get_permalink();
                            $product_button_target = $external_product_url !== '' ? '_blank' : '_self';
                            $product_button_rel = $external_product_url !== '' ? 'noreferrer' : '';
                            ?>
                            <article class="tm-product-card">
                                <a class="tm-product-image" href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('large'); ?>
                                    <?php endif; ?>
                                </a>

                                <div class="tm-product-content">
                                    <div class="tm-product-meta">
                                        <?php
                                        if ($tech_term && !is_wp_error($tech_term)) {
                                            echo esc_html($tech_term->name . ' - ' . $current_term->name);
                                        } else {
                                            echo esc_html($current_term->name);
                                        }
                                        ?>
                                    </div>

                                    <h2 class="tm-product-title"><?php the_title(); ?></h2>

                                    <?php if ($excerpt !== '') : ?>
                                        <div class="tm-product-excerpt"><?php echo wp_kses_post($excerpt); ?></div>
                                    <?php endif; ?>

                                    <div class="tm-product-footer">
                                        <a
                                            href="<?php echo esc_url($product_button_url); ?>"
                                            class="tm-product-button"
                                            target="<?php echo esc_attr($product_button_target); ?>"
                                            <?php if ($product_button_rel !== '') : ?>rel="<?php echo esc_attr($product_button_rel); ?>"<?php endif; ?>
                                        ><?php echo esc_html($view_product_label); ?></a>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <section class="packaging-page__cta">
        <div class="packaging-page__inner packaging-page__inner--narrow">
            <div class="packaging-page__cta-card">
                <p class="packaging-page__eyebrow"><?php echo esc_html($cta_eyebrow); ?></p>
                <h2 class="packaging-page__cta-title"><?php echo esc_html($cta_title); ?></h2>
                <p class="packaging-page__cta-text"><?php echo esc_html($cta_text); ?></p>
                <a class="home-button packaging-page__cta-button" href="<?php echo esc_url(home_url('/contact-us/')); ?>"><?php echo esc_html($contact_button_label); ?></a>
            </div>
        </div>
    </section>
</section>

<div class="tm-modal" hidden data-tm-modal>
    <div class="tm-modal__backdrop" data-tm-modal-close></div>
    <div class="tm-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="tm-modal-title">
        <button class="tm-modal__close" type="button" aria-label="<?php echo esc_attr($close_dialog_label); ?>" data-tm-modal-close>×</button>
        <h2 class="tm-modal__title" id="tm-modal-title" data-tm-modal-title></h2>
        <div class="tm-modal__description" data-tm-modal-description></div>
        <button class="tm-modal__button" type="button" data-tm-modal-close><?php echo esc_html($modal_confirm_label); ?></button>
    </div>
</div>

<?php
get_footer();
