<?php

return [
    /*
    | * Anything lower than low-rate is considered 'OFFICIAL'
    | * Anything higher than high-rate is considered 'SUPER HIGH RATE'
    */

    'exp' => [
        'low-rate' => [
           'min' => 6,
           'max' => 50,
       ],
        'mid-rate' => [
            'min' => 51,
            'max' => 300,
        ],
        'high-rate' => [
            'min' => 301,
            'max' => 5000,
        ],
    ],

    'tags' => [
        'freebies',
        'gepard',
        'guild-pack',
        'pk-mode',
        'mobile',
        'frost',
        'no-donations',
        'instant-level',
        'themed-server',
    ],

    'languages' => [
        'english',
        'french',
        'german',
        'irish',
        'portuguese',
        'malaysian',
        'mandarin',
        'russian',
        'spanish',
        'tagalog',
    ],

    'modes' => [
        'renewal',
        'pre-renewal',
        'custom',
        'classic',
    ],

    'rates' => [
        'official-rate',
        'low-rate',
        'mid-rate',
        'high-rate',
        'super-high-rate',
    ],

    'accents' => [
        'nightmare',
        'poring',
        'drops',
        'deviling',
        'ghostring',
        'poporing',
        'pouring',
    ],
];
