<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php
    $job_title = (string) get_field('job_title');
    $company = (string) get_field('company_name');
    $location = (string) get_field('job_location');
    ?>
    <section class="pm-career-single">
        <div class="container">
            <div class="pm-career-single-grid">
                <div class="pm-career-single-content">
                    <a href="<?php echo esc_url(home_url('/career/')); ?>" class="pm-career-back">
                        <span aria-hidden="true">&lsaquo;</span>
                        <span><?php esc_html_e('Back to open positions', 'ilpra-2026'); ?></span>
                    </a>

                    <h1 class="pm-career-single-title">
                        <?php echo esc_html($job_title !== '' ? $job_title : get_the_title()); ?>
                    </h1>

                    <div class="pm-career-single-meta">
                        <?php echo esc_html(trim($company . ' - ' . $location, ' -')); ?>
                    </div>

                    <div class="pm-career-single-text">
                        <?php the_content(); ?>
                    </div>
                </div>

                <div class="pm-career-single-form">
                    <?php echo do_shortcode('[elementor-template id="16214"]'); ?>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; endif; ?>
<?php
get_footer();
