<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Vote Interaction
    |--------------------------------------------------------------------------
    |
    | A vote occurs when a user decided to assign their accumulated total
    | on hourly spread, the total points of a vote is the value.
    |
    */
    'vote' => [
        'total' => 1,
        'spread' => 12,
        'value' => 7,
    ],

    /*
    |--------------------------------------------------------------------------
    | Click Interaction
    |--------------------------------------------------------------------------
    |
    | A click occurs when a user visits a card or a website belonging to a listing
    | this is tracked using an ip_address and will accumulate the total every
    | hourly spread, the total points of a click is the value.
    |
    */
    'click' => [
        'total' => 50,
        'spread' => 1,
        'value' => 1,
    ],
];
