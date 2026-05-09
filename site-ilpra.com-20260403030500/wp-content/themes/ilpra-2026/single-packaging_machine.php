<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php
    $image_id = get_post_thumbnail_id();
    $image_alt = $image_id ? get_post_meta($image_id, '_wp_attachment_image_alt', true) : '';

    $technology_field = get_field('tecnologia_confezionatrice');
    $technology_name = '';

    if (is_object($technology_field) && isset($technology_field->name)) {
        $technology_name = $technology_field->name;
    } elseif (is_numeric($technology_field)) {
        $technology_term = get_term((int) $technology_field, 'tecnologia_confezionatrice');
        $technology_name = ($technology_term && !is_wp_error($technology_term)) ? $technology_term->name : '';
    }

    $detail_fields = [
        [
            'image' => 'immagine_dettaglio_uno',
            'title' => 'titolo_dettaglio_uno',
            'description' => 'descrizione_dettaglio_uno',
        ],
        [
            'image' => 'immagine_dettaglio_due',
            'title' => 'titolo_dettaglio_due',
            'description' => 'descrizione_dettaglio_due',
        ],
        [
            'image' => 'immagine_dettaglio_tre',
            'title' => 'titolo_dettaglio_tre',
            'description' => 'descrizione_dettaglio_tre',
        ],
        [
            'image' => 'immagine_dettaglio__quattro',
            'title' => 'titolo_dettaglio_quattro',
            'description' => 'descrizione_dettaglio_quattro',
        ],
    ];

    $details = [];

    foreach ($detail_fields as $detail_index => $detail_field) {
        $detail_image = get_field($detail_field['image']);
        $detail_title = (string) get_field($detail_field['title']);
        $detail_description = (string) get_field($detail_field['description']);

        if (!$detail_image && $detail_title === '' && $detail_description === '') {
            continue;
        }

        $details[] = [
            'id' => 'pm-detail-' . ($detail_index + 1),
            'image_id' => (int) $detail_image,
            'title' => $detail_title,
            'description' => $detail_description,
        ];
    }

    $full_description = (string) get_field('descrizione_estesa_confezionatrice');
    $packaging_types = get_field('tipi_di_confezione');
    $technical_rows = get_field('dati_tecnici');
    $videos = [];
    $modules = get_field('repeter_moduli');
    $gallery_images = get_field('gallery_immagini_confezioni');

    for ($video_index = 1; $video_index <= 6; $video_index++) {
        $video_id = get_field('upload_video' . ($video_index > 1 ? '_' . $video_index : ''));
        $video_title = get_field('video_title_' . $video_index);

        if (!empty($video_id)) {
            $videos[] = [
                'id' => $video_id,
                'title' => $video_title,
            ];
        }
    }

    $header_row = is_array($technical_rows) && !empty($technical_rows) ? $technical_rows[0] : null;
    $data_rows = is_array($technical_rows) && count($technical_rows) > 1 ? array_slice($technical_rows, 1) : [];
    $column_count = 1;

    if (!empty($header_row['dato_colonna_2'])) {
        $column_count = 2;
    }
    if (!empty($header_row['dato_colonna_3'])) {
        $column_count = 3;
    }
    if (!empty($header_row['dato_colonna_4'])) {
        $column_count = 4;
    }
    ?>

    <section class="pm-page">
        <!-- Machine Hero -->
        <section class="pm-hero">
            <div class="pm-inner">
                <div class="pm-hero__grid">
                    <div class="pm-hero__media">
                        <?php if ($image_id) : ?>
                            <div class="pm-hero__image">
                                <?php echo wp_get_attachment_image($image_id, 'large', false, ['alt' => $image_alt]); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="pm-hero__content">
                        <?php if ($technology_name !== '') : ?>
                            <span class="pm-hero__eyebrow"><?php echo esc_html($technology_name); ?></span>
                        <?php endif; ?>

                        <h1 class="pm-hero__title"><?php the_title(); ?></h1>

                        <?php if (($mid_description = (string) get_field('mid_description')) !== '') : ?>
                            <div class="pm-hero__description"><?php echo wp_kses_post($mid_description); ?></div>
                        <?php endif; ?>

                        <a href="#request-quote" class="pm-button" data-pm-quote-trigger>Request a Quote</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="pm-mobile-cta" hidden data-pm-mobile-cta>
            <div class="pm-mobile-cta__inner">
                <a href="#request-quote" class="pm-button pm-mobile-cta__button">Request a Quote</a>
            </div>
        </div>

        <?php if (!empty($details) && ($details_title = (string) get_field('titolo_sezione_dettagli')) !== '') : ?>
            <!-- Details Section -->
            <section class="pm-details" data-pm-details>
                <div class="pm-inner">
                    <h2 class="pm-section-title"><?php echo esc_html($details_title); ?></h2>

                    <div class="pm-details__grid">
                        <div class="pm-details__rail" data-pm-details-list>
                            <?php foreach ($details as $index => $detail) : ?>
                                <article class="pm-detail-card<?php echo $index === 0 ? ' is-active' : ''; ?>" id="<?php echo esc_attr($detail['id']); ?>" data-detail-target="<?php echo esc_attr($detail['id']); ?>">
                                    <div class="pm-detail-card__marker" aria-hidden="true">
                                        <span class="pm-detail-card__marker-inner"></span>
                                    </div>

                                    <div class="pm-detail-card__body">
                                        <?php if ($detail['image_id']) : ?>
                                            <div class="pm-detail-card__image pm-detail-card__image--mobile">
                                                <?php echo wp_get_attachment_image($detail['image_id'], 'large'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="pm-detail-card__words">
                                            <?php if ($detail['title'] !== '') : ?>
                                                <h3 class="pm-detail-card__title"><?php echo esc_html($detail['title']); ?></h3>
                                            <?php endif; ?>

                                            <?php if ($detail['description'] !== '') : ?>
                                                <div class="pm-detail-card__description">
                                                    <?php echo wp_kses_post($detail['description']); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>
                        </div>

                        <div class="pm-details__sticky">
                            <?php foreach ($details as $index => $detail) : ?>
                                <?php if ($detail['image_id']) : ?>
                                    <div class="pm-detail-preview<?php echo $index === 0 ? ' is-active' : ''; ?>" data-detail-preview="<?php echo esc_attr($detail['id']); ?>">
                                        <?php echo wp_get_attachment_image($detail['image_id'], 'large'); ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Machine Accordion -->
        <section class="pm-accordion">
            <div class="pm-inner">
                <?php if ($full_description !== '' || !empty($packaging_types)) : ?>
                    <article class="pm-accordion__item">
                        <button class="pm-accordion__header" type="button" aria-expanded="false">
                            <span class="pm-accordion__title">Full Description</span>
                            <span class="pm-accordion__icon"></span>
                        </button>

                        <div class="pm-accordion__content">
                            <div class="pm-accordion__inner">
                                <?php if ($full_description !== '') : ?>
                                    <div class="pm-description"><?php echo wp_kses_post($full_description); ?></div>
                                <?php endif; ?>

                                <?php if (!empty($packaging_types) && is_array($packaging_types)) : ?>
                                    <div class="pm-icon-grid">
                                        <?php foreach ($packaging_types as $term_id) : ?>
                                            <?php
                                            $term = get_term($term_id);

                                            if (!$term || is_wp_error($term)) {
                                                continue;
                                            }

                                            $term_image = get_field('immagine_tipo_di_confezione', 'term_' . $term_id);
                                            $term_image_url = '';

                                            if (is_array($term_image) && isset($term_image['url'])) {
                                                $term_image_url = $term_image['url'];
                                            } elseif (is_numeric($term_image)) {
                                                $term_image_url = wp_get_attachment_image_url((int) $term_image, 'medium');
                                            } elseif (is_string($term_image)) {
                                                $term_image_url = $term_image;
                                            }
                                            ?>
                                            <div class="pm-icon-card">
                                                <?php if ($term_image_url !== '') : ?>
                                                    <div class="pm-icon-card__image">
                                                        <img src="<?php echo esc_url($term_image_url); ?>" alt="<?php echo esc_attr($term->name); ?>">
                                                    </div>
                                                <?php endif; ?>
                                                <div class="pm-icon-card__label"><?php echo esc_html($term->name); ?></div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>

                <?php if ($header_row && !empty($data_rows)) : ?>
                    <article class="pm-accordion__item">
                        <button class="pm-accordion__header" type="button" aria-expanded="false">
                            <span class="pm-accordion__title">Technical Data</span>
                            <span class="pm-accordion__icon"></span>
                        </button>

                        <div class="pm-accordion__content">
                            <div class="pm-accordion__inner">
                                <div class="pm-tech-grid pm-tech-grid--cols-<?php echo esc_attr((string) $column_count); ?>">
                                    <div class="pm-tech-row pm-tech-row--header">
                                        <div class="pm-tech-label"><?php echo esc_html($header_row['dato_colonna_1']); ?></div>
                                        <?php if ($column_count >= 2) : ?><div class="pm-tech-value"><?php echo esc_html($header_row['dato_colonna_2']); ?></div><?php endif; ?>
                                        <?php if ($column_count >= 3) : ?><div class="pm-tech-value"><?php echo esc_html($header_row['dato_colonna_3']); ?></div><?php endif; ?>
                                        <?php if ($column_count >= 4) : ?><div class="pm-tech-value"><?php echo esc_html($header_row['dato_colonna_4']); ?></div><?php endif; ?>
                                    </div>

                                    <?php foreach ($data_rows as $row) : ?>
                                        <div class="pm-tech-row">
                                            <div class="pm-tech-label"><?php echo esc_html($row['dato_colonna_1']); ?></div>
                                            <?php if ($column_count >= 2) : ?><div class="pm-tech-value"><?php echo esc_html($row['dato_colonna_2']); ?></div><?php endif; ?>
                                            <?php if ($column_count >= 3) : ?><div class="pm-tech-value"><?php echo esc_html($row['dato_colonna_3']); ?></div><?php endif; ?>
                                            <?php if ($column_count >= 4) : ?><div class="pm-tech-value"><?php echo esc_html($row['dato_colonna_4']); ?></div><?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>

                <?php if (!empty($videos)) : ?>
                    <article class="pm-accordion__item">
                        <button class="pm-accordion__header" type="button" aria-expanded="false">
                            <span class="pm-accordion__title">Videos</span>
                            <span class="pm-accordion__icon"></span>
                        </button>

                        <div class="pm-accordion__content">
                            <div class="pm-accordion__inner">
                                <div class="pm-video-grid">
                                    <?php foreach ($videos as $video) : ?>
                                        <div class="pm-video-card">
                                            <div class="pm-video-wrapper">
                                                <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($video['id']); ?>" allowfullscreen loading="lazy"></iframe>
                                            </div>
                                            <?php if (!empty($video['title'])) : ?>
                                                <div class="pm-video-title"><?php echo esc_html($video['title']); ?></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>

                <?php if (!empty($modules) && is_array($modules)) : ?>
                    <article class="pm-accordion__item">
                        <button class="pm-accordion__header" type="button" aria-expanded="false">
                            <span class="pm-accordion__title">Technology</span>
                            <span class="pm-accordion__icon"></span>
                        </button>

                        <div class="pm-accordion__content">
                            <div class="pm-accordion__inner">
                                <div class="pm-tech-module-grid">
                                    <?php foreach ($modules as $module) : ?>
                                        <?php
                                        $module_html = (string) ($module['descrizione_modulo'] ?? '');
                                        $module_title = '';
                                        $module_description = $module_html;

                                        if ($module_html !== '' && preg_match('/<p>\s*<strong>(.*?)<\/strong>\s*<\/p>/is', $module_html, $matches)) {
                                            $module_title = wp_strip_all_tags($matches[1]);
                                            $module_description = preg_replace('/<p>\s*<strong>.*?<\/strong>\s*<\/p>/is', '', $module_html, 1);
                                        }
                                        ?>
                                        <div class="pm-tech-module-card">
                                            <div class="pm-tech-module-card__media">
                                                <?php if (!empty($module['immagine_modulo'])) : ?>
                                                    <img class="pm-tech-module-icon" src="<?php echo esc_url($module['immagine_modulo']); ?>" alt="">
                                                <?php endif; ?>
                                            </div>

                                            <div class="pm-tech-module-card__body">
                                                <?php if ($module_title !== '') : ?>
                                                    <h3 class="pm-tech-module-title"><?php echo esc_html($module_title); ?></h3>
                                                <?php endif; ?>

                                                <?php if (trim(wp_strip_all_tags($module_description)) !== '') : ?>
                                                    <div class="pm-tech-module-content"><?php echo wp_kses_post($module_description); ?></div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endif; ?>
            </div>
        </section>

        <?php if (!empty($gallery_images) && is_array($gallery_images)) : ?>
            <!-- Product Gallery -->
            <section class="pm-gallery">
                <div class="pm-inner">
                    <h2 class="pm-section-title">Product Gallery</h2>

                    <div class="pm-gallery__slider" data-pm-gallery>
                        <button class="pm-gallery__arrow pm-gallery__arrow--prev" type="button" aria-label="Previous gallery items" data-pm-gallery-prev>
                            <span>&lsaquo;</span>
                        </button>

                        <div class="pm-gallery__viewport">
                            <div class="pm-gallery__track" data-pm-gallery-track>
                                <?php foreach ($gallery_images as $gallery_image) : ?>
                                    <a href="<?php echo esc_url($gallery_image['url']); ?>" class="pm-gallery__item" target="_blank" rel="noreferrer">
                                        <img src="<?php echo esc_url($gallery_image['sizes']['large'] ?? $gallery_image['url']); ?>" alt="<?php echo esc_attr($gallery_image['alt'] ?? ''); ?>">
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <button class="pm-gallery__arrow pm-gallery__arrow--next" type="button" aria-label="Next gallery items" data-pm-gallery-next>
                            <span>&rsaquo;</span>
                        </button>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Request Quote -->
        <section id="request-quote" class="pm-contact-form">
            <div class="pm-inner">
                <?php echo do_shortcode('[elementor-template id="15850"]'); ?>
            </div>
        </section>
    </section>
<?php endwhile; ?>
<?php
get_footer();
