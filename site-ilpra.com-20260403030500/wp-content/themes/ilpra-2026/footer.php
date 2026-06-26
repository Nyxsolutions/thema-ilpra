<?php
if (!defined('ABSPATH')) {
    exit;
}

$footer_other_information_heading = ilpra_2026_get_theme_string('string_footer_other_information_heading', 'Other information', 'Altre informazioni');
$footer_welcome_heading = ilpra_2026_get_theme_string('string_footer_welcome_heading', 'Welcome to ILPRA', 'Benvenuti in ILPRA');
$footer_branches_heading = ilpra_2026_get_theme_string('string_footer_branches_heading', 'Our Global Branches', 'Le nostre sedi nel mondo');
$footer_accreditations_heading = ilpra_2026_get_theme_string('string_footer_accreditations_heading', 'Accreditations', 'Accreditamenti');
$footer_navigation_label = ilpra_2026_get_theme_string('string_footer_navigation_label', 'Footer Navigation', 'Navigazione footer');
$footer_legal_links = ilpra_2026_get_footer_link_rows('footer_legal_links');
?>
    </main>
    <?php if (!is_page_template('template-landing.php')) : ?>
        <footer class="site-footer">
            <div class="site-footer__top"></div>
            <div class="site-footer__middle">
                <div class="site-footer__inner site-footer__inner--middle">
                    <div class="site-footer__brand-column">
                        <a class="site-footer__brand" href="<?php echo esc_url(home_url('/')); ?>" target="_blank" rel="noreferrer">
                            <img src="<?php echo esc_url(ilpra_2026_get_logo_url(true)); ?>" alt="<?php echo esc_attr(ilpra_2026_get_logo_alt()); ?>">
                        </a>
                        <?php ilpra_2026_render_footer_sidebar('footer-widget-1'); ?>
                    </div>

                    <div class="site-footer__widgets">
                        <section class="site-footer__widget-group">
                            <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                                <span class="site-footer__heading"><?php echo esc_html($footer_other_information_heading); ?></span>
                                <span class="site-footer__accordion-icon" aria-hidden="true"></span>
                            </button>
                            <div class="site-footer__accordion-panel">
                                <?php ilpra_2026_render_footer_sidebar('footer-widget-2'); ?>
                            </div>
                        </section>
                        <section class="site-footer__widget-group">
                            <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                                <span class="site-footer__heading"><?php echo esc_html($footer_welcome_heading); ?></span>
                                <span class="site-footer__accordion-icon" aria-hidden="true"></span>
                            </button>
                            <div class="site-footer__accordion-panel">
                                <?php ilpra_2026_render_footer_sidebar('footer-widget-4'); ?>
                            </div>
                        </section>
                        <section class="site-footer__widget-group">
                            <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                                <span class="site-footer__heading"><?php echo esc_html($footer_branches_heading); ?></span>
                                <span class="site-footer__accordion-icon" aria-hidden="true"></span>
                            </button>
                            <div class="site-footer__accordion-panel">
                                <?php ilpra_2026_render_footer_sidebar('footer-widget-5'); ?>
                            </div>
                        </section>
                        <section class="site-footer__widget-group">
                            <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                                <span class="site-footer__heading"><?php echo esc_html($footer_accreditations_heading); ?></span>
                                <span class="site-footer__accordion-icon" aria-hidden="true"></span>
                            </button>
                            <div class="site-footer__accordion-panel">
                                <?php ilpra_2026_render_footer_sidebar('footer-widget-3'); ?>
                            </div>
                        </section>
                    </div>
                </div>
            </div>

            <div class="site-footer__bottom">
                <div class="site-footer__inner site-footer__inner--bottom">
                    <p class="site-footer__copyright">All Rights Reserved © Ilpra spa <?php echo esc_html(date('Y')); ?> Partita Iva IT 01054200157</p>
                    <nav class="site-footer__legal" aria-label="<?php echo esc_attr($footer_navigation_label); ?>">
                        <?php foreach ($footer_legal_links as $footer_legal_link_row) : ?>
                            <?php
                            if (!is_array($footer_legal_link_row)) {
                                continue;
                            }

                            $footer_legal_link_markup = ilpra_2026_get_footer_link_markup($footer_legal_link_row);

                            if ($footer_legal_link_markup === '') {
                                continue;
                            }
                            ?>
                            <?php echo $footer_legal_link_markup; ?>
                        <?php endforeach; ?>
                    </nav>
                    <div class="site-footer__socials">
                        <a href="https://www.linkedin.com/company/ilpra-s-p-a-/" target="_blank" rel="noreferrer" aria-label="LinkedIn">
                            <img src="<?php echo esc_url(ilpra_2026_get_social_icon_url('linkedin')); ?>" alt="" aria-hidden="true">
                        </a>
                        <a href="https://www.youtube.com/user/IlpraSpa" target="_blank" rel="noreferrer" aria-label="YouTube">
                            <img src="<?php echo esc_url(ilpra_2026_get_social_icon_url('youtube')); ?>" alt="" aria-hidden="true">
                        </a>
                        <a href="https://www.instagram.com/ilpra_packaging_solutions/" target="_blank" rel="noreferrer" aria-label="Instagram">
                            <img src="<?php echo esc_url(ilpra_2026_get_social_icon_url('instagram')); ?>" alt="" aria-hidden="true">
                        </a>
                        <a href="https://www.facebook.com/Ilpra" target="_blank" rel="noreferrer" aria-label="Facebook">
                            <img src="<?php echo esc_url(ilpra_2026_get_social_icon_url('facebook')); ?>" alt="" aria-hidden="true">
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    <?php endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
