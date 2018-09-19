<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Providers
    |--------------------------------------------------------------------------
    |
    | 
    | 
    | 
    | 
    */

    'providers' => [
        // Nexmo 平台, cf. https://nexmo.com/
        'nexmo'   => [
            'class'       => Maxin\Sms\Providers\Nexmo::class,
            'key'         => 'e266a819',
            'secret'      => 'EJFJNDPZAAZb5vDY',
            'url'         => 'https://rest.nexmo.com/sms/json'
        ],
        // 雲片 平台, cf. https://nexmo.com/
        'yunpian' => [
            'class'       => Maxin\Sms\Providers\Yunpian::class,
            'key'         => 'b7bfd7264151d75da63df1eb0efee5c7',
            'baseurl'     => 'https://sms.yunpian.com/v2/'
        ]
    ]


    // https://sms.yunpian.com/v2/sms/single_send.json
    // https://us.yunpian.com/v2/sms/single_send.json
];
