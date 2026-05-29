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

function ilpra_2026_get_homepage_data(): array
{
    $fairs = ilpra_2026_get_homepage_fairs();

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
        'fairs' => $fairs,
        'search_template_id' => 5061,
    ];
}
