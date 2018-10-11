<?php

use Faker\Generator as Faker;
use App\Http\SMSLog;
use App\Http\SMSAccount;
use App\Http\SMSTemplate;

$factory->define(SMSLog::class, function (Faker $faker) {
        static $id = 1;
        return [
            'telephone_id'         => $id++,
            'account_id'           => 0,
            'fee'                  => $faker->numberBetween(0.001, 0.01),
            'phone'                => $faker->e164PhoneNumber(),
            'content'              => $faker->realText(10, 2),
            'department'           => $faker->randomElement($array = array (0, 1)),
            'status'               => $faker->randomElement($array = array('0', '1', '2')),
            'admin_id'             => $faker->numberBetween(1, 100)
        ];
    }
);

$factory->define(SMSTemplate::class, function (Faker $faker) {
        $rules = ['$name', '$account', '$package', '$name,$account', '$name,$package', '$account,$package,$name'];
        $sign  = ['[ 蘋果 ]', '[ 紫光 ]', '[ 華為 ]'];
         // 'account_id'
        return [
            'account_id'           => 0,
            'provider_template_id' => $faker->numberBetween(11231, 1232131),
            'rule'                 => $faker->randomElement($rules),
            'content'              => $faker->realText(10, 2),
            'sign'                 => $faker->randomElement($sign)
        ];
    }
);


$factory->define(SMSAccount::class, function (Faker $faker) {

        $providers  = ['Nexmo', 'Yunpain'];

        return [
            'key'                  => $faker->md5(),
            'secret_key'           => $faker->md5(),
            'account'              => $faker->email(),
            'provider'             => $faker->randomElement($providers),
            'remark'               => $faker->realText(10, 2),
            'status'               => $faker->randomElement($array = array (0, 1, 2))
        ];
    }
);