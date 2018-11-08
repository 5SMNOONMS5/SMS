<?php

namespace Maxin\Sms\Providers;

use Exception;
use InvalidArgumentException;
use Maxin\Sms\Error;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Exception\GuzzleException;

abstract class AbstractAPI
{	
    /**
     * Parameters that sent within the request
     *
     * @var array
     */
    public $parameters = [];

    /**
     * Response data 
     */
    public $response   = [];

    /**
     * Request url
     */
    public $url        = [];

    /**
     * Current activity account
     */
    public $account    = "";

    /**
     * Config values
     */
    public $config     = [];

    /**
     * Get require parameters
     *
     * @return self
     */
    abstract public function getRequireParameters();

    /**
     * Get request url
     *
     * @return self
     */
    abstract public function getRequestURL();

    /**
     * Request
     *
     * @return self
     */
    abstract public function request();

    /**
     * Construct
     *
     * @return self
     */   
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * implement http post request via Guzzle HTTP client
     *
     * @return self 
     */
    public function post()
    {
        if (!$this->checkRequireParameters()) return; 

        $client = new Client([
            RequestOptions::HEADERS => [
                'Accept'       => 'text/plain',
                'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8',
            ]
        ]);

        $response = $client->request('POST', $this->getRequestURL(), [
            RequestOptions::BODY        => http_build_query($this->parameters),
            RequestOptions::HTTP_ERRORS => false
        ]);

        $this->response = json_decode($response->getBody(), true);

        return $this;
    }

    /**
     * implement http get request via Guzzle HTTP client
     *
     * @return self 
     */
    public function get()
    { 
        if (!$this->checkRequireParameters()) return; 

        $response = (new Client())->request('GET', $this->getRequestURL(), [
            'query' => $this->parameters
        ]);
        
        $this->response = json_decode($response->getBody(), true);

        return $this;
    }

	/**
     * Get value by the given key that under 'accounts' key in sms config file, 
     * 
     * @return string
     */
	protected function getAccountDetail($key) 
	{	
        $accounts = $this->config['accounts'];
        /// Get first account
        $account  = reset($accounts);
        
        if ($this->account === '') {
            return $account[$key];
        }

        foreach ($accounts as $value) {
            if ($value['name'] === $this->account) {
                $account = $value;
                break;
            }
        }

        return $account[$key];
    }

    /**
     * Get provider name
     * 
     * @return string
     */
    public function getProviderName()
    {
        return $this->config['providerName'];
    }

	/**
     * Check wether all query parameters fulfill api needs
     * 
     * @throws Exception
     */
	protected function checkRequireParameters()
	{
        $diff = [];
        foreach (array_keys($this->parameters) as $value) {
            if (!in_array($value, $this->getRequireParameters())) {
                array_push($diff, $value);
            }
        }

        if (count($diff) != 0) {
            throw new Exception('Missing Require Parameters '. (implode(",", $diff)));
        }

        return true;
    }


    /**
     * @return mixed
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * @param mixed $account
     *
     * @return self
     */
    public function setAccount($account)
    {
        $this->account = $account;

        return $this;
    }
}

