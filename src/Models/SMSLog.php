<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use App\Http\SMSTemplate;

class SMSLog extends Model
{
    protected $table = "sms_log";

    /**
     * Each log has its own template
     */
    public function template()
    {
        return $this->hasOne(SMSTemplate::class);
    }
}
