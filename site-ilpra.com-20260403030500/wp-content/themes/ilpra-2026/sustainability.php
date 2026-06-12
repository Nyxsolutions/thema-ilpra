<?php
/*
Template Name: Sustainability
*/

if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_get_sustainability_theme_image_url(string $filename): string
{
    return get_template_directory_uri() . '/sustainability/lib/images/' . ltrim($filename, '/');
}

function ilpra_2026_get_sustainability_defaults(): array
{
    $quote = "“Sustainability is not an abstract goal, but a series of concrete choices made every day.<br>\nThrough responsible innovation, efficiency, and respect for people and the environment, we build\nlong-term value for industry and society.”";

    return [
        'hero' => [
            'title' => 'A Concrete Approach to Sustainability',
            'text' => 'In a constantly evolving industrial context, ILPRA adopts a pragmatic approach to sustainability by integrating solutions that improve energy efficiency, reduce the environmental impact of production processes, and promote people’s well-being.',
        ],
        'tabs' => [
            'sustainability' => 'Sustainability',
            'environmental' => 'Environmental',
            'social' => 'Social',
            'governance' => 'Governance',
        ],
        'quote' => [
            'text' => $quote,
            'logo_url' => get_template_directory_uri() . '/sustainability/lib/images/ilpra-70.svg',
        ],
        'panels' => [
            'sustainability' => [
                [
                    'title' => 'A Concrete Approach to Sustainability',
                    'content' => '<p>In a constantly evolving industrial context, ILPRA adopts a pragmatic approach to sustainability by integrating solutions that improve energy efficiency, reduce the environmental impact of production processes, and promote people’s well-being.</p><p>Our focus on quality, safety, and innovation translates into conscious choices aimed at responsible, long-term growth, aligned with today’s needs and tomorrow’s challenges.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('1_approach.jpg'),
                    'image_alt' => 'Concrete sustainability approach',
                    'image_position' => 'right',
                    'link' => null,
                ],
                [
                    'title' => 'Our Sustainability Policy',
                    'content' => '<p>Our Corporate Sustainability Policy stems from the commitment to integrate environmental, social, and economic responsibility into all activities.</p><p><strong>Certifications and Assessments</strong><br>We participate in the EcoVadis Corporate Assessment. <a href="https://ecovadis.com" target="_blank" rel="noopener" style="color:#89af1e;">ecovadis.com</a></p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('3_ecovadis.jpg'),
                    'image_alt' => 'EcoVadis sustainability assessment',
                    'image_position' => 'left',
                    'link' => null,
                ],
            ],
            'environmental' => [
                [
                    'title' => 'Energy Efficiency and Space Upgrades',
                    'content' => '<p>We invest in modernizing our facilities by replacing outdated systems with high-efficiency solutions.</p><p>We constantly monitor consumption through smart control systems to optimize every intervention.</p><p>Thanks to photovoltaic panels, a significant portion of our energy needs is covered by green energy, delivering tangible benefits for both the environment and the community.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('4_pannelli solari.jpg'),
                    'image_alt' => 'Energy efficiency',
                    'image_position' => 'right',
                    'link' => null,
                ],
                [
                    'title' => 'Sustainable Mobility',
                    'content' => '<p>We are converting our corporate fleet to electric and hybrid vehicles, helping reduce emissions.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('5_veicoli.jpg'),
                    'image_alt' => 'Sustainable mobility',
                    'image_position' => 'left',
                    'link' => null,
                ],
                [
                    'title' => 'Low-Emission Logistics',
                    'content' => '<p>ILPRA is committed to reducing CO₂ emissions from shipments by using sustainable aviation fuel (SAF). For this reason, we have chosen DHL Express as our partner, sharing the goal of making more sustainable choices. Our shipments use the DHL GoGreen Plus service, which employs SAF blended with conventional fuel to cut emissions by up to 80%*.</p>',
                    'note' => '*Jet fuel based on CORSIA baseline prescribed by SBTi. SAF LCA values based on ICCT data, assuming full lifecycle emissions from Used cooking oils, and vegetable oils derived from plants.',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('6_dhl.jpg'),
                    'image_alt' => 'Low-emission logistics',
                    'image_position' => 'right',
                    'link' => null,
                ],
                [
                    'title' => 'Responsible Building Expansion',
                    'content' => '<p>Our new third floor will be built on a stilt-like structure with seismic resistance and minimal impact on the existing building—an example of safe and sustainable growth.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('7_terzo.jpg'),
                    'image_alt' => 'Building expansion',
                    'image_position' => 'left',
                    'link' => null,
                ],
            ],
            'social' => [
                [
                    'title' => 'Corporate Welfare',
                    'content' => '<p>We promote welfare initiatives to improve the quality of life for our employees and their families, fostering a healthy work-life balance.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('8_corporate welfare.jpg'),
                    'image_alt' => 'Corporate welfare',
                    'image_position' => 'right',
                    'link' => null,
                ],
                [
                    'title' => 'Wellness Desk',
                    'content' => '<p>At ILPRA, we believe well-being is not a privilege but an essential part of everyday life. That’s why we created the “Taking Care of Ourselves” Wellness Desk, offering confidential sessions with a psychologist and psychotherapist for emotional support.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('9_sportello benessere.jpg'),
                    'image_alt' => 'Wellness desk',
                    'image_position' => 'left',
                    'link' => null,
                ],
                [
                    'title' => 'Career Development',
                    'content' => '<p>We believe in continuous learning and invest in developing technical and leadership skills to build a dynamic, future-oriented workplace.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('10_career dev.jpg'),
                    'image_alt' => 'Career development',
                    'image_position' => 'right',
                    'link' => [
                        'label' => 'Work with Us',
                        'url' => 'https://ilpra.com/work-with-us/',
                        'target' => '_blank',
                    ],
                ],
                [
                    'title' => 'Sponsorships',
                    'content' => '<p>We proudly support social and sports initiatives, such as our official sponsorship of <a href="https://en.corporate.ilpra.com/ilpra-sponsor-ufficiale-di-fisip-federazione-italianasport-invernali-paralimpici/" target="_blank" rel="noopener" style="color:#89af1e;">FISIP – Italian Federation of Paralympic Winter Sports</a>.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('11_fisrace.jpg'),
                    'image_alt' => 'Sponsorships',
                    'image_position' => 'left',
                    'link' => null,
                ],
                [
                    'title' => 'Diversity and Inclusion',
                    'content' => '<p>We foster an inclusive environment where every individual is respected and valued. Diversity is a resource that drives innovation and creativity.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('12_diversity.jpg'),
                    'image_alt' => 'Diversity and inclusion',
                    'image_position' => 'right',
                    'link' => null,
                ],
                [
                    'title' => 'Academic Partnerships',
                    'content' => '<p>To attract top talent, we maintain active collaborations with universities, offering curricular internships and delivering courses to share our expertise.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('13_academic.jpg'),
                    'image_alt' => 'Academic partnerships',
                    'image_position' => 'left',
                    'link' => null,
                ],
            ],
            'governance' => [
                [
                    'title' => 'Code of Ethics',
                    'content' => '<p>Our Code of Ethics guides every action, promoting integrity, legality, and social responsibility. It is the foundation of our relationships with all stakeholders. To ensure transparency and alignment with our values, we require suppliers and customers to share our commitment. We provide a dedicated form for accepting the Code of Ethics and corporate policies, building strong and transparent relationships.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('14_ethics.jpg'),
                    'image_alt' => 'Code of ethics',
                    'image_position' => 'right',
                    'link' => [
                        'label' => 'Code of Ethics',
                        'url' => '/wp-content/uploads/2026/04/codice_etico.pdf',
                        'target' => '_blank',
                    ],
                ],
                [
                    'title' => 'D.Lgs. 231/2001',
                    'content' => '<p>Within its Governance system, ILPRA S.p.A. has adopted an Organization, Management and Control Model pursuant to Legislative Decree 231/2001, aimed at ensuring corporate management based on transparency, integrity, and full regulatory compliance.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('1_approach.jpg'),
                    'image_alt' => 'D.Lgs. 231/2001',
                    'image_position' => 'left',
                    'link' => [
                        'label' => 'Organization, Management and Control Model',
                        'url' => '/wp-content/uploads/2026/04/modello_di_organizzazione_gestione_e_controllo.pdf',
                        'target' => '_blank',
                    ],
                ],
                [
                    'title' => 'Whistleblowing System',
                    'content' => '<p>We offer a secure and accessible channel for reporting non-compliant behavior, ensuring confidentiality and transparency.</p>',
                    'note' => '',
                    'image_url' => ilpra_2026_get_sustainability_theme_image_url('15_whistleblowing.jpg'),
                    'image_alt' => 'Whistleblowing system',
                    'image_position' => 'left',
                    'link' => [
                        'label' => 'Whistleblowing',
                        'url' => 'https://digitalroom.bdo.it/Ilpra/home.aspx',
                        'target' => '_blank',
                    ],
                ],
            ],
        ],
    ];
}

function ilpra_2026_get_sustainability_acf_link($value, ?array $fallback = null): ?array
{
    if (!is_array($value) || empty($value['url'])) {
        return $fallback;
    }

    return [
        'label' => trim((string) ($value['title'] ?? '')) ?: (string) ($fallback['label'] ?? ''),
        'url' => trim((string) $value['url']),
        'target' => trim((string) ($value['target'] ?? '')) ?: (string) ($fallback['target'] ?? '_self'),
    ];
}

function ilpra_2026_get_sustainability_sections_from_acf($post_id, string $field_name, array $fallback_sections): array
{
    if (!function_exists('get_field')) {
        return $fallback_sections;
    }

    $rows = get_field($field_name, $post_id);

    if (!is_array($rows)) {
        return $fallback_sections;
    }

    $sections = [];

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $fallback = $fallback_sections[$index] ?? [];
        $title = trim((string) ($row['title'] ?? ''));
        $content = trim((string) ($row['content'] ?? ''));
        $note = trim((string) ($row['note'] ?? ''));
        $image_id = (int) ($row['image'] ?? 0);
        $image_alt = trim((string) ($row['image_alt'] ?? ''));
        $image_position = trim((string) ($row['image_position'] ?? ''));
        $link = ilpra_2026_get_sustainability_acf_link($row['link'] ?? null, $fallback['link'] ?? null);

        if ($title === '' && $content === '' && $note === '' && !$image_id && $image_alt === '' && empty($link)) {
            continue;
        }

        $sections[] = [
            'title' => $title !== '' ? $title : (string) ($fallback['title'] ?? ''),
            'content' => $content !== '' ? $content : (string) ($fallback['content'] ?? ''),
            'note' => $note !== '' ? $note : (string) ($fallback['note'] ?? ''),
            'image_id' => $image_id,
            'image_url' => !$image_id ? (string) ($fallback['image_url'] ?? '') : '',
            'image_alt' => $image_alt !== '' ? $image_alt : (string) ($fallback['image_alt'] ?? ''),
            'image_position' => in_array($image_position, ['left', 'right'], true) ? $image_position : (string) ($fallback['image_position'] ?? 'right'),
            'link' => $link,
        ];
    }

    return !empty($sections) ? $sections : $fallback_sections;
}

function ilpra_2026_get_sustainability_data(int $post_id): array
{
    $defaults = ilpra_2026_get_sustainability_defaults();

    if (!function_exists('get_field')) {
        return $defaults;
    }

    $quote_logo_id = (int) get_field('sustainability_quote_logo', $post_id);

    return [
        'hero' => [
            'title' => trim((string) get_field('sustainability_hero_title', $post_id)) ?: $defaults['hero']['title'],
            'text' => trim((string) get_field('sustainability_hero_text', $post_id)) ?: $defaults['hero']['text'],
        ],
        'tabs' => [
            'sustainability' => trim((string) get_field('sustainability_tab_label_sustainability', $post_id)) ?: $defaults['tabs']['sustainability'],
            'environmental' => trim((string) get_field('sustainability_tab_label_environmental', $post_id)) ?: $defaults['tabs']['environmental'],
            'social' => trim((string) get_field('sustainability_tab_label_social', $post_id)) ?: $defaults['tabs']['social'],
            'governance' => trim((string) get_field('sustainability_tab_label_governance', $post_id)) ?: $defaults['tabs']['governance'],
        ],
        'quote' => [
            'text' => trim((string) get_field('sustainability_quote_text', $post_id)) ?: $defaults['quote']['text'],
            'logo_id' => $quote_logo_id,
            'logo_url' => !$quote_logo_id ? $defaults['quote']['logo_url'] : '',
        ],
        'panels' => [
            'sustainability' => ilpra_2026_get_sustainability_sections_from_acf($post_id, 'sustainability_sections', $defaults['panels']['sustainability']),
            'environmental' => ilpra_2026_get_sustainability_sections_from_acf($post_id, 'environmental_sections', $defaults['panels']['environmental']),
            'social' => ilpra_2026_get_sustainability_sections_from_acf($post_id, 'social_sections', $defaults['panels']['social']),
            'governance' => ilpra_2026_get_sustainability_sections_from_acf($post_id, 'governance_sections', $defaults['panels']['governance']),
        ],
    ];
}

function ilpra_2026_render_sustainability_image(array $section): void
{
    if (!empty($section['image_id'])) {
        echo wp_get_attachment_image((int) $section['image_id'], 'large', false, [
            'class' => 'img-reveal',
            'alt' => $section['image_alt'] ?? '',
        ]);
        return;
    }

    if (!empty($section['image_url'])) {
        printf(
            '<img class="img-reveal" src="%s" alt="%s">',
            esc_url((string) $section['image_url']),
            esc_attr((string) ($section['image_alt'] ?? ''))
        );
    }
}

function ilpra_2026_render_sustainability_sections(array $sections): void
{
    foreach ($sections as $section) {
        $is_left = ($section['image_position'] ?? 'right') === 'left';
        ?>
        <section class="nine_section_wrapper">
            <div class="nine_section">
                <div class="row">
                    <div class="twelvecol">
                        <?php if ($is_left) : ?>
                            <div class="sixcol left_fade">
                                <?php ilpra_2026_render_sustainability_image($section); ?>
                            </div>
                        <?php endif; ?>

                        <div class="sixcol<?php echo $is_left ? ' last padding_top right_fade' : ' padding_top'; ?>">
                            <div class="features_title_wrapper">
                                <span class="features_title"><?php echo esc_html((string) ($section['title'] ?? '')); ?></span>
                            </div>

                            <?php if (!empty($section['content'])) : ?>
                                <?php echo wp_kses_post((string) $section['content']); ?>
                            <?php endif; ?>

                            <?php if (!empty($section['note'])) : ?>
                                <span style="font-size:11px;"><?php echo nl2br(esc_html((string) $section['note'])); ?></span>
                            <?php endif; ?>

                            <?php if (!empty($section['link']['url']) && !empty($section['link']['label'])) : ?>
                                <a
                                    href="<?php echo esc_url((string) $section['link']['url']); ?>"
                                    class="services_button"
                                    target="<?php echo esc_attr((string) ($section['link']['target'] ?? '_self')); ?>"
                                    <?php if (($section['link']['target'] ?? '') === '_blank') : ?>rel="noopener"<?php endif; ?>
                                >
                                    <?php echo esc_html((string) $section['link']['label']); ?>
                                </a>
                            <?php endif; ?>
                        </div>

                        <?php if (!$is_left) : ?>
                            <div class="sixcol last right_fade">
                                <?php ilpra_2026_render_sustainability_image($section); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}

function ilpra_2026_render_sustainability_quote(array $quote): void
{
    ?>
    <div class="testimonials_wrapper">
        <div class="testimonials_box bounce_fade">
            <span class="testimonials_img">
                <i class="fa fa-quote-right fa-3x white"></i>
            </span><br>
            <span class="testimonials_text"><?php echo wp_kses_post((string) ($quote['text'] ?? '')); ?></span>
            <span class="testimonials_autor">
                <?php if (!empty($quote['logo_id'])) : ?>
                    <?php echo wp_get_attachment_image((int) $quote['logo_id'], 'medium'); ?>
                <?php elseif (!empty($quote['logo_url'])) : ?>
                    <img src="<?php echo esc_url((string) $quote['logo_url']); ?>" alt="">
                <?php endif; ?>
            </span>
        </div>
    </div>
    <?php
}

get_header();
$sustainability = ilpra_2026_get_sustainability_data(get_the_ID());
?>
<section class="sustainability-page">
    <div class="sustainability-page__inner">
        <div id="sustainability-container" class="sustainability-page__content">
            <div id="intro">
                <section id="home">
                    <div class="home_box bounce_fade">
                        <span class="slider_text1"><?php echo esc_html($sustainability['hero']['title']); ?></span>
                        <span class="slider_text2"><b><?php echo esc_html($sustainability['hero']['text']); ?></b></span>
                    </div>
                </section>
            </div>

            <div id="tabs_wrapper" class="tabs-wrapper">
                <div class="sustainability-tabs">
                    <ul class="sustainability-tabs-list">
                        <li class="active"><a href="#sustainability"><?php echo esc_html($sustainability['tabs']['sustainability']); ?></a></li>
                        <li><a href="#environmental"><?php echo esc_html($sustainability['tabs']['environmental']); ?></a></li>
                        <li><a href="#social"><?php echo esc_html($sustainability['tabs']['social']); ?></a></li>
                        <li><a href="#governance"><?php echo esc_html($sustainability['tabs']['governance']); ?></a></li>
                    </ul>
                </div>
            </div>

            <div id="sostenibile" class="sustainability-panel is-active" data-sustainability-panel="sustainability">
                <?php ilpra_2026_render_sustainability_sections($sustainability['panels']['sustainability']); ?>
                <?php ilpra_2026_render_sustainability_quote($sustainability['quote']); ?>
            </div>

            <div id="environmental" class="sustainability-panel" data-sustainability-panel="environmental" hidden>
                <?php ilpra_2026_render_sustainability_sections($sustainability['panels']['environmental']); ?>
                <?php ilpra_2026_render_sustainability_quote($sustainability['quote']); ?>
            </div>

            <div id="social" class="sustainability-panel" data-sustainability-panel="social" hidden>
                <?php ilpra_2026_render_sustainability_sections($sustainability['panels']['social']); ?>
                <?php ilpra_2026_render_sustainability_quote($sustainability['quote']); ?>
            </div>

            <div id="governance" class="sustainability-panel" data-sustainability-panel="governance" hidden>
                <?php ilpra_2026_render_sustainability_sections($sustainability['panels']['governance']); ?>
                <?php ilpra_2026_render_sustainability_quote($sustainability['quote']); ?>
            </div>
        </div>
    </div>
</section>
<?php
get_footer();
