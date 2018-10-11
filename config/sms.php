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
        'name'        => 'Nexmo',
        'class'       => Maxin\Sms\Providers\Nexmo\Factory::class,
        'key'         => 'e266a819',
        'secret'      => 'EJFJNDPZAAZb5vDY',
    ],
    // 雲片  平台,     cf. https://nexmo.com/
    'yunpian' => [
        'name'        => '雲片',
        'class'       => Maxin\Sms\Providers\Yunpian\Factory::class,
        'key'         => 'b7bfd7264151d75da63df1eb0efee5c7',
    ],

];
