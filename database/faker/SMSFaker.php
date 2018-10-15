<?php

namespace App;

use App\Http\SMSLog;
use App\Http\SMSTemplate;
use App\Http\SMSAccount;

final class SMSFaker
{
    const AMOUNT = 10;

    /**
     * Seeding
     */
    public function seed()
    {
        factory(SMSAccount::class, (self::AMOUNT))
            ->create()
            ->each(
                function ($account) {
                    $account->template()->saveMany(factory(SMSTemplate::class, 2)->create());
                    $account->log()->saveMany(factory(SMSLog::class, 300)->create());
                }
            );
    }

    /**
     * Flush 
     */
    public function flush()
    {
        SMSTemplate::truncate();
        SMSLog::truncate();
        SMSAccount::truncate();
    }
}