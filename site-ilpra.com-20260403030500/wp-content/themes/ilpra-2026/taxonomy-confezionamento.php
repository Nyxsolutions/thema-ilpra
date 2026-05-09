<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$terms = get_terms([
    'taxonomy' => 'confezionamento',
    'hide_empty' => false,
    'orderby' => 'term_order',
    'order' => 'ASC',
]);

$terms = array_values(array_filter($terms, static function ($term): bool {
    return $term instanceof WP_Term && (int) $term->parent !== 0;
}));

$current_term = get_queried_object();

if (!$current_term instanceof WP_Term || $current_term->taxonomy !== 'confezionamento') {
    $current_term = !empty($terms) ? $terms[0] : null;
}

$term_prefix = $current_term ? 'confezionamento_' . $current_term->term_id : '';
$description = $current_term ? (string) get_field('acf_descrizione_categoria', $term_prefix) : '';
$hero_image = $current_term ? get_field('immagine-serie-confezione', $term_prefix) : '';
$icon_image = $current_term ? get_field('icona_alimento', $term_prefix) : '';
$solutions = $current_term ? get_field('tipi_di_confezione_alimentare', $term_prefix) : [];

$resolve_image_url = static function ($value, string $size = 'large'): string {
    if (is_array($value)) {
        if (!empty($value['sizes'][$size])) {
            return (string) $value['sizes'][$size];
        }

        if (!empty($value['url'])) {
            return (string) $value['url'];
        }

        if (!empty($value['ID'])) {
            return (string) wp_get_attachment_image_url((int) $value['ID'], $size);
        }
    }

    if (is_numeric($value)) {
        return (string) wp_get_attachment_image_url((int) $value, $size);
    }

    return is_string($value) ? $value : '';
};

$hero_image_url = $resolve_image_url($hero_image, 'large');
$icon_image_url = $resolve_image_url($icon_image, 'medium');

if ($hero_image_url === '') {
    $hero_image_url = $icon_image_url;
}
?>
<section class="by-industry-page">
    <div class="by-industry-page__inner">
        <?php if (!empty($terms)) : ?>
            <nav class="bi-nav" aria-label="<?php esc_attr_e('By industry navigation', 'ilpra-2026'); ?>">
                <div class="bi-nav__slider">
                    <button class="bi-nav__arrow bi-nav__arrow--prev" type="button" aria-label="<?php esc_attr_e('Previous industries', 'ilpra-2026'); ?>" data-bi-prev>
                        <span aria-hidden="true">&lsaquo;</span>
                    </button>

                    <div class="bi-nav__viewport">
                        <div class="bi-nav__track" data-bi-track>
                            <?php foreach ($terms as $term) : ?>
                                <?php
                                $term_url = get_term_link($term);
                                $term_icon_url = $resolve_image_url(get_field('icona_alimento', 'confezionamento_' . $term->term_id), 'medium');
                                $is_active = $current_term && (int) $current_term->term_id === (int) $term->term_id;
                                ?>
                                <a href="<?php echo esc_url($term_url); ?>" class="bi-pill<?php echo $is_active ? ' is-active' : ''; ?>">
                                    <?php if ($term_icon_url !== '') : ?>
                                        <img src="<?php echo esc_url($term_icon_url); ?>" alt="" aria-hidden="true">
                                    <?php endif; ?>
                                    <span><?php echo esc_html($term->name); ?> Packaging</span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <button class="bi-nav__arrow bi-nav__arrow--next" type="button" aria-label="<?php esc_attr_e('Next industries', 'ilpra-2026'); ?>" data-bi-next>
                        <span aria-hidden="true">&rsaquo;</span>
                    </button>
                </div>
            </nav>
        <?php endif; ?>

        <?php if ($current_term) : ?>
            <section class="bi-intro">
                <div class="bi-intro__grid">
                    <div class="bi-intro__body">
                        <h1 class="bi-intro__title"><?php echo esc_html($current_term->name); ?> Packaging</h1>

                        <?php if ($description !== '') : ?>
                            <div class="bi-intro__description" data-bi-description>
                                <?php echo wp_kses_post($description); ?>
                            </div>
                            <button type="button" class="bi-read-more" data-bi-read-more aria-expanded="false">
                                <?php esc_html_e('Read more', 'ilpra-2026'); ?>
                            </button>
                        <?php endif; ?>

                        <a href="#bi-contact" class="bi-button"><?php esc_html_e('Need Help? Talk with us', 'ilpra-2026'); ?></a>
                    </div>

                    <div class="bi-intro__media">
                        <?php if ($hero_image_url !== '') : ?>
                            <img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($current_term->name . ' Packaging'); ?>">
                        <?php else : ?>
                            <div class="bi-intro__placeholder" aria-hidden="true"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <header class="bi-section-heading">
            <h2 class="bi-section-heading__title"><?php esc_html_e('Available Packaging Solutions', 'ilpra-2026'); ?></h2>
        </header>

        <?php if (!empty($solutions) && is_array($solutions)) : ?>
            <section class="bi-solutions">
                <div class="bi-solutions__grid">
                    <?php foreach ($solutions as $solution) : ?>
                        <?php
                        $image_url = $resolve_image_url($solution['confezione_alimentare_categoria'] ?? '', 'medium');
                        $title = (string) ($solution['nome_confezione'] ?? '');
                        $link = (string) ($solution['link_alla_serie'] ?? '');
                        ?>
                        <article class="bi-card">
                            <div class="bi-card__panel">
                                <?php if ($link !== '') : ?>
                                    <a href="<?php echo esc_url($link); ?>" class="bi-card__image-link">
                                <?php endif; ?>

                                <div class="bi-card__image">
                                    <?php if ($image_url !== '') : ?>
                                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($title); ?>">
                                    <?php endif; ?>
                                </div>

                                <?php if ($link !== '') : ?>
                                    </a>
                                <?php endif; ?>
                            </div>

                            <?php if ($title !== '') : ?>
                                <h3 class="bi-card__title"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>

                            <?php if ($link !== '') : ?>
                                <a href="<?php echo esc_url($link); ?>" class="bi-button bi-button--secondary"><?php esc_html_e('View Solutions', 'ilpra-2026'); ?></a>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>
    </div>

    <section id="bi-contact" class="bi-contact">
        <div class="bi-contact__inner">
            <div class="bi-contact__form">
                <?php echo do_shortcode('[elementor-template id="15850"]'); ?>
            </div>
        </div>
    </section>
</section>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const mediaQuery = window.matchMedia("(max-width: 920px)");
  const description = document.querySelector("[data-bi-description]");
  const toggle = document.querySelector("[data-bi-read-more]");

  if (!description || !toggle) {
    return;
  }

  const updateVisibility = () => {
    if (!mediaQuery.matches) {
      description.removeAttribute("data-expanded");
      toggle.hidden = true;
      toggle.setAttribute("aria-expanded", "false");
      toggle.textContent = "Read more";
      return;
    }

    toggle.hidden = false;
  };

  toggle.addEventListener("click", function () {
    const expanded = description.getAttribute("data-expanded") === "true";
    description.setAttribute("data-expanded", expanded ? "false" : "true");
    toggle.setAttribute("aria-expanded", expanded ? "false" : "true");
    toggle.textContent = expanded ? "Read more" : "Read less";
  });

  updateVisibility();
  mediaQuery.addEventListener("change", updateVisibility);
});
</script>
<?php
get_footer();
