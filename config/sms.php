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
                'name'   => '',
                'key'    => 'e266a819',
                'secret' => 'EJFJNDPZAAZb5vDY'
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
                'name' => '',
                'key'  => 'b7bfd7264151d75da63df1eb0efee5c7'
            ],
            // Add more account here
        ]
    ],

];
