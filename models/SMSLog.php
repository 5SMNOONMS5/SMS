<?php

namespace App\Http;

use Illuminate\Database\Eloquent\Model;
use App\Http\SMSAccount;

class SMSLog extends Model
{
	protected $table   = "sms_log";

	protected $guarded = ['id'];

   /**
	* 發送狀態
	*/
    const STATUS = [
        0  =>  '失敗',
        1  =>  '成功',
        2  =>  '尚未發送'
    ];

   /**
	* many logs may belong to one account
	*/
	public function account()
	{
		return $this->belongsTo(SMSAccount::class, "id", "account_id");
	}

	/**
     *  發送狀態
     *  @return [type] [description]
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}
