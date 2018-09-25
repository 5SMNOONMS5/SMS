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

    // Nexmo 平台,     cf. https://nexmo.com/
    'nexmo'  => [
        'class'       => Maxin\Sms\Providers\Nexmo::class,
        'key'         => 'e266a819',
        'secret'      => 'EJFJNDPZAAZb5vDY',
        'url'         => 'https://rest.nexmo.com/sms/json'
    ],

    // 雲片  平台,     cf. https://nexmo.com/
    'yunpian' => [
        'class'       => Maxin\Sms\Providers\Yunpian::class,
        'key'         => 'b7bfd7264151d75da63df1eb0efee5c7',
        'url'         => 'https://sms.yunpian.com/',
        'url_oversee' => 'https://us.yunpian.com/'
    ],

];
