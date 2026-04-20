<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php while (have_posts()) : the_post(); ?>
    <?php if (ilpra_2026_is_elementor_built(get_the_ID())) : ?>
        <article <?php post_class('elementor-entry elementor-entry--full'); ?>>
            <?php the_content(); ?>
        </article>
    <?php else : ?>
        <section class="content-frame">
            <div class="content-frame__inner">
                <article <?php post_class('entry-card entry-card--page'); ?>>
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
