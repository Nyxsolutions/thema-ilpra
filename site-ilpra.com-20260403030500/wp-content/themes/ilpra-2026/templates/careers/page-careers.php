<?php
/**
 * Template Name: Careers Listing
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<section class="pm-careers">
    <div class="container-career">
        <h1 class="title-careers"><?php esc_html_e('Careers at ILPRA', 'ilpra-2026'); ?></h1>

        <div class="pm-careers-grid">
            <?php
            $query = new WP_Query([
                'post_type' => 'careers',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'no_found_rows' => true,
                'update_post_meta_cache' => false,
                'update_post_term_cache' => false,
            ]);

            if ($query->have_posts()) :
                while ($query->have_posts()) :
                    $query->the_post();

                    $job_title = (string) get_field('job_title');
                    $company_name = (string) get_field('company_name');
                    $job_location = (string) get_field('job_location');
                    ?>
                    <article class="pm-career-card">
                        <a href="<?php the_permalink(); ?>" class="pm-career-link">
                            <div class="pm-career-content">
                                <h3 class="pm-career-title"><?php echo esc_html($job_title !== '' ? $job_title : get_the_title()); ?></h3>
                                <div class="pm-career-meta">
                                    <?php echo esc_html(trim($company_name . ' - ' . $job_location, ' -')); ?>
                                </div>
                            </div>
                            <div class="pm-career-arrow" aria-hidden="true">&rsaquo;</div>
                        </a>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<section class="pm-career-extra">
    <div class="pm-career-apply">
        <div class="pm-career-apply-grid">
            <div class="pm-career-apply-text">
                <p><?php esc_html_e('Joining the ILPRA Group means becoming part of a historic organization, founded in 1955, that is open, solid, and constantly evolving. We have always invested in research and development of innovative solutions, creating cutting-edge products for the packaging sector.', 'ilpra-2026'); ?></p>
                <p><?php esc_html_e('For over 70 years, we have been a global benchmark, synonymous with experience, quality, and reliability.', 'ilpra-2026'); ?></p>
                <p><?php esc_html_e('Do you want to join the ILPRA world? Fill out the application form. If your profile matches our open positions, we will contact you.', 'ilpra-2026'); ?></p>
                <p><strong><?php esc_html_e('ILPRA guarantees equal opportunities:', 'ilpra-2026'); ?></strong> <?php esc_html_e('all job postings are open to candidates of all genders, in compliance with current regulations.', 'ilpra-2026'); ?></p>
            </div>
            <div class="pm-career-apply-form">
                <?php echo do_shortcode('[elementor-template id="16214"]'); ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
