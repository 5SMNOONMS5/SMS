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
        'class'       => Tasb00429\Sms\Providers\Nexmo\Factory::class,
        'key'         => 'Your key',
        'secret'      => 'Your Secret key',
    ],
    // 雲片  平台,     cf. https://nexmo.com/
    'yunpian' => [
        'name'        => '雲片',
        'class'       => Tasb00429\Sms\Providers\Yunpian\Factory::class,
        'key'         => 'Your key',
    ],

];
