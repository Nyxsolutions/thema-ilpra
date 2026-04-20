<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php if (get_post_type() === 'post') : ?>
        <?php
        $current_id = get_the_ID();
        $fallback_image = get_template_directory_uri() . '/assets/img/placeholder-industrial.png';
        $image_url = get_the_post_thumbnail_url($current_id, 'large') ?: $fallback_image;
        $more_news_args = [
            'post_type' => 'post',
            'posts_per_page' => 3,
            'post__not_in' => [$current_id],
            'category_name' => 'news',
            'no_found_rows' => true,
            'update_post_meta_cache' => false,
            'update_post_term_cache' => false,
            'ignore_sticky_posts' => true,
            'orderby' => 'date',
            'order' => 'DESC',
        ];
        $more_news = new WP_Query($more_news_args);

        if (!$more_news->have_posts()) {
            unset($more_news_args['category_name']);
            $more_news = new WP_Query($more_news_args);
        }
        ?>
        <section class="news-single">
            <div class="news-single__inner">
                <div class="news-single__grid">
                    <article class="news-single__content">
                        <h1 class="news-single__title"><?php the_title(); ?></h1>
                        <div class="news-single__date"><?php echo esc_html(get_the_date('j F Y')); ?></div>
                        <div class="news-single__body">
                            <?php the_content(); ?>
                        </div>
                    </article>

                    <div class="news-single__media">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                    </div>
                </div>

                <?php if ($more_news->have_posts()) : ?>
                    <section class="news-single__more">
                        <h2 class="news-single__more-title"><?php esc_html_e('More ILPRA News', 'ilpra-2026'); ?></h2>
                        <div class="news-single__more-grid">
                            <?php while ($more_news->have_posts()) : $more_news->the_post(); ?>
                                <?php
                                $more_image = get_the_post_thumbnail_url(get_the_ID(), 'large') ?: $fallback_image;
                                ?>
                                <article class="news-single-card">
                                    <a class="news-single-card__link" href="<?php the_permalink(); ?>">
                                        <div class="news-single-card__image">
                                            <img src="<?php echo esc_url($more_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                        </div>
                                        <div class="news-single-card__content">
                                            <h3 class="news-single-card__title"><?php the_title(); ?></h3>
                                            <div class="news-single-card__meta">
                                                <span class="news-single-card__date"><?php echo esc_html(get_the_date('d.m.Y')); ?></span>
                                                <span class="news-single-card__arrow" aria-hidden="true">&rarr;</span>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    </section>
                <?php endif; ?>
            </div>
        </section>
    <?php elseif (ilpra_2026_is_elementor_built(get_the_ID())) : ?>
        <article <?php post_class('elementor-entry elementor-entry--full'); ?>>
            <?php the_content(); ?>
        </article>
    <?php else : ?>
        <section class="content-frame">
            <div class="content-frame__inner">
                <article <?php post_class('entry-card entry-card--single'); ?>>
                    <header class="entry-card__header">
                        <h1 class="entry-card__title"><?php the_title(); ?></h1>
                    </header>
                    <div class="entry-card__content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>
        </section>
    <?php endif; ?>
<?php endwhile; ?>
<?php
get_footer();
