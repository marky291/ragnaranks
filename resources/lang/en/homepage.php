<?php
    return [

        'card' => [
            'review' => [
                'positive' => 'with mostly positive reviews',
                'mediocre' => 'with mixed reviews',
                'negative' => 'with mainly negative reviews',
                'fresh' => 'with no player reviews',
            ],
            'rate' => [
                'official-rate' => 'Official Rate Server',
                'low-rate' => 'Low Rate Server',
                'mid-rate' => 'Mid Rate Server',
                'high-rate' => 'High Rate Server',
                'super-high-rate' => 'Super High Rate Server',
            ],
        ],

        'rate' => [
            'all' => [
                'name' => 'Any Rates',
            ],
            'official-rate' => [
                'name' => 'Official Rates',
            ],
            'low-rate' => [
                'name' => 'Low Rates',
            ],
            'mid-rate' => [
                'name' => 'Mid Rates',
            ],
            'high-rate' => [
                'name' => 'High Rates',
            ],
            'super-high-rate' => [
                'name' => 'Super High Rates',
            ],
            'null' => [
                'name' => 'Unknown Rates',
            ],
        ],

        'mode' => [
            'all' => [
                'name' => 'Any Mode',
                'describe' => 'Do not filter with any specific mode.',
            ],
            'renewal' => [
                'name' => 'Renewal',
                'describe' => 'This listing is based on renewal format',
            ],
            'pre-renewal' => [
                'name' => 'Pre-Renewal',
                'describe' => 'This listing is based on pre-renewal format',
            ],
            'custom' => [
                'name' => 'Custom',
                'describe' => 'This listing uses a custom format.',
            ],
            'classic' => [
                'name' => 'Classic',
                'describe' => 'This listing uses a classic format',
            ],
        ],

        'tag' => [
            'all' => [
                'name' => 'With any Tags',
                'describe' => 'Do not filter by a specific tag.',
            ],
            'freebies' => [
                'name' => 'Freebies',
                'describe' => 'Players can obtain starting items once they login or from Newbie NPC.',
            ],
            'gepard' => [
                'name' => 'Gepard Protection',
                'describe' => 'This listing supports anti-bot and anti-hack software.',
            ],
            'guild-pack' => [
                'name' => 'Guild Pack',
                'describe' => 'A guild can obtain a large amount of freebies for their members.',
            ],
            'pk-mode' => [
                'name' => 'PK Mode',
                'describe' => 'Players are able to engage in player vs player in all areas except towns.',
            ],
            'mobile' => [
                'name' => 'Mobile',
                'describe' => 'This server can be installed, played and enjoyed on Android Devices.',
            ],
            'frost' => [
                'name' => 'Frost',
                'describe' => 'Players are affected by Freeze effect.',
            ],
            'no-donations' => [
                'name' => 'No Donations',
                'describe' => 'Players are unable to obtain items through donation methods.',
            ],
            'instant-level' => [
                'name' => 'Instant Level',
                'describe' => 'Players can chose a class and max out base and job levels instantly by login or by NPC.',
            ],
            'themed-server' => [
                'name' => 'Themed Server',
                'describe' => 'A server that has a heavy theme and/or lots of roleplay and storytelling.',
            ],
            'grinding' => [
                'name' => 'Grinding',
                'describe' => 'There is lots of time consuming tasks to accomplish and achieve.'
            ]
        ],

        'order' => [
            'rank' => [
                'name' => 'Sorted by Rank Position',
            ],
            'name' => [
                'name' => 'Sorted by Server Name',
            ],
            'created' => [
                'name' => 'Sorted by Date Added',
            ],
        ],

        'listings' => [
            'none_found' => 'No Listings found with requested parameters.',
        ],
    ];
