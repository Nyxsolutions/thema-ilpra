<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_normalize_homepage_fairs_from_acf($rows): array
{
    if (!is_array($rows)) {
        return [];
    }

    $fairs = [];

    foreach ($rows as $row) {
        if (!is_array($row)) {
            continue;
        }

        $city_date = trim((string) ($row['city_date'] ?? ''));
        $image_id = (int) ($row['image'] ?? 0);
        $stand = trim((string) ($row['stand'] ?? ''));
        $hall = trim((string) ($row['hall'] ?? ''));
        $link = $row['link'] ?? null;
        $url = '';
        $target = '_self';

        if (is_array($link)) {
            $url = trim((string) ($link['url'] ?? ''));
            $target = trim((string) ($link['target'] ?? '')) ?: '_self';
        }

        if ($city_date === '' && !$image_id && $stand === '' && $hall === '' && $url === '') {
            continue;
        }

        $fairs[] = [
            'city_date' => $city_date,
            'image_id' => $image_id,
            'stand' => $stand,
            'hall' => $hall,
            'url' => $url,
            'target' => $target,
            'is_clickable' => $url !== '',
        ];
    }

    return $fairs;
}

function ilpra_2026_map_homepage_fairs_to_acf_rows(array $fairs): array
{
    $rows = [];

    foreach ($fairs as $fair) {
        $rows[] = [
            'city_date' => $fair['city_date'] ?? '',
            'image' => (int) ($fair['image_id'] ?? 0),
            'stand' => $fair['stand'] ?? '',
            'hall' => $fair['hall'] ?? '',
            'link' => !empty($fair['url'])
                ? [
                    'title' => '',
                    'url' => $fair['url'],
                    'target' => $fair['target'] ?? '_self',
                ]
                : null,
        ];
    }

    return $rows;
}

function ilpra_2026_get_homepage_fairs(): array
{
    if (!function_exists('get_field') || !function_exists('get_option')) {
        return [];
    }

    $front_page_id = (int) get_option('page_on_front');

    if ($front_page_id <= 0) {
        return [];
    }

    return ilpra_2026_normalize_homepage_fairs_from_acf(get_field('homepage_fairs', $front_page_id));
}

function ilpra_2026_get_homepage_front_page_id(): int
{
    return function_exists('get_option') ? (int) get_option('page_on_front') : 0;
}

function ilpra_2026_get_homepage_default_data(): array
{
    return [
        'hero' => [
            'kicker' => 'More Than Machinery',
            'title' => 'A global partner for your packaging needs',
            'content' => 'Complete packaging systems designed, manufactured and supported by ILPRA since 1955',
            'video_mp4' => home_url('/wp-content/uploads/2024/11/video_homepage.mp4'),
            'video_webm' => home_url('/wp-content/uploads/2024/11/video_homepage.webm'),
            'poster' => home_url('/wp-content/uploads/2024/11/videoplayback.svg'),
        ],
        'industry_intro' => [
            'title' => 'What product do you need to pack?',
        ],
        'industries' => [
            [
                'image_id' => 12859,
                'title' => 'Food',
                'content' => 'Efficient and reliable solutions for fresh, ready and processed food packaging.',
                'button' => [
                    'label' => 'View solutions',
                    'url' => home_url('/packaging/'),
                ],
            ],
            [
                'image_id' => 12860,
                'title' => 'Medical & Cosmetics',
                'content' => 'Safe and precise packaging technologies for medical, cosmetic and personal care products.',
                'button' => [
                    'label' => 'View solutions',
                    'url' => home_url('/packaging/'),
                ],
            ],
        ],
        'machines_intro' => [
            'title' => 'A wide range of packaging machines',
            'content' => "ILPRA designs and manufactures complete packaging machines for the food, medical, cosmetic and non-food sectors.\nSince 1955, we support companies worldwide with reliable systems for tray sealing, thermoforming, filling, forming & filling and automated handling.",
        ],
        'machines' => [
            [
                'image_id' => 15491,
                'title' => 'Tray sealers',
                'content' => 'Semi-automatic - Automatic - In Line',
                'url' => home_url('/packaging-machines/foodpack-traysealers/'),
            ],
            [
                'image_id' => 15507,
                'title' => 'Fill Sealers',
                'content' => 'Rotary - In Line',
                'url' => home_url('/packaging-machines/fill-seal-pot-fillers/'),
            ],
            [
                'image_id' => 15494,
                'title' => 'Thermoformers',
                'content' => 'Compact - Customisable',
                'url' => home_url('/packaging-machines/formpack-thermoformers/'),
            ],
            [
                'image_id' => 15500,
                'title' => 'Form Fill Seal Machines',
                'content' => 'Automatic',
                'url' => home_url('/packaging-machines/form-fill-seal/'),
            ],
            [
                'image_id' => 15496,
                'title' => 'End of Line Machinery',
                'content' => 'Picking & Palletization',
                'url' => home_url('/packaging-machines/end-of-line/'),
            ],
            [
                'image_id' => 15686,
                'title' => 'ILPRA Group - Packaging Equipment',
                'content' => 'ILPRA Group - Packaging Equipment',
                'url' => home_url('/packaging-machines/ilpragroup-packagingequipment/'),
            ],
        ],
        'news_intro' => [
            'title' => 'News & Exhibitions',
        ],
    ];
}

function ilpra_2026_get_acf_link_value($value, array $fallback = []): array
{
    $link = is_array($fallback) ? $fallback : [];

    if (!is_array($value)) {
        return $link;
    }

    $url = trim((string) ($value['url'] ?? ''));

    if ($url === '') {
        return $link;
    }

    return [
        'label' => trim((string) ($value['title'] ?? '')) ?: (string) ($link['label'] ?? ''),
        'url' => $url,
        'target' => trim((string) ($value['target'] ?? '')) ?: (string) ($link['target'] ?? '_self'),
    ];
}

function ilpra_2026_get_homepage_cards_from_acf($rows, array $fallback_items): array
{
    if (!is_array($rows)) {
        return $fallback_items;
    }

    $items = [];

    foreach ($rows as $index => $row) {
        if (!is_array($row)) {
            continue;
        }

        $fallback = $fallback_items[$index] ?? [];
        $title = trim((string) ($row['title'] ?? ''));
        $content = trim((string) ($row['content'] ?? ''));
        $image_id = (int) ($row['image'] ?? 0);
        $link = ilpra_2026_get_acf_link_value($row['link'] ?? null, $fallback['button'] ?? ['url' => $fallback['url'] ?? '', 'label' => '']);

        if ($title === '' && $content === '' && !$image_id && empty($link['url'])) {
            continue;
        }

        $items[] = [
            'image_id' => $image_id ?: (int) ($fallback['image_id'] ?? 0),
            'title' => $title !== '' ? $title : (string) ($fallback['title'] ?? ''),
            'content' => $content !== '' ? $content : (string) ($fallback['content'] ?? ''),
            'url' => !empty($link['url']) ? (string) $link['url'] : (!empty($fallback['url']) ? (string) $fallback['url'] : ''),
            'button' => $link ?: ($fallback['button'] ?? []),
        ];
    }

    return !empty($items) ? $items : $fallback_items;
}

function ilpra_2026_get_homepage_data(): array
{
    $front_page_id = ilpra_2026_get_homepage_front_page_id();
    $defaults = ilpra_2026_get_homepage_default_data();
    $fairs = ilpra_2026_get_homepage_fairs();

    if (!function_exists('get_field') || $front_page_id <= 0) {
        return array_merge($defaults, [
            'fairs' => $fairs,
            'search_template_id' => 5061,
        ]);
    }

    $hero = [
        'kicker' => trim((string) get_field('home_hero_kicker', $front_page_id)) ?: $defaults['hero']['kicker'],
        'title' => trim((string) get_field('home_hero_title', $front_page_id)) ?: $defaults['hero']['title'],
        'content' => trim((string) get_field('home_hero_content', $front_page_id)) ?: $defaults['hero']['content'],
        'video_mp4' => trim((string) get_field('home_hero_video_mp4', $front_page_id)) ?: $defaults['hero']['video_mp4'],
        'video_webm' => trim((string) get_field('home_hero_video_webm', $front_page_id)) ?: $defaults['hero']['video_webm'],
        'poster' => trim((string) get_field('home_hero_poster', $front_page_id)) ?: $defaults['hero']['poster'],
    ];

    $industries = ilpra_2026_get_homepage_cards_from_acf(
        get_field('home_industry_items', $front_page_id),
        $defaults['industries']
    );

    $machines = ilpra_2026_get_homepage_cards_from_acf(
        get_field('home_machine_items', $front_page_id),
        $defaults['machines']
    );

    foreach ($industries as $index => $industry) {
        if (isset($industry['button'])) {
            continue;
        }

        $industries[$index]['button'] = $defaults['industries'][$index]['button'] ?? ['label' => '', 'url' => ''];
    }

    return [
        'hero' => $hero,
        'industry_intro' => [
            'title' => trim((string) get_field('home_industry_title', $front_page_id)) ?: $defaults['industry_intro']['title'],
        ],
        'industries' => $industries,
        'machines_intro' => [
            'title' => trim((string) get_field('home_machines_title', $front_page_id)) ?: $defaults['machines_intro']['title'],
            'content' => trim((string) get_field('home_machines_content', $front_page_id)) ?: $defaults['machines_intro']['content'],
        ],
        'machines' => $machines,
        'news_intro' => [
            'title' => trim((string) get_field('home_news_title', $front_page_id)) ?: $defaults['news_intro']['title'],
        ],
        'fairs' => $fairs,
        'search_template_id' => 5061,
    ];
}
