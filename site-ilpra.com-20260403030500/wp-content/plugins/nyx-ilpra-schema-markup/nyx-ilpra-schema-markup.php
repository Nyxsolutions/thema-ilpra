<?php
/**
 * Plugin Name: NYX ILPRA Schema Markup
 * Description: JSON-LD dinamico per Organization, Product delle macchine e NewsArticle delle news ILPRA.
 * Version: 1.0.0
 * Author: NYX Solutions
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

if (!defined('ABSPATH')) {
    exit;
}

final class NYX_ILPRA_Schema_Markup
{
    private const OPTION_NAME = 'nyx_ilpra_schema_settings';

    public function __construct()
    {
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_menu', [$this, 'register_settings_page']);
        add_action('wp_head', [$this, 'print_schema_markup'], 20);
    }

    public function register_settings(): void
    {
        register_setting(
            'nyx_ilpra_schema',
            self::OPTION_NAME,
            ['sanitize_callback' => [$this, 'sanitize_settings']]
        );
    }

    public function register_settings_page(): void
    {
        add_options_page(
            'NYX Schema Markup',
            'NYX Schema Markup',
            'manage_options',
            'nyx-ilpra-schema-markup',
            [$this, 'render_settings_page']
        );
    }

    public function render_settings_page(): void
    {
        if (!current_user_can('manage_options')) {
            wp_die('Non hai i permessi per accedere a questa pagina.');
        }

        $settings = $this->get_settings();
        ?>
        <div class="wrap">
            <h1>NYX Schema Markup</h1>
            <p>Configurazione globale per il JSON-LD ILPRA. Le macchine e le news usano automaticamente i contenuti della pagina corrente.</p>

            <form method="post" action="options.php">
                <?php settings_fields('nyx_ilpra_schema'); ?>

                <h2>Installazione corrente</h2>
                <table class="form-table" role="presentation">
                    <tr>
                        <th scope="row"><label for="nyx-schema-site-language">Lingua del sito</label></th>
                        <td>
                            <select id="nyx-schema-site-language" name="<?php echo esc_attr(self::OPTION_NAME); ?>[site_language]">
                                <option value="en" <?php selected($settings['site_language'], 'en'); ?>>English (en)</option>
                                <option value="it-IT" <?php selected($settings['site_language'], 'it-IT'); ?>>Italiano - Italia (it-IT)</option>
                            </select>
                            <p class="description">Su ilpra.com seleziona English; su it.ilpra.com seleziona Italiano.</p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="nyx-schema-contact-url">Pagina contatti di questo sito</label></th>
                        <td><input class="regular-text code" type="url" id="nyx-schema-contact-url" name="<?php echo esc_attr(self::OPTION_NAME); ?>[contact_url]" value="<?php echo esc_attr($settings['contact_url']); ?>"></td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="nyx-schema-news-category">Categoria delle news</label></th>
                        <td><input class="regular-text" type="text" id="nyx-schema-news-category" name="<?php echo esc_attr(self::OPTION_NAME); ?>[news_category_slug]" value="<?php echo esc_attr($settings['news_category_slug']); ?>"><p class="description">Solo gli articoli in questa categoria ricevono lo schema NewsArticle.</p></td>
                    </tr>
                </table>

                <h2>Organizzazione canonica</h2>
                <p>Questi dati identificano la stessa ILPRA su entrambi i siti. L'ID resta volutamente canonico su <code>ilpra.com</code>.</p>
                <table class="form-table" role="presentation">
                    <?php $this->render_text_field('organization_url', 'URL canonico organizzazione', $settings['organization_url'], 'https://ilpra.com/'); ?>
                    <?php $this->render_text_field('organization_name', 'Nome', $settings['organization_name']); ?>
                    <?php $this->render_text_field('legal_name', 'Ragione sociale', $settings['legal_name']); ?>
                    <?php $this->render_textarea_field('organization_description', 'Descrizione', $settings['organization_description']); ?>
                    <?php $this->render_text_field('logo_url', 'URL assoluto logo', $settings['logo_url']); ?>
                    <?php $this->render_text_field('founding_date', 'Anno di fondazione', $settings['founding_date'], '1955'); ?>
                    <?php $this->render_text_field('tax_id', 'Partita IVA / Tax ID', $settings['tax_id']); ?>
                    <?php $this->render_text_field('telephone', 'Telefono', $settings['telephone']); ?>
                    <?php $this->render_text_field('email', 'Email', $settings['email'], 'info@ilpra.com'); ?>
                    <?php $this->render_text_field('available_languages', 'Lingue assistenza', $settings['available_languages'], 'English, Italian'); ?>
                    <?php $this->render_textarea_field('knows_about', 'Competenze / knowsAbout', $settings['knows_about'], 'Una voce per riga.'); ?>
                    <?php $this->render_textarea_field('same_as', 'Profili social / sameAs', $settings['same_as'], 'Un URL per riga.'); ?>
                </table>

                <h2>Sede legale</h2>
                <table class="form-table" role="presentation">
                    <?php $this->render_text_field('registered_street', 'Indirizzo', $settings['registered_street']); ?>
                    <?php $this->render_text_field('registered_postal_code', 'CAP', $settings['registered_postal_code']); ?>
                    <?php $this->render_text_field('registered_city', 'Città', $settings['registered_city']); ?>
                    <?php $this->render_text_field('registered_country', 'Paese (codice ISO)', $settings['registered_country'], 'IT'); ?>
                </table>

                <h2>Headquarters</h2>
                <table class="form-table" role="presentation">
                    <?php $this->render_text_field('headquarters_name', 'Nome sede', $settings['headquarters_name']); ?>
                    <?php $this->render_text_field('headquarters_street', 'Indirizzo', $settings['headquarters_street']); ?>
                    <?php $this->render_text_field('headquarters_postal_code', 'CAP', $settings['headquarters_postal_code']); ?>
                    <?php $this->render_text_field('headquarters_city', 'Città', $settings['headquarters_city']); ?>
                    <?php $this->render_text_field('headquarters_region', 'Provincia / regione', $settings['headquarters_region']); ?>
                    <?php $this->render_text_field('headquarters_country', 'Paese (codice ISO)', $settings['headquarters_country'], 'IT'); ?>
                </table>

                <?php submit_button('Salva impostazioni schema'); ?>
            </form>
        </div>
        <?php
    }

    public function sanitize_settings($input): array
    {
        $input = is_array($input) ? $input : [];
        $defaults = $this->get_defaults();
        $settings = [];
        $url_fields = ['contact_url', 'organization_url', 'logo_url'];
        $textarea_fields = ['organization_description', 'knows_about', 'same_as'];

        foreach ($defaults as $key => $default) {
            $value = $input[$key] ?? '';

            if (in_array($key, $url_fields, true)) {
                $settings[$key] = esc_url_raw((string) $value, ['http', 'https']);
            } elseif (in_array($key, $textarea_fields, true)) {
                $settings[$key] = sanitize_textarea_field((string) $value);
            } else {
                $settings[$key] = sanitize_text_field((string) $value);
            }
        }

        $settings['site_language'] = in_array($settings['site_language'], ['en', 'it-IT'], true) ? $settings['site_language'] : 'en';
        $settings['news_category_slug'] = sanitize_title($settings['news_category_slug']) ?: 'news';

        return $settings;
    }

    public function print_schema_markup(): void
    {
        if (is_admin() || is_feed() || is_robots()) {
            return;
        }

        $this->render_json_ld($this->get_organization_schema());

        if (is_singular('packaging_machine')) {
            $schema = $this->get_product_schema((int) get_queried_object_id());

            if ($schema !== []) {
                $this->render_json_ld($schema);
            }
        }

        if (is_singular('post')) {
            $post_id = (int) get_queried_object_id();

            if (has_category($this->get_settings()['news_category_slug'], $post_id)) {
                $this->render_json_ld($this->get_news_article_schema($post_id));
            }
        }
    }

    private function get_organization_schema(): array
    {
        $settings = $this->get_settings();
        $organization_url = trailingslashit($settings['organization_url']);
        $organization_id = $organization_url . '#organization';
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            '@id' => $organization_id,
            'name' => $settings['organization_name'],
            'legalName' => $settings['legal_name'],
            'url' => $organization_url,
            'description' => $settings['organization_description'],
            'foundingDate' => $settings['founding_date'],
            'taxID' => $settings['tax_id'],
            'address' => $this->get_postal_address($settings, 'registered'),
            'location' => [
                '@type' => 'Place',
                'name' => $settings['headquarters_name'],
                'address' => $this->get_postal_address($settings, 'headquarters'),
            ],
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => $settings['telephone'],
                'email' => $settings['email'],
                'contactType' => 'customer service',
                'availableLanguage' => $this->get_lines($settings['available_languages'], ',') ?: ['English', 'Italian'],
            ],
            'knowsAbout' => $this->get_lines($settings['knows_about']),
            'sameAs' => $this->get_valid_urls($settings['same_as']),
        ];

        if ($settings['logo_url'] !== '') {
            $schema['logo'] = [
                '@type' => 'ImageObject',
                '@id' => $organization_url . '#logo',
                'url' => $settings['logo_url'],
                'contentUrl' => $settings['logo_url'],
                'caption' => $settings['organization_name'],
            ];
        }

        return $this->remove_empty_values($schema);
    }

    private function get_product_schema(int $post_id): array
    {
        if ($post_id <= 0) {
            return [];
        }

        $settings = $this->get_settings();
        $url = get_permalink($post_id);
        $title = get_the_title($post_id);

        if ($url === '' || $title === '') {
            return [];
        }

        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
            '@id' => trailingslashit($url) . '#product',
            'url' => $url,
            'name' => $title,
            'description' => $this->get_post_description($post_id, ['mid_description', 'descrizione_estesa_confezionatrice']),
            'model' => $title,
            'brand' => [
                '@type' => 'Brand',
                'name' => $settings['organization_name'],
            ],
            'manufacturer' => [
                '@id' => trailingslashit($settings['organization_url']) . '#organization',
            ],
            'category' => $this->get_machine_category($post_id),
            'additionalProperty' => $this->get_machine_technical_properties($post_id),
        ];

        if ($settings['contact_url'] !== '') {
            $schema['potentialAction'] = [
                '@type' => 'QuoteAction',
                'name' => sprintf('Request information about %s', $title),
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $settings['contact_url'],
                ],
            ];
        }

        $image = $this->get_featured_image_schema($post_id);

        if ($image !== []) {
            $schema['image'] = [$image['url']];
        }

        return $this->remove_empty_values($schema);
    }

    private function get_news_article_schema(int $post_id): array
    {
        $settings = $this->get_settings();
        $url = get_permalink($post_id);
        $organization_id = trailingslashit($settings['organization_url']) . '#organization';
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'NewsArticle',
            '@id' => trailingslashit($url) . '#article',
            'url' => $url,
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => $url,
            ],
            'headline' => get_the_title($post_id),
            'description' => $this->get_post_description($post_id),
            'datePublished' => get_post_time('c', true, $post_id),
            'dateModified' => get_post_modified_time('c', true, $post_id),
            'inLanguage' => $settings['site_language'],
            'author' => [
                '@type' => 'Organization',
                '@id' => $organization_id,
                'name' => $settings['organization_name'],
            ],
            'publisher' => [
                '@type' => 'Organization',
                '@id' => $organization_id,
                'name' => $settings['organization_name'],
            ],
            'keywords' => $this->get_article_keywords($post_id),
        ];

        $image = $this->get_featured_image_schema($post_id);

        if ($image !== []) {
            $schema['image'] = array_merge(['@type' => 'ImageObject'], $image);
        }

        return $this->remove_empty_values($schema);
    }

    private function get_machine_technical_properties(int $post_id): array
    {
        if (!function_exists('get_field')) {
            return [];
        }

        $rows = get_field('dati_tecnici', $post_id);

        if (!is_array($rows) || count($rows) < 2) {
            return [];
        }

        $headers = array_shift($rows);
        $columns = ['dato_colonna_1', 'dato_colonna_2', 'dato_colonna_3', 'dato_colonna_4'];
        $properties = [];

        foreach ($rows as $row) {
            if (!is_array($row)) {
                continue;
            }

            $label = trim((string) ($row['dato_colonna_1'] ?? ''));
            $values = [];

            foreach (array_slice($columns, 1) as $column) {
                $value = trim((string) ($row[$column] ?? ''));

                if ($value !== '') {
                    $values[$column] = $value;
                }
            }

            foreach ($values as $column => $value) {
                $header = trim((string) ($headers[$column] ?? ''));
                $name = $label !== '' ? $label : $header;

                if (count($values) > 1 && $header !== '') {
                    $name .= ' – ' . $header;
                }

                if ($name !== '') {
                    $properties[] = [
                        '@type' => 'PropertyValue',
                        'name' => $name,
                        'value' => $value,
                    ];
                }
            }
        }

        return $properties;
    }

    private function get_machine_category(int $post_id): string
    {
        foreach (['categoria_confezionatrice', 'tipologia_confezionatrice', 'categorie_confezionatrici', 'tipologie_confezionatrici'] as $taxonomy) {
            $terms = get_the_terms($post_id, $taxonomy);

            if (is_array($terms) && !empty($terms)) {
                return (string) $terms[0]->name;
            }
        }

        return '';
    }

    private function get_post_description(int $post_id, array $acf_fields = []): string
    {
        if (function_exists('get_field')) {
            foreach ($acf_fields as $field_name) {
                $value = trim(wp_strip_all_tags((string) get_field($field_name, $post_id)));

                if ($value !== '') {
                    return $value;
                }
            }
        }

        $excerpt = trim(wp_strip_all_tags((string) get_the_excerpt($post_id)));

        if ($excerpt !== '') {
            return $excerpt;
        }

        return wp_trim_words(wp_strip_all_tags((string) get_post_field('post_content', $post_id)), 55, '');
    }

    private function get_featured_image_schema(int $post_id): array
    {
        $image_id = get_post_thumbnail_id($post_id);

        if (!$image_id) {
            return [];
        }

        $image = wp_get_attachment_image_src($image_id, 'full');

        if (!is_array($image) || empty($image[0])) {
            return [];
        }

        return [
            'url' => $image[0],
            'width' => (int) $image[1],
            'height' => (int) $image[2],
        ];
    }

    private function get_article_keywords(int $post_id): array
    {
        $keywords = [];

        foreach (['category', 'post_tag'] as $taxonomy) {
            $terms = get_the_terms($post_id, $taxonomy);

            if (!is_array($terms)) {
                continue;
            }

            foreach ($terms as $term) {
                $keywords[] = $term->name;
            }
        }

        return array_values(array_unique(array_filter($keywords)));
    }

    private function get_postal_address(array $settings, string $prefix): array
    {
        return $this->remove_empty_values([
            '@type' => 'PostalAddress',
            'streetAddress' => $settings[$prefix . '_street'],
            'postalCode' => $settings[$prefix . '_postal_code'],
            'addressLocality' => $settings[$prefix . '_city'],
            'addressRegion' => $settings[$prefix . '_region'] ?? '',
            'addressCountry' => $settings[$prefix . '_country'],
        ]);
    }

    private function get_lines(string $value, string $separator = "\n"): array
    {
        $parts = $separator === "\n" ? preg_split('/\R/', $value) : explode($separator, $value);

        return array_values(array_filter(array_map('trim', $parts ?: [])));
    }

    private function get_valid_urls(string $value): array
    {
        $urls = [];

        foreach ($this->get_lines($value) as $url) {
            $url = esc_url_raw($url, ['http', 'https']);

            if ($url !== '') {
                $urls[] = $url;
            }
        }

        return $urls;
    }

    private function remove_empty_values(array $data): array
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = $this->remove_empty_values($value);
                $data[$key] = $value;
            }

            if ($value === '' || $value === [] || $value === null) {
                unset($data[$key]);
            }
        }

        return $data;
    }

    private function render_json_ld(array $schema): void
    {
        if (empty($schema)) {
            return;
        }

        printf("\n<script type=\"application/ld+json\">%s</script>\n", wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT));
    }

    private function get_settings(): array
    {
        $saved = get_option(self::OPTION_NAME, []);

        return wp_parse_args(is_array($saved) ? $saved : [], $this->get_defaults());
    }

    private function get_defaults(): array
    {
        return [
            'site_language' => 'en',
            'contact_url' => home_url('/contact-us/'),
            'news_category_slug' => 'news',
            'organization_url' => 'https://ilpra.com/',
            'organization_name' => 'ILPRA',
            'legal_name' => 'ILPRA S.p.A.',
            'organization_description' => 'ILPRA designs and manufactures packaging machines and automated packaging lines for the food, medical, cosmetic and non-food industries.',
            'logo_url' => 'https://ilpra.com/wp-content/uploads/2025/01/ILPRA-70.svg',
            'founding_date' => '1955',
            'tax_id' => 'IT01054200157',
            'telephone' => '+39-0384-2905',
            'email' => 'info@ilpra.com',
            'available_languages' => 'English, Italian',
            'knows_about' => "Packaging machines\nTray sealers\nModified atmosphere packaging\nMAP packaging\nSkin packaging\nFill Seal machines\nThermoforming machines\nForm Fill Seal machines\nEnd-of-line automation\nFood packaging\nMedical packaging\nCosmetic packaging",
            'same_as' => "https://www.linkedin.com/company/ilpra-s-p-a-/\nhttps://www.youtube.com/user/IlpraSpa",
            'registered_street' => 'Galleria Corso Buenos Aires, 13',
            'registered_postal_code' => '20124',
            'registered_city' => 'Milan',
            'registered_country' => 'IT',
            'headquarters_name' => 'ILPRA Headquarters',
            'headquarters_street' => 'Via Enrico Mattei, 21/23',
            'headquarters_postal_code' => '27036',
            'headquarters_city' => 'Mortara',
            'headquarters_region' => 'PV',
            'headquarters_country' => 'IT',
        ];
    }

    private function render_text_field(string $key, string $label, string $value, string $description = ''): void
    {
        ?>
        <tr>
            <th scope="row"><label for="nyx-schema-<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label></th>
            <td>
                <input class="regular-text" type="text" id="nyx-schema-<?php echo esc_attr($key); ?>" name="<?php echo esc_attr(self::OPTION_NAME); ?>[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>">
                <?php if ($description !== '') : ?><p class="description"><?php echo esc_html($description); ?></p><?php endif; ?>
            </td>
        </tr>
        <?php
    }

    private function render_textarea_field(string $key, string $label, string $value, string $description = ''): void
    {
        ?>
        <tr>
            <th scope="row"><label for="nyx-schema-<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label></th>
            <td>
                <textarea class="large-text" rows="5" id="nyx-schema-<?php echo esc_attr($key); ?>" name="<?php echo esc_attr(self::OPTION_NAME); ?>[<?php echo esc_attr($key); ?>]" ><?php echo esc_textarea($value); ?></textarea>
                <?php if ($description !== '') : ?><p class="description"><?php echo esc_html($description); ?></p><?php endif; ?>
            </td>
        </tr>
        <?php
    }
}

new NYX_ILPRA_Schema_Markup();
