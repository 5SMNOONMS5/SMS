<?php

use Faker\Generator as Faker;
use App\Http\SMSLog as SMSLog;
use App\Http\SMSTemplate as SMSTemplate;

$factory->define(SMSLog::class, function (Faker $faker) {
        static $id = 1;
        return [
            'telephone_id' => $id++,
            'phone'        => $faker->e164PhoneNumber(),
            'content'      => $faker->realText(10, 2),
            'department'   => $faker->randomElement($array = array (0, 1)),
            'template_id'  => $faker->numberBetween(1, 100),
            'status'       => $faker->randomElement($array = array('0', '1')),
            'admin_id'     => $faker->numberBetween(1, 100)
        ];
    }
);

$factory->define(SMSTemplate::class, function (Faker $faker) {
        return [
            'content'      => $faker->realText(10, 2),
        ];
    }
);