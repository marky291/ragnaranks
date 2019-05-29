<?php

    return [
        /*
        |--------------------------------------------------------------------------
        | FILTER EXP SERVER TYPES
        |--------------------------------------------------------------------------
        |
        | This configuration defines the values required to filter out the types
        | of servers based on their base_exp_rate.
        |
        */

        'exp' => [
           'classic' => [
               'min' => 0,
               'max' => 5,
           ],
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
             'custom' => [
               'min' => 5001,
               'max' => 100000,
           ],
        ],

    ];
