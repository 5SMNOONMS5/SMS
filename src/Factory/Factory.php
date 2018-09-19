<?php

namespace Maxin\Sms\Factory;

use App;

class SMSProviderFactory {

	static public function create($name)
	{	
		$instance = config('sms.providers.' . $name .'.class');

		return App::make($instance);
	}
}