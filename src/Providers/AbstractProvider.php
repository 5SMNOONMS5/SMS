<?php

namespace Maxin\Sms\Providers;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;

use Maxin\Sms\SMS;

abstract class AbstractProvider 
{	
    /**
     * Query parameters 
     */
    protected $queryParameters   = [];

    /**
     * Each provider has its own require parameters, specific for safty purpose
     */
    protected $requireParameters = [];

    /**
     * Request URL
     */
    protected $requestUrl        = "";

    /**
     * Response Data from each provider
     */
    public $response             = [];

    /**
     * Set request prerequisite such as requestUrl and requireParameters;
     *
     * @param  string $number
     * @param  string $text
     * @param  array  $custom
     * @return self
     */
    abstract public function setPrerequisite(array $requireParameters = [], string $requestUrl = '');

	/**
     * Set and map each parameter into provider special query keys
     *
     * @param  string $number
     * @param  string $text
     * @param  array  $custom
     * @return self
     */
	abstract public function setQueryParameters(string $number = '', string $text = '', array $custom = []);

	/**
     * Map the raw response data to a SMS instance.
     *
     * @param  object $sms
     * @param  array  $rawData
     * @return \Maxin\Sms\SMS
     */
    abstract protected function mapToObject($sms, $rawData);

    /**
     * Set each provider default parameters, such as Api_key, Api_secert.
     *
     * @return array
     */
    abstract protected function defaultParameters();

    /**
     * Map response raw data into sms's properties
     *
     * @return sms object
     */
    public function sms()
    {
    	return $this->mapToObject(new SMS($this->getStaticClassName()), $this->response);
    }

   	/**
     * send sms message 
     *
     * @return self 
     */
	public function send()
	{
        $this->queryParameters = array_merge($this->queryParameters, $this->defaultParameters());

        $this->checkRequireParameters();

             // dd($this->queryParameters, $this->requestUrl);

		$this->request();

		return $this;
	}

    /**
     * implement request with GuzzleHttp
     *
     * @return self 
     */
    protected function request() 
    {
        $client = new Client([
            RequestOptions::HEADERS => [
                'Accept'       => 'text/plain',
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8',
            ]
        ]);

        $response = $client->request('POST', $this->requestUrl, [
            RequestOptions::BODY => http_build_query($this->queryParameters)
        ]);

        $this->response = json_decode($response->getBody(), true);

        return $this;
    }

	/**
     * Get value by given key in sms config file
     *
     * @return string 
     */
	protected function getConfigValue($key) 
	{	
		$class = $this->getStaticClassName();
		return config('sms.' . strtolower($class) . '.' . $key);
	}

	/**
     * Check wether all query parameters fulfill provider needs
     * 
     * @throws Exception
     */
	private function checkRequireParameters()
	{
		$diff = collect($this->requireParameters)->diff(array_keys($this->queryParameters));
		
		// dd($this->requireParameters, array_keys($this->queryParameters), $diff);

		if ($diff->count() != 0) {
			throw new Exception('Missing Require Parameters '. $diff->values());
		} 
	}

	/**
     * Returns the name of the static class of an object
     * 
     * @throws string
     */
	private function getStaticClassName()
	{
		$classPath = explode("\\", static::class);
		return end($classPath);
	}

}

