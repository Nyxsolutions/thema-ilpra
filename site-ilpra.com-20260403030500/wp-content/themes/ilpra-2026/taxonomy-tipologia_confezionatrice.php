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
    'orderby' => 'menu_order',
    'order' => 'ASC',
    'hide_empty' => true,
]);

$machine_ids = get_posts([
    'post_type' => 'packaging_machine',
    'posts_per_page' => -1,
    'fields' => 'ids',
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
    'orderby' => 'menu_order',
    'order' => 'ASC',
]);

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

$technology_descriptions = [];

foreach ($technology_terms as $index => $term) {
    $field_key = 'description_for_tab_' . ($index + 1);
    $technology_descriptions[$term->term_id] = (string) get_field($field_key, 'term_' . $current_term->term_id);
}

$active_technology = $technology_terms[0] ?? null;

$machines_query = new WP_Query([
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
]);
?>

<section class="tm-shell">
    <!-- Category Pills -->
    <section class="tm-section tm-section--slider">
        <div class="tm-inner">
            <div class="tm-pills-nav">
                <button class="tm-arrow tm-arrow-prev" type="button" aria-label="<?php esc_attr_e('Previous category', 'ilpra-2026'); ?>">
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

                <button class="tm-arrow tm-arrow-next" type="button" aria-label="<?php esc_attr_e('Next category', 'ilpra-2026'); ?>">
                    <span>&rsaquo;</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Products -->
    <section class="tm-section tm-section--products">
        <div class="tm-inner">
            <?php if ($active_technology) : ?>
                <div class="tm-products-header">
                    <h1 class="tm-products-title">
                        <span class="tm-title-text"><?php echo esc_html($active_technology->name . ' - ' . $current_term->name); ?></span>
                        <button
                            class="tm-info-trigger"
                            type="button"
                            aria-label="<?php esc_attr_e('Open technology information', 'ilpra-2026'); ?>"
                            data-title="<?php echo esc_attr($active_technology->name . ' - ' . $current_term->name); ?>"
                            data-description="<?php echo esc_attr($technology_descriptions[$active_technology->term_id] ?? ''); ?>"
                        >
                            i
                        </button>
                    </h1>

                    <?php if (!empty($technology_terms)) : ?>
                        <nav class="tm-tech-nav" aria-label="<?php esc_attr_e('Machine technologies', 'ilpra-2026'); ?>">
                            <?php foreach ($technology_terms as $term_index => $term) : ?>
                                <button
                                    class="tm-tech-button<?php echo $term_index === 0 ? ' active' : ''; ?>"
                                    type="button"
                                    data-tech="<?php echo esc_attr($term->term_id); ?>"
                                    data-name="<?php echo esc_attr($term->name); ?>"
                                    data-description="<?php echo esc_attr($technology_descriptions[$term->term_id] ?? ''); ?>"
                                >
                                    <?php echo esc_html($term->name); ?>
                                </button>
                            <?php endforeach; ?>
                        </nav>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="tm-product-grid">
                <?php if ($machines_query->have_posts()) : ?>
                    <?php while ($machines_query->have_posts()) : $machines_query->the_post(); ?>
                        <?php
                        $tech = get_field('tecnologia_confezionatrice');
                        $tech_id = null;

                        if (is_array($tech)) {
                            $tech_id = isset($tech['term_id']) ? (int) $tech['term_id'] : (isset($tech[0]) ? (int) $tech[0] : null);
                        } elseif (is_object($tech) && isset($tech->term_id)) {
                            $tech_id = (int) $tech->term_id;
                        } else {
                            $tech_id = (int) $tech;
                        }

                        $tech_term = $tech_id ? get_term($tech_id, 'tecnologia_confezionatrice') : null;
                        $excerpt = (string) get_field('descrizione_breve_confezionatrice');
                        $is_active_card = $active_technology && (int) $tech_id === (int) $active_technology->term_id;
                        $external_product_url = trim((string) get_field('external_product_url'));
                        $product_button_url = $external_product_url !== '' ? $external_product_url : get_permalink();
                        $product_button_target = $external_product_url !== '' ? '_blank' : '_self';
                        $product_button_rel = $external_product_url !== '' ? 'noreferrer' : '';
                        ?>
                        <article
                            class="tm-product-card"
                            data-tech="<?php echo esc_attr((string) $tech_id); ?>"
                            <?php if (!$is_active_card) : ?>hidden<?php endif; ?>
                        >
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
                                    ><?php esc_html_e('View Product', 'ilpra-2026'); ?></a>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="packaging-page__cta">
        <div class="packaging-page__inner packaging-page__inner--narrow">
            <div class="packaging-page__cta-card">
                <p class="packaging-page__eyebrow">Get in touch</p>
                <h2 class="packaging-page__cta-title">Speak to one of our experts</h2>
                <p class="packaging-page__cta-text">Get in touch with our team for tailored advice on which packaging solution is right for your products.</p>
                <a class="home-button packaging-page__cta-button" href="<?php echo esc_url(home_url('/contact-us/')); ?>">Contact Us</a>
            </div>
        </div>
    </section>
</section>

<div class="tm-modal" hidden data-tm-modal>
    <div class="tm-modal__backdrop" data-tm-modal-close></div>
    <div class="tm-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="tm-modal-title">
        <button class="tm-modal__close" type="button" aria-label="<?php esc_attr_e('Close dialog', 'ilpra-2026'); ?>" data-tm-modal-close>×</button>
        <h2 class="tm-modal__title" id="tm-modal-title" data-tm-modal-title></h2>
        <div class="tm-modal__description" data-tm-modal-description></div>
        <button class="tm-modal__button" type="button" data-tm-modal-close><?php esc_html_e('Got it', 'ilpra-2026'); ?></button>
    </div>
</div>

<?php
get_footer();
