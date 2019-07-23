<?php

return [

    'defaultName' => 'Default RO',
    'defaultMarkup' => '# Welcome to RagnaRanks markdown editor!
 You can write something nice and descriptive with a huge amount of different formats!\' [Guide](https://github.com/adam-p/markdown-here/wiki/Markdown-Cheatsheet)
 You can also use emojis copied from the web and paste them right here! 😍
 
**Please utilize all the configuration options to allow us to maximize the potential of your listing(s)!**',

    'config' => [
        'max_base_level' => [
            'name' => 'Max Base Level',
            'describe' => 'The highest base level that can be achieved.',
        ],
        'max_job_level' => [
            'name' => 'Max Job Level',
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
            'name' => 'Base EXP Rate',
            'describe' => 'Rate at which base experience is given.',
        ],
        'job_exp_rate' => [
            'name' => 'Job EXP Rate',
            'describe' => 'Rate at which job experience is given.',
        ],
        'quest_exp_rate' => [
            'name' => 'Quest EXP Rate',
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
    ],

    'reviews' => [
        'heading' => 'player reviews',
        'enticement' => 'be the first to write a review on this server listing',
    ],

    'voting' => [
        'heading' => [
            'pending' => 'You are voting for :name',
            'completed' => 'You have already voted for :name',
            'declined' => 'We could not process your vote right now!',
            'finished' => 'You successfully voted on :name!',
        ],
        'spending' => 'You have :value votes available to spend on this server!',
        'pending' => 'When you have decided to give this server your vote, you will not be able to give another vote for :hours hours to any other server, this prevents mass voting and allows votes to have value on our ranking algorithm.',
        'completed' => 'Thanks for your interest in another vote to this server, however you must wait :hours hours from your first vote before you can send another vote',
        'declined' => 'Sorry for the inconvenience, you can true voting later or get in touch with an administrator to make the problem aware.',
        'finished' => 'Your vote has been sent to this server, and will be applied for the next 7 days, you can continue to vote every :hours hours, thank you for your continued support on behalf of RagnaRanks and :name.',
    ],

    'buttons' => [
        'save_server' => 'Save my new server listing',
        'update_server' => 'Update my server listing',
        'delete_server' => 'Delete this server listing',
    ],
];
