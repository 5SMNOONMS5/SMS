<?php

namespace Maxin\Sms\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractProvider 
{
	protected $queryParameters;

	protected $url;

	abstract public function setParamters(array $scope = []);

	public function send()
	{
		$client = new Client([
    		RequestOptions::HEADERS => [
			    'Accept'       => 'text/plain',
			    'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8',
    		]
		]);

		$response = $client->request('POST', $this->url, [
		    RequestOptions::BODY => http_build_query($this->queryParameters)
		]);

		return $response;
	}

	public function getConfigValue($key) 
	{
		$classPath = explode("\\", static::class);
		$class     = end($classPath);

	 	// dd($classPath, $class);
		return config('sms.providers.' . strtolower($class) . '.' . $key);
	}
}

