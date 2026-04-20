<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="content-frame">
    <div class="content-frame__inner">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('entry-card'); ?>>
                    <header class="entry-card__header">
                        <h1 class="entry-card__title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </h1>
                    </header>
                    <div class="entry-card__content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <article class="entry-card">
                <h1 class="entry-card__title"><?php esc_html_e('Nessun contenuto disponibile.', 'ilpra-2026'); ?></h1>
            </article>
        <?php endif; ?>
    </div>
</section>
<?php
get_footer();

