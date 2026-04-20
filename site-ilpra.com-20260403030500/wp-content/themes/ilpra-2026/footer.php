<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
    </main>
    <footer class="site-footer">
        <div class="site-footer__top"></div>
        <div class="site-footer__middle">
            <div class="site-footer__inner site-footer__inner--middle">
                <div class="site-footer__brand-column">
                    <a class="site-footer__brand" href="<?php echo esc_url(home_url('/')); ?>">
                        <img src="<?php echo esc_url(ilpra_2026_get_logo_url(true)); ?>" alt="<?php echo esc_attr(ilpra_2026_get_logo_alt()); ?>">
                    </a>
                    <?php ilpra_2026_render_footer_sidebar('footer-widget-1'); ?>
                </div>

                <div class="site-footer__widgets">
                    <section class="site-footer__widget-group">
                        <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                            <span class="site-footer__heading">Other information</span>
                            <span class="site-footer__accordion-icon" aria-hidden="true"></span>
                        </button>
                        <div class="site-footer__accordion-panel">
                            <?php ilpra_2026_render_footer_sidebar('footer-widget-2'); ?>
                        </div>
                    </section>
                    <section class="site-footer__widget-group">
                        <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                            <span class="site-footer__heading">Welcome to ILPRA</span>
                            <span class="site-footer__accordion-icon" aria-hidden="true"></span>
                        </button>
                        <div class="site-footer__accordion-panel">
                            <?php ilpra_2026_render_footer_sidebar('footer-widget-4'); ?>
                        </div>
                    </section>
                    <section class="site-footer__widget-group">
                        <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                            <span class="site-footer__heading">Our Global Branches</span>
                            <span class="site-footer__accordion-icon" aria-hidden="true"></span>
                        </button>
                        <div class="site-footer__accordion-panel">
                            <?php ilpra_2026_render_footer_sidebar('footer-widget-5'); ?>
                        </div>
                    </section>
                    <section class="site-footer__widget-group">
                        <button class="site-footer__accordion-toggle" type="button" aria-expanded="false">
                            <span class="site-footer__heading">Accreditations</span>
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
                <nav class="site-footer__legal" aria-label="<?php esc_attr_e('Footer Navigation', 'ilpra-2026'); ?>">
                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
                    <a href="<?php echo esc_url(home_url('/cookie-policy/')); ?>">Cookie Policy</a>
                    <a href="<?php echo esc_url(home_url('/wp-content/uploads/2026/02/Quality-Policy_firmata.pdf')); ?>">Politica di Qualita'</a>
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
</div>
<?php wp_footer(); ?>
</body>
</html>
