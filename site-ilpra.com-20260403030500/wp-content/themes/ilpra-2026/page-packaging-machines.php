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
    $machine_sections = [];
    $cta = null;

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
                $machine_sections[] = $row;
                continue;
            }

            if ($row['acf_fc_layout'] === 'cta-8' && $cta === null) {
                $cta = $row;
            }
        }
    }
    ?>

    <section class="packaging-page">
        <?php if ($hero) : ?>
            <!-- Packaging Hero -->
            <section class="packaging-page__hero">
                <div class="packaging-page__inner packaging-page__inner--narrow">
                    <div class="packaging-page__hero-copy">
                        <?php if (!empty($hero['subheading'])) : ?>
                            <p class="packaging-page__eyebrow"><?php echo esc_html($hero['subheading']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($hero['heading'])) : ?>
                            <h1 class="packaging-page__hero-title"><?php echo esc_html($hero['heading']); ?></h1>
                        <?php endif; ?>

                        <?php if (!empty($hero['content'])) : ?>
                            <p class="packaging-page__hero-text"><?php echo esc_html($hero['content']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <?php if (!empty($machine_sections)) : ?>
            <!-- Packaging Categories -->
            <section class="packaging-page__catalog">
                <div class="packaging-page__inner">
                    <?php foreach ($machine_sections as $index => $section) : ?>
                        <?php
                        $is_reversed = $index % 2 === 1;
                        $link = $section['link'] ?? [];
                        $items = !empty($section['listed_items']) && is_array($section['listed_items']) ? $section['listed_items'] : [];
                        $image_id = isset($section['image']) ? (int) $section['image'] : 0;
                        ?>
                        <!-- Packaging Category -->
                        <article class="packaging-category<?php echo $is_reversed ? ' packaging-category--reverse' : ''; ?>">
                            <div class="packaging-category__media">
                                <?php if ($image_id) : ?>
                                    <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'packaging-category__image']); ?>
                                <?php endif; ?>
                            </div>

                            <div class="packaging-category__panel">
                                <div class="packaging-category__content">
                                    <?php if (!empty($section['heading'])) : ?>
                                        <h2 class="packaging-category__title"><?php echo esc_html($section['heading']); ?></h2>
                                    <?php endif; ?>

                                    <?php if (!empty($section['subheading'])) : ?>
                                        <p class="packaging-category__subtitle"><?php echo esc_html($section['subheading']); ?></p>
                                    <?php endif; ?>

                                    <?php if (!empty($section['content'])) : ?>
                                        <div class="packaging-category__text">
                                            <p><?php echo esc_html($section['content']); ?></p>
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($items)) : ?>
                                        <ul class="packaging-category__list" aria-label="<?php echo esc_attr($section['heading'] ?? __('Machine highlights', 'ilpra-2026')); ?>">
                                            <?php foreach ($items as $item) : ?>
                                                <?php if (!empty($item['item'])) : ?>
                                                    <li><?php echo esc_html($item['item']); ?></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <?php if (!empty($link['url']) && !empty($link['title'])) : ?>
                                        <a
                                            class="home-button packaging-category__button"
                                            href="<?php echo esc_url($link['url']); ?>"
                                            <?php if (!empty($link['target'])) : ?>target="<?php echo esc_attr($link['target']); ?>"<?php endif; ?>
                                        >
                                            <?php echo esc_html($link['title']); ?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <?php if ($cta) : ?>
            <!-- Packaging CTA -->
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
                                href="<?php echo esc_url($cta['link']['url']); ?>"
                                <?php if (!empty($cta['link']['target'])) : ?>target="<?php echo esc_attr($cta['link']['target']); ?>"<?php endif; ?>
                            >
                                <?php echo esc_html($cta['link']['title']); ?>
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
