<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="content-frame">
    <div class="content-frame__inner">
        <header class="archive-header archive-header--news">
            <h1 class="archive-header__title"><?php the_archive_title(); ?></h1>
            <div class="archive-header__description"><?php the_archive_description(); ?></div>
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
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();
