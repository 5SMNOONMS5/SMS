<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\SMSAccount;

class SMSTemplate extends Model
{
	use SoftDeletes;

    protected $table   = "sms_template";

    protected $guarded = ['id'];

   /**
	* many template may belong to one account
	*/
	public function account()
	{
		return $this->belongsTo(SMSAccount::class, "account_id", "id");
	}
}
