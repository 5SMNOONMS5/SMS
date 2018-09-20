<?php

namespace App;

use App\Http\SMSLog;
use App\Http\SMSTemplate;

final class SMSFaker
{
    /**
     * Seeding
     */
    public function seed()
    {
        factory(SMSTemplate::class, 5)->create();
        factory(SMSLog::class, 300)->create();
    }

    /**
     * Flush 
     */
    public function flush()
    {
        SMSTemplate::truncate();
        SMSLog::truncate();
    }
}