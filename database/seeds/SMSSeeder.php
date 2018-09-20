<?php

use App\SMSFaker;
use Illuminate\Database\Seeder;

class SMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(SMSFaker $faker)
    {
        $faker->flush();

        $faker->seed();
    }
}


