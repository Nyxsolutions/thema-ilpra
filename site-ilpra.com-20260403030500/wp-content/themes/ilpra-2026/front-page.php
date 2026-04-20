<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
$home = ilpra_2026_get_homepage_data();
$featured = new WP_Query([
    'post_type' => 'post',
    'category_name' => 'news',
    'posts_per_page' => 1,
    'post_status' => 'publish',
]);

$news = new WP_Query([
    'post_type' => 'post',
    'category_name' => 'news',
    'posts_per_page' => 6,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
    'offset' => 1,
]);
?>
<!-- Home Page -->
<section class="home-shell">
    <!-- Hero Section -->
    <section class="home-section home-hero">
        <div class="home-section__inner">
            <!-- Hero Media -->
            <div class="home-hero__panel home-hero__panel--video">
                <video class="home-hero__video" playsinline autoplay muted loop poster="<?php echo esc_url($home['hero']['poster']); ?>">
                    <source src="<?php echo esc_url($home['hero']['video_mp4']); ?>" type="video/mp4">
                    <source src="<?php echo esc_url($home['hero']['video_webm']); ?>" type="video/webm">
                </video>

                <div class="home-hero__overlay"></div>

                <!-- Hero Copy -->
                <div class="home-hero__content">
                    <p class="home-kicker"><?php echo esc_html($home['hero']['kicker']); ?></p>
                    <h1 class="home-hero__title"><?php echo esc_html($home['hero']['title']); ?></h1>
                    <p class="home-hero__text"><?php echo esc_html($home['hero']['content']); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Industries Section -->
    <section class="home-section">
        <div class="home-section__inner">
            <header class="home-heading">
                <h2 class="home-heading__title"><?php echo esc_html($home['industry_intro']['title']); ?></h2>
            </header>
            <div class="home-grid home-grid--two">
                <?php foreach ($home['industries'] as $industry) : ?>
                    <article class="home-card home-card--industry">
                        <div class="home-card__media">
                            <?php echo wp_get_attachment_image((int) $industry['image_id'], 'large'); ?>
                        </div>
                        <div class="home-card__body">
                            <h3 class="home-card__title"><?php echo esc_html($industry['title']); ?></h3>
                            <p class="home-card__text"><?php echo esc_html($industry['content']); ?></p>
                            <a class="home-button" href="<?php echo esc_url($industry['button']['url']); ?>">
                                <?php echo esc_html($industry['button']['label']); ?>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Machines Section -->
    <section class="home-section">
        <div class="home-section__inner">
            <header class="home-heading home-heading--split">
                <h2 class="home-heading__title"><?php echo esc_html($home['machines_intro']['title']); ?></h2>
                <div class="home-heading__copy"><?php echo wpautop(esc_html($home['machines_intro']['content'])); ?></div>
            </header>
            <div class="home-grid home-grid--three">
                <?php foreach ($home['machines'] as $machine) : ?>
                    <a class="home-card home-card--machine" href="<?php echo esc_url($machine['url']); ?>">
                        <div class="home-card__media home-card__media--machine">
                            <?php echo wp_get_attachment_image((int) $machine['image_id'], 'large'); ?>
                        </div>
                        <div class="home-card__body">
                            <h3 class="home-card__title"><?php echo esc_html($machine['title']); ?></h3>
                            <p class="home-card__text"><?php echo esc_html($machine['content']); ?></p>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- News And Exhibitions Section -->
    <section class="home-section home-section--news">
        <div class="home-section__inner">
            <header class="home-heading">
                <h2 class="home-heading__title"><?php echo esc_html($home['news_intro']['title']); ?></h2>
            </header>

            <!-- Featured News -->
            <?php if ($featured->have_posts()) : ?>
                <?php while ($featured->have_posts()) : $featured->the_post(); ?>
                    <article class="home-featured-news">
                        <!-- Featured News Media -->
                        <a class="home-featured-news__media" href="<?php the_permalink(); ?>" target="_blank" rel="noreferrer">
                            <?php the_post_thumbnail('large'); ?>
                        </a>

                        <!-- Featured News Copy -->
                        <div class="home-featured-news__body">
                            <h3 class="home-featured-news__title"><?php echo esc_html(wp_trim_words(get_the_title(), 14, '…')); ?></h3>
                            <div class="home-featured-news__copy">
                                <div class="home-featured-news__icon" aria-hidden="true">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/arrow-color.svg'); ?>" alt="">
                                </div>
                                <div class="home-featured-news__content">
                                    <p class="home-featured-news__excerpt">
                                        <?php
                                        $content = wp_strip_all_tags(strip_shortcodes(get_the_content()));
                                        $content = preg_replace('/\b(read more|leggi di più|continua a leggere).*$/i', '', (string) $content);
                                        echo esc_html(wp_trim_words($content, 80, '…'));
                                        ?>
                                    </p>
                                    <a class="home-button home-button--news" href="<?php the_permalink(); ?>" target="_blank" rel="noreferrer">Read more</a>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>

            <!-- News List -->
            <div class="home-news-list">
                <?php if ($news->have_posts()) : ?>
                    <?php while ($news->have_posts()) : $news->the_post(); ?>
                        <a class="home-news-list__item" href="<?php the_permalink(); ?>" target="_blank" rel="noreferrer">
                            <span class="home-news-list__title"><?php echo esc_html(wp_trim_words(get_the_title(), 6, '…')); ?></span>
                            <span class="home-news-list__arrow" aria-hidden="true">
                                <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/arrow-color.svg'); ?>" alt="">
                            </span>
                        </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <!-- Trade Fairs -->
            <div class="home-fairs-grid">
                <?php foreach ($home['fairs'] as $fair) : ?>
                    <a class="home-fair-card" href="<?php echo esc_url($fair['url']); ?>" target="<?php echo esc_attr($fair['target']); ?>" rel="noreferrer">
                        <div class="home-fair-card__top">
                            <div class="home-fair-card__date"><?php echo esc_html($fair['city_date']); ?></div>
                            <div class="home-fair-card__image">
                                <?php echo wp_get_attachment_image((int) $fair['image_id'], 'medium'); ?>
                            </div>
                        </div>
                        <div class="home-fair-card__footer">
                            <div class="home-fair-card__stand"><?php echo esc_html($fair['stand']); ?></div>
                            <div class="home-fair-card__hall"><?php echo esc_html($fair['hall']); ?></div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</section>
<?php
get_footer();
