<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SMSTemplate extends Model
{
	use SoftDeletes;

    protected $table = "sms_template";
}
