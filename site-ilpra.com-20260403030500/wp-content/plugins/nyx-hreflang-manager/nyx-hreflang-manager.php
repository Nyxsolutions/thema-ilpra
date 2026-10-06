<?php
/**
 * Plugin Name: NYX Hreflang Manager
 * Description: Gestisce le associazioni hreflang per pagine e contenuti WordPress su domini separati.
 * Version: 1.0.0
 * Author: NYX Solutions
 * Text Domain: nyx-hreflang-manager
 */

if (!defined('ABSPATH')) {
    exit;
}

final class NYX_Hreflang_Manager
{
    private const META_KEY = '_nyx_hreflang_links';
    private const NONCE_ACTION = 'nyx_hreflang_save';
    private const NONCE_NAME = 'nyx_hreflang_nonce';

    public function __construct()
    {
        add_action('add_meta_boxes', [$this, 'register_meta_boxes']);
        add_action('save_post', [$this, 'save_post']);
        add_action('wp_head', [$this, 'print_hreflang_tags'], 2);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('admin_menu', [$this, 'register_manager_page']);
        add_action('admin_post_nyx_hreflang_manager_save', [$this, 'save_from_manager']);
    }

    public function register_meta_boxes(): void
    {
        foreach ($this->get_supported_post_types() as $post_type) {
            add_meta_box(
                'nyx-hreflang-manager',
                'NYX Hreflang Manager',
                [$this, 'render_meta_box'],
                $post_type,
                'normal',
                'high'
            );
        }
    }

    public function render_meta_box(\WP_Post $post): void
    {
        wp_nonce_field(self::NONCE_ACTION, self::NONCE_NAME);
        ?>
        <p class="description">Inserisci una lingua e l'URL della stessa pagina nel relativo sito. Il plugin genera automaticamente i tag <code>hreflang</code> nel frontend.</p>
        <?php $this->render_editor($this->get_links($post->ID)); ?>
        <p class="description">Se non inserisci <code>x-default</code>, viene generato automaticamente usando l'URL <code>en</code> oppure il primo URL disponibile.</p>
        <?php
    }

    public function save_post(int $post_id): void
    {
        if (
            !isset($_POST[self::NONCE_NAME]) ||
            !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST[self::NONCE_NAME])), self::NONCE_ACTION) ||
            (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) ||
            wp_is_post_revision($post_id) ||
            !current_user_can('edit_post', $post_id)
        ) {
            return;
        }

        $this->persist_links($post_id, $this->get_posted_links());
    }

    public function print_hreflang_tags(): void
    {
        if (!is_singular()) {
            return;
        }

        $post_id = (int) get_queried_object_id();

        if ($post_id <= 0) {
            return;
        }

        $links = $this->get_links_with_default($post_id);

        foreach ($links as $language => $url) {
            printf("<link rel=\"alternate\" hreflang=\"%s\" href=\"%s\" />\n", esc_attr($language), esc_url($url));
        }
    }

    public function enqueue_admin_assets(string $hook): void
    {
        $is_editor = in_array($hook, ['post.php', 'post-new.php'], true);
        $is_manager = $hook === 'tools_page_nyx-hreflang-manager';

        if (!$is_editor && !$is_manager) {
            return;
        }

        wp_enqueue_style(
            'nyx-hreflang-manager-admin',
            plugin_dir_url(__FILE__) . 'assets/admin.css',
            [],
            '1.0.0'
        );
        wp_enqueue_script(
            'nyx-hreflang-manager-admin',
            plugin_dir_url(__FILE__) . 'assets/admin.js',
            [],
            '1.0.0',
            true
        );
    }

    public function register_manager_page(): void
    {
        add_management_page(
            'Hreflang Manager',
            'Hreflang Manager',
            'edit_posts',
            'nyx-hreflang-manager',
            [$this, 'render_manager_page']
        );
    }

    public function render_manager_page(): void
    {
        if (!current_user_can('edit_posts')) {
            wp_die('Non hai i permessi per visualizzare questa pagina.');
        }

        $query = new \WP_Query([
            'post_type' => $this->get_supported_post_types(),
            'post_status' => ['publish', 'draft', 'private', 'pending'],
            'posts_per_page' => 100,
            'meta_key' => self::META_KEY,
            'orderby' => 'modified',
            'order' => 'DESC',
        ]);
        ?>
        <div class="wrap nyx-hreflang-manager-page">
            <h1>Hreflang Manager</h1>
            <p>Qui trovi tutti i contenuti che hanno associazioni hreflang. Puoi modificarli direttamente senza aprire ogni pagina.</p>

            <?php if (isset($_GET['updated'])) : ?>
                <div class="notice notice-success is-dismissible"><p>Associazioni hreflang aggiornate.</p></div>
            <?php endif; ?>

            <?php if (!$query->have_posts()) : ?>
                <div class="notice notice-info"><p>Non ci sono ancora contenuti configurati. Apri una pagina o un prodotto e aggiungi le associazioni nel box NYX Hreflang Manager.</p></div>
            <?php else : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php $post_id = (int) get_the_ID(); ?>
                    <section class="nyx-hreflang-manager-card">
                        <div class="nyx-hreflang-manager-card__header">
                            <div>
                                <h2><?php echo esc_html(get_the_title() ?: '(senza titolo)'); ?></h2>
                                <p>
                                    <?php echo esc_html(get_post_type_object(get_post_type($post_id))->labels->singular_name ?? get_post_type($post_id)); ?>
                                    · <a href="<?php echo esc_url(get_edit_post_link($post_id)); ?>">Apri editor</a>
                                    · <a href="<?php echo esc_url(get_permalink($post_id)); ?>" target="_blank" rel="noopener">Visualizza</a>
                                </p>
                            </div>
                        </div>
                        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                            <input type="hidden" name="action" value="nyx_hreflang_manager_save">
                            <input type="hidden" name="post_id" value="<?php echo esc_attr((string) $post_id); ?>">
                            <?php wp_nonce_field(self::NONCE_ACTION . '_' . $post_id, self::NONCE_NAME); ?>
                            <?php $this->render_editor($this->get_links($post_id)); ?>
                            <?php submit_button('Aggiorna associazioni', 'primary', 'submit', false); ?>
                        </form>
                    </section>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>
        </div>
        <?php
    }

    public function save_from_manager(): void
    {
        $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;

        if (
            $post_id <= 0 ||
            !current_user_can('edit_post', $post_id) ||
            !isset($_POST[self::NONCE_NAME]) ||
            !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST[self::NONCE_NAME])), self::NONCE_ACTION . '_' . $post_id)
        ) {
            wp_die('Richiesta non valida.');
        }

        $this->persist_links($post_id, $this->get_posted_links());

        wp_safe_redirect(add_query_arg(['page' => 'nyx-hreflang-manager', 'updated' => $post_id], admin_url('tools.php')));
        exit;
    }

    private function render_editor(array $links): void
    {
        if (empty($links)) {
            $links = ['' => ''];
        }
        ?>
        <div class="nyx-hreflang-editor">
            <table class="widefat striped nyx-hreflang-editor__table">
                <thead>
                    <tr>
                        <th scope="col">Lingua</th>
                        <th scope="col">URL alternativo</th>
                        <th scope="col" class="nyx-hreflang-editor__action">Azione</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($links as $language => $url) : ?>
                        <?php $this->render_editor_row((string) $language, (string) $url); ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p><button type="button" class="button nyx-hreflang-editor__add">+ Aggiungi lingua</button></p>
            <template class="nyx-hreflang-editor__template"><?php $this->render_editor_row('', ''); ?></template>
        </div>
        <?php
    }

    private function render_editor_row(string $language, string $url): void
    {
        ?>
        <tr>
            <td>
                <select name="nyx_hreflang[language][]">
                    <option value="">Seleziona lingua</option>
                    <?php foreach ($this->get_language_options() as $code => $label) : ?>
                        <option value="<?php echo esc_attr($code); ?>" <?php selected($language, $code); ?>><?php echo esc_html($label); ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="url" name="nyx_hreflang[url][]" value="<?php echo esc_url($url); ?>" placeholder="https://example.com/percorso/"></td>
            <td class="nyx-hreflang-editor__action"><button type="button" class="button-link-delete nyx-hreflang-editor__remove">Rimuovi</button></td>
        </tr>
        <?php
    }

    private function get_language_options(): array
    {
        $options = [
            'it-IT' => 'Italiano - Italia (it-IT)',
            'en' => 'English internazionale (en)',
            'en-GB' => 'English - Regno Unito (en-GB)',
            'en-AE' => 'English - Emirati Arabi Uniti (en-AE)',
            'ar-AE' => 'Arabo - Emirati Arabi Uniti (ar-AE)',
            'es-ES' => 'Spagnolo - Spagna (es-ES)',
            'fr-FR' => 'Francese - Francia (fr-FR)',
            'nl-NL' => 'Olandese - Paesi Bassi (nl-NL)',
            'ru-RU' => 'Russo - Russia (ru-RU)',
            'ko-KR' => 'Coreano - Corea del Sud (ko-KR)',
            'x-default' => 'Pagina predefinita (x-default)',
        ];

        return $options;
    }

    private function get_supported_post_types(): array
    {
        $post_types = get_post_types(['public' => true], 'names');
        unset($post_types['attachment']);

        return array_values($post_types);
    }

    private function get_links(int $post_id): array
    {
        $links = get_post_meta($post_id, self::META_KEY, true);

        return is_array($links) ? $this->normalize_links($links) : [];
    }

    private function get_links_with_default(int $post_id): array
    {
        $links = $this->get_links($post_id);

        if (empty($links) || isset($links['x-default'])) {
            return $links;
        }

        $links['x-default'] = $links['en'] ?? reset($links);

        return $links;
    }

    private function get_posted_links(): array
    {
        $posted = isset($_POST['nyx_hreflang']) && is_array($_POST['nyx_hreflang'])
            ? wp_unslash($_POST['nyx_hreflang'])
            : [];

        $languages = isset($posted['language']) && is_array($posted['language']) ? $posted['language'] : [];
        $urls = isset($posted['url']) && is_array($posted['url']) ? $posted['url'] : [];
        $links = [];

        foreach ($languages as $index => $language) {
            $links[(string) $language] = isset($urls[$index]) ? (string) $urls[$index] : '';
        }

        return $this->normalize_links($links);
    }

    private function normalize_links(array $links): array
    {
        $normalized = [];

        foreach ($links as $language => $url) {
            $language = $this->normalize_language_code((string) $language);
            $url = esc_url_raw(trim((string) $url), ['http', 'https']);

            if (!$this->is_valid_language($language) || $url === '' || isset($normalized[$language])) {
                continue;
            }

            $normalized[$language] = $url;
        }

        return $normalized;
    }

    private function is_valid_language(string $language): bool
    {
        return isset($this->get_language_options()[$language]);
    }

    private function normalize_language_code(string $language): string
    {
        $language = strtolower(trim($language));

        foreach (array_keys($this->get_language_options()) as $code) {
            if (strtolower($code) === $language) {
                return $code;
            }
        }

        return '';
    }

    private function persist_links(int $post_id, array $links): void
    {
        if (empty($links)) {
            delete_post_meta($post_id, self::META_KEY);
            return;
        }

        update_post_meta($post_id, self::META_KEY, $links);
    }
}

new NYX_Hreflang_Manager();
