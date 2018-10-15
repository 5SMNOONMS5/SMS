<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use App\Http\SMSLog;
use App\Http\SMSTemplate;

class SMSAccount extends Model
{
    protected $table   = "sms_account";

    protected $guarded = ['id'];

   /**
	* 發送狀態
	*/
    const STATUS = [
        0  =>  '禁用',
        1  =>  '啟動'
    ];

    /**
     * Each account may have many templates
     */
    public function template()
    {
    	return $this->hasMany(SMSTemplate::class, "account_id", "id");
    }

    /**
     * Each account may have many logs
     */
    public function log()
    {
    	return $this->hasMany(SMSLog::class, "account_id", "id");
    }
}
