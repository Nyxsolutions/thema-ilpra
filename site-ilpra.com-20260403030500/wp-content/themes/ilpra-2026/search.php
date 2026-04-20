<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$searched_term = ilpra_2026_get_current_search_term();
$queried_post_type = get_query_var('post_type');
$is_machine_search = ilpra_2026_is_machine_search_request()
    || $queried_post_type === 'packaging_machine'
    || (is_array($queried_post_type) && in_array('packaging_machine', $queried_post_type, true));
?>
<section class="content-frame">
    <div class="content-frame__inner">
        <header class="archive-header archive-header--news search-results-header">
            <h1 class="archive-header__title">
                <?php
                if ($searched_term) {
                    printf(
                        /* translators: %s: search term */
                        esc_html__('Search results for "%s"', 'ilpra-2026'),
                        esc_html($searched_term)
                    );
                } else {
                    esc_html_e('Search results', 'ilpra-2026');
                }
                ?>
            </h1>
            <div class="archive-header__description search-results-header__description">
                <?php
                echo esc_html(
                    $is_machine_search
                        ? __('Showing packaging machine products only.', 'ilpra-2026')
                        : __('Showing matching results.', 'ilpra-2026')
                );
                ?>
            </div>
        </header>

        <?php if (have_posts()) : ?>
            <div class="search-results-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('search-result-card'); ?>>
                        <a class="search-result-card__media" href="<?php the_permalink(); ?>">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php endif; ?>
                        </a>

                        <div class="search-result-card__body">
                            <h2 class="search-result-card__title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <div class="search-result-card__excerpt">
                                <?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt()), 22, '...')); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
        <?php else : ?>
            <article class="entry-card search-results-empty">
                <h2 class="entry-card__title"><?php esc_html_e('No packaging machines found.', 'ilpra-2026'); ?></h2>
                <div class="entry-card__content">
                    <p><?php esc_html_e('Try another machine model or keyword.', 'ilpra-2026'); ?></p>
                </div>
            </article>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();
