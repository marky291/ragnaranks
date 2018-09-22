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
           'low-rate' => [
               'min' => 1,
               'max' => 100,
           ],
            'mid-rate' => [
                'min' => 100,
                'max' => 1500,
            ],
            'high-rate' => [
                'min' => 1500,
                'max' => 50000,
            ]
        ]

    ];