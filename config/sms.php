<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    | 廠商相關訊息
    |
    */

    // Nexmo平台, cf. https://nexmo.com/
    'nexmo'  => [
        'name'     => 'Nexmo',
        'class'    => Maxin\Sms\Providers\Nexmo\Factory::class,
        'accounts' => [
            [
                'name'   => 'account1',
                'key'    => 'account1_key',
                'secret' => 'account1_secret_key'
            ],
            [
                'name'   => 'account2',
                'key'    => 'account2_key',
                'secret' => 'account2_secret_key'
            ],
            // Add more account here
        ]
    ],

    // 雲片平台, cf. https://nexmo.com/
    'yunpian' => [
        'name'     => '雲片',
        'class'    => Maxin\Sms\Providers\Yunpian\Factory::class,
        'accounts' => [
            [
                'name' => 'account1',
                'key'  => 'account1_key'
            ],
            [
                'name' => 'account2',
                'key'  => 'account2_key'
            ],
            // Add more account here
        ]
    ]
];
