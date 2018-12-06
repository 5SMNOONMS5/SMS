<?php

use Faker\Generator as Faker;
use Models\SMS\SMSLog;
use Models\SMS\SMSAccount;
use Models\SMS\SMSTemplate;

$factory->define(SMSLog::class, function (Faker $faker) {
    static $id = 1;
    return [
        'telephone_id'         => $id++,
        'account_id'           => 0,
        'currency'             => $faker->randomElement($array = array ("RMB", "USD")),
        'fee'                  => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0.0001, $max = 0.01),
        'phone'                => $faker->e164PhoneNumber(),
        'content'              => $faker->realText(10, 2),
        'department'           => $faker->randomElement($array = array (0, 1)),
        'status'               => $faker->randomElement($array = array('0', '1')),
        'admin_id'             => $faker->numberBetween(1, 100)
    ];
});

$factory->define(SMSTemplate::class, function (Faker $faker) {

    $rules = [
        ['#name#',                     '名字'],
        ['#account#',                  '帳號'],
        ['#package#',                  '包裹名稱'],
        ['#name#,#account#',           '名字,帳號'],
        ['#name#,#package#',           '名字,包裹名稱'],
        ['#account#,#package#,#name#', '帳號,包裹名稱,名字']
    ];

    $index    = $faker->numberBetween(0, count($rules)-1);
    $sign     = ['[ 蘋果 ]', '[ 紫光 ]'];

    return [
        'account_id'           => 0,
        'provider_template_id' => $faker->numberBetween(11231, 1232131),
        'rule'                 => $rules[$index][0],
        'rule_title'           => $rules[$index][1],
        'content'              => $faker->realText(10, 2),
        'sign'                 => $faker->randomElement($sign)
    ];
});

$factory->define(SMSAccount::class, function (Faker $faker) {

    $providers  = ['Nexmo', 'Yunpian'];

    return [
        'key'                  => $faker->md5(),
        'secret_key'           => $faker->md5(),
        'account'              => $faker->email(),
        'provider'             => $faker->randomElement($providers),
        'remark'               => $faker->realText(10, 2),
        'status'               => $faker->randomElement($array = array (0, 1))
    ];
});