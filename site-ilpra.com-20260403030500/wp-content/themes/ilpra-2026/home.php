<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$posts_page_id = (int) get_option('page_for_posts');
$latest_news_label = ilpra_2026_get_theme_string('string_latest_news_label', 'Latest news', 'Ultime notizie');
$archive_title = $posts_page_id ? get_the_title($posts_page_id) : $latest_news_label;
?>
<section class="content-frame">
    <div class="content-frame__inner">
        <header class="archive-header archive-header--news">
            <h1 class="archive-header__title"><?php echo esc_html($archive_title ?: $latest_news_label); ?></h1>
        </header>

        <?php if (have_posts()) : ?>
            <div class="news-archive-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('news-archive-card'); ?>>
                        <a class="news-archive-card__media" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php endif; ?>
                        </a>

                        <div class="news-archive-card__body">
                            <h2 class="news-archive-card__title">
                                <a href="<?php the_permalink(); ?>"><?php echo esc_html(wp_trim_words(get_the_title(), 12, '...')); ?></a>
                            </h2>

                            <div class="news-archive-card__meta">
                                <time class="news-archive-card__date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date('d.m.Y')); ?>
                                </time>
                                <a class="news-archive-card__arrow" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/arrow-color.svg'); ?>" alt="">
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <article class="entry-card">
                <h1 class="entry-card__title"><?php esc_html_e('Nessun contenuto disponibile.', 'ilpra-2026'); ?></h1>
            </article>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();
