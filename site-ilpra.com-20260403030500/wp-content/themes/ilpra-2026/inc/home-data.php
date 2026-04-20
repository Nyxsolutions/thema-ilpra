<?php
if (!defined('ABSPATH')) {
    exit;
}

function ilpra_2026_get_homepage_data(): array
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
        'fairs' => [
            [
                'city_date' => 'Algeria, 12-15 April 2026',
                'image_id' => 16097,
                'stand' => 'Stand C 154',
                'hall' => 'Hall CT',
                'url' => 'https://www.djazagro.com/en/LP-exhibitors/LP-PMAX-IT',
                'target' => '_blank',
            ],
            [
                'city_date' => 'Dusseldorf, 7-13 May 2026',
                'image_id' => 15257,
                'stand' => 'Stand 5C3',
                'hall' => 'Hall 5',
                'url' => 'https://www.interpack.com/',
                'target' => '_blank',
            ],
            [
                'city_date' => 'Parma, 27-30 October 2026',
                'image_id' => 16260,
                'stand' => 'Stand E014',
                'hall' => 'Hall 2',
                'url' => 'https://www.interpack.com/',
                'target' => '_blank',
            ],
        ],
        'search_template_id' => 5061,
    ];
}
