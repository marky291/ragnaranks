<?php

return [
    'max_base_level' => [
        'name' => 'Base Level',
        'describe' => 'The highest base level that can be achieved.',
    ],
    'max_job_level' => [
        'name' => 'Job Level',
        'describe' => 'The highest job level that can be achieved.',
    ],
    'max_aspd' => [
        'name' => 'Max ASPD',
        'describe' => 'Maximum attack speed. (Default 190, Highest allowed 199)',
    ],
    'max_stats' => [
        'name' => 'Max Stats',
        'describe' => 'The maximum stat parameter that can be selected.',
    ],
    'arrow_decrement' => [
        'name' => 'Unlimited Arrows',
        'describe' => 'Are arrows/ammo consumed when used on a bow/gun?',
    ],
    'undead_detect_type' => [
        'name' => 'Detect Undead',
        'describe' => 'Does race or element consider someone undead?',
    ],
    'attribute_recover' => [
        'name' => 'Attribute Recovery',
        'describe' => 'Does HP recover if hit by an attribute that\'s the same as your own?',
    ],
    'pk_mode' => [
        'name' => 'Player Killing',
        'describe' => 'Weather player killing is promoted',
    ],
    'episode' => [
        'name' => 'Episode Version',
        'describe' => 'What version  does the emulator run on',
    ],
    'cast_rate' => [
        'name' => 'Cast Rate',
        'describe' => 'The rate of time it takes to cast a spell. (100 = 100%)',
    ],
    'instant_cast' => [
        'name' => 'Instant Cast',
        'describe' => 'At what point can you instant cast spells',
    ],
    'delay_rate' => [
        'name' => 'Delay Rate',
        'describe' => 'Delay time after casting. (100 = 100%)',
    ],
    'castrate_dex_scale' => [
        'name' => 'Dex Required',
        'describe' => 'Amount of DEX required before cast time is zero. (IE: Instant Cast)',
    ],
    'vcast_stat_scale' => [
        'name' => 'vcast_stat_scale',
        'describe' => 'Amount of (DEX*2+INT) before variable cast turn zero.',
    ],
    'base_exp_rate' => [
        'name' => 'Base Rate',
        'describe' => 'Rate at which base experience is given.',
    ],
    'job_exp_rate' => [
        'name' => 'Job Rate',
        'describe' => 'Rate at which job experience is given.',
    ],
    'quest_exp_rate' => [
        'name' => 'Quest Rate',
        'describe' => 'Rate of base/job experience given by NPCs.',
    ],

    'item_drop_common' => [
        'name' => 'Common Drops',
        'describe' => 'The rate at which common ETC items are dropped. (Cards excluded)',
    ],
    'item_drop_equip' => [
        'name' => 'Equip Drops',
        'describe' => 'The rate at which equipment are dropped.',
    ],
    'item_drop_card' => [
        'name' => 'Card Drops',
        'describe' => 'The rate at which cards are dropped.',
    ],
    'item_drop_treasure' => [
        'name' => 'Treasure Drops',
        'describe' => 'Rate adjustment for Treasure Box drops.',
    ],
    'item_drop_common_mvp' => [
        'name' => 'MVP Common Drops',
        'describe' => 'The rate at which common ETC items are dropped by MVPs. (Cards excluded)',
    ],
    'item_drop_equip_mvp' => [
        'name' => 'MVP Equip Drops',
        'describe' => 'The rate at which equipment are dropped by MVPs.',
    ],
    'item_drop_card_mvp' => [
        'name' => 'MVP Card Drops',
        'describe' => 'The rate at which cards are dropped by MVPs.',
    ],
    'drops_by_luk' => [
        'name' => 'Influenced Drops',
        'describe' => 'Does LUK stat affect the drops by absolute basis?',
    ],
];
