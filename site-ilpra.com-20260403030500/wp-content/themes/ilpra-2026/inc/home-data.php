<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_parse_fair_stand(string $stand_value): array
{
    $stand_value = trim(preg_replace('/\s+/', ' ', $stand_value) ?? '');

    if ($stand_value === '') {
        return [
            'stand' => '',
            'hall' => '',
        ];
    }

    if (preg_match('/^(Stand\b.*?)(\s+Hall\b.*)$/i', $stand_value, $matches)) {
        return [
            'stand' => trim($matches[1]),
            'hall' => trim($matches[2]),
        ];
    }

    if (preg_match('/^(Hall\b.*?)(?:\s*[-–|,]\s*|\s+)(Stand\b.*)$/i', $stand_value, $matches)) {
        return [
            'stand' => trim($matches[2]),
            'hall' => trim($matches[1]),
        ];
    }

    return [
        'stand' => $stand_value,
        'hall' => '',
    ];
}

function ilpra_2026_get_homepage_fairs_section_index(int $front_page_id): ?int
{
    $layouts = get_post_meta($front_page_id, 'nw_flexible_content', true);

    if (!is_array($layouts)) {
        return null;
    }

    foreach ($layouts as $index => $layout_name) {
        if ($layout_name === 'content-fairs') {
            return (int) $index;
        }
    }

    return null;
}

function ilpra_2026_get_homepage_fairs(int $front_page_id): array
{
    $section_index = ilpra_2026_get_homepage_fairs_section_index($front_page_id);

    if ($section_index === null) {
        return [];
    }

    $rows_count = (int) get_post_meta($front_page_id, 'nw_flexible_content_' . $section_index . '_fiere_repeater', true);

    if ($rows_count < 1) {
        return [];
    }

    $fairs = [];

    for ($row_index = 0; $row_index < $rows_count; $row_index++) {
        $city_date = trim((string) get_post_meta($front_page_id, 'nw_flexible_content_' . $section_index . '_fiere_repeater_' . $row_index . '_fiera_city_date', true));
        $image_id = (int) get_post_meta($front_page_id, 'nw_flexible_content_' . $section_index . '_fiere_repeater_' . $row_index . '_fiera_image', true);
        $stand_value = trim((string) get_post_meta($front_page_id, 'nw_flexible_content_' . $section_index . '_fiere_repeater_' . $row_index . '_fiera_stand', true));
        $hall = trim((string) get_post_meta($front_page_id, 'nw_flexible_content_' . $section_index . '_fiere_repeater_' . $row_index . '_fiera_hall', true));
        $link_value = get_post_meta($front_page_id, 'nw_flexible_content_' . $section_index . '_fiere_repeater_' . $row_index . '_fiera_link', true);
        $link = maybe_unserialize($link_value);
        $stand_parts = ilpra_2026_parse_fair_stand($stand_value);
        $url = '';
        $target = '_self';

        if (is_array($link)) {
            $url = trim((string) ($link['url'] ?? ''));
            $target = trim((string) ($link['target'] ?? '')) ?: '_self';
        }

        if ($city_date === '' && !$image_id && $stand_value === '' && $hall === '' && $url === '') {
            continue;
        }

        $fairs[] = [
            'city_date' => $city_date,
            'image_id' => $image_id,
            'stand' => $stand_parts['stand'],
            'hall' => $hall !== '' ? $hall : $stand_parts['hall'],
            'url' => $url,
            'target' => $target,
            'is_clickable' => $url !== '',
        ];
    }

    return $fairs;
}

function ilpra_2026_get_homepage_data(): array
{
    $front_page_id = (int) get_option('page_on_front');
    $fairs = $front_page_id ? ilpra_2026_get_homepage_fairs($front_page_id) : [];

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
        'fairs' => !empty($fairs) ? $fairs : [
            [
                'city_date' => 'Algeria, 12-15 April 2026',
                'image_id' => 16097,
                'stand' => 'Stand C 154',
                'hall' => 'Hall CT',
                'url' => 'https://www.djazagro.com/en/LP-exhibitors/LP-PMAX-IT',
                'target' => '_blank',
                'is_clickable' => true,
            ],
            [
                'city_date' => 'Dusseldorf, 7-13 May 2026',
                'image_id' => 15257,
                'stand' => 'Stand 5C3',
                'hall' => 'Hall 5',
                'url' => 'https://www.interpack.com/',
                'target' => '_blank',
                'is_clickable' => true,
            ],
            [
                'city_date' => 'Parma, 27-30 October 2026',
                'image_id' => 16260,
                'stand' => 'Stand E014',
                'hall' => 'Hall 2',
                'url' => 'https://www.interpack.com/',
                'target' => '_blank',
                'is_clickable' => true,
            ],
        ],
        'search_template_id' => 5061,
    ];
}
