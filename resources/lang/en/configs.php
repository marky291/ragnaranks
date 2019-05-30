<?php

return [
    'max_base_level' => [
        'name' => 'Max Base',
        'describe' => 'The highest base level that can be achieved',
    ],
    'max_job_level' => [
        'name' => 'Max Job',
        'describe' => 'The highest job level that can be achieved',
    ],
    'max_aspd' => [
        'name' => 'Max ASPD',
        'describe' => 'Maximum atk speed. (Default 190, Highest allowed 199)',
    ],
    'max_stats' => [
        'name' => 'Max Stats',
        'describe' => 'The maximum stat parameter that can be selected',
    ],
    'arrow_decrement' => [
        'name' => 'Unlimited Arrows',
        'describe' => 'Are arrows/ammo consumed when used on a bow/gun?',
    ],
    'undead_detect_type' => [
        'name' => 'Detect Undead',
        'describe' => 'Should race or element be used to consider someone undead?',
    ],
    'attribute_recover' => [
        'name' => 'Attribute Recovery',
        'describe' => 'Does HP recover if hit by an attribute that\'s same as your own?',
    ],
    'cast_rate' => [
        'name' => 'Cast Rate',
        'describe' => 'The rate of time it takes to cast a spell',
    ],
    'delay_rate' => [
        'name' => 'Delay Rate',
        'describe' => 'Delay time after casting',
    ],
    'castrate_dex_scale' => [
        'name' => 'Dex Required',
        'describe' => 'At what dex does the cast time become zero (instacast)',
    ],
    'vcast_stat_scale' => [
        'name' => 'vcast_stat_scale',
        'describe' => 'How much (dex*2+int) does variable cast turns zero',
    ],
    'base_exp_rate' => [
        'name' => 'Base EXP',
        'describe' => 'Rate at which base exp. is given.',
    ],
    'job_exp_rate' => [
        'name' => 'Job EXP',
        'describe' => 'Rate at which job exp. is given.',
    ],
    'quest_exp_rate' => [
        'name' => 'Quest EXP',
        'describe' => 'Rate of base/job exp given by NPCs.',
    ],

    'item_drop_common' => [
        'name' => 'Common Drops',
        'describe' => 'The rate the common items are dropped (Items that are in the ETC tab, besides card)',
    ],
    'item_drop_equip' => [
        'name' => 'Equip Drops',
        'describe' => 'The rate at which equipment is dropped.',
    ],
    'item_drop_card' => [
        'name' => 'Card Drops',
        'describe' => 'The rate at which cards are dropped',
    ],
    'item_drop_treasure' => [
        'name' => 'Treasure Drops',
        'describe' => 'Rate adjustment for Treasure Box drops',
    ],
    'item_drop_common_mvp' => [
        'name' => 'MVP Common Drops',
        'describe' => 'The rate the common items are dropped by MVPS (Items that are in the ETC tab, besides card)',
    ],
    'item_drop_equip_mvp' => [
        'name' => 'MVP Equip Drops',
        'describe' => 'The rate at which equipment is dropped by MVPS.',
    ],
    'item_drop_card_mvp' => [
        'name' => 'MVP Card Drops',
        'describe' => 'The rate at which cards are dropped',
    ],
    'drops_by_luk' => [
        'name' => 'Influenced Drops',
        'describe' => 'Does luck affect the drops by absolute basis.',
    ],
];
