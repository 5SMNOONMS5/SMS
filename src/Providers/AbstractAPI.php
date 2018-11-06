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
        $response = (new Client())->request('GET', $this->url);

        $this->response = json_decode($response->getBody(), true);

        return $this;
    }

    /**
     * Set request account especially when provdier supprts more than an account.
     *
     * @return self
     */
    public function setAccount(string $account = '')
    {
        $class = $this->getProviderName();
        return $this->getConfigValue('accounts');
    }   

	/**
     * Get value by given key in sms config file
     *
     * @return string 
     */
	protected function getConfigValue($key) 
	{	
		$class = $this->getProviderName();
        $value = config('sms.' . strtolower($class) . '.accounts.' . $key);

        if (is_null($value)) {
            throw new InvalidArgumentException(sprintf(
                'Unable to get [%s] from sms config file.', $key
            ));
        }

		return $value;
	}

    /**
     * Returns the name of the provider
     * 
     * @return string
     */
    protected function getProviderName()
    {
        $classPath = explode("\\", static::class);
        end($classPath);
        return prev($classPath);
    }

	/**
     * Check wether all query parameters fulfill api needs
     * 
     * @throws Exception
     */
	protected function checkRequireParameters()
	{
		$diff = collect($this->getRequireParameters())->diff(array_keys($this->parameters));		
		// dd($this->getRequireParameters(), array_keys($this->parameters), $diff);

		if ($diff->count() != 0) {
			throw new Exception('Missing Require Parameters '. $diff->values());
		}
	}

    /**
     * While http method is get, concatenate between query parameter and given url
     * 
     * @return string
     */
    protected function concatenateQueryString()
    {   
        $queryString = ''; 

        if (!$this->endsWith($this->getRequestURL(), '?')) {
            $queryString = '?';
        }

        foreach ($this->parameters as $key => $value) {
            $queryString = $queryString . $key . '=' . $value . '&';
        }

        $this->url = $this->getRequestURL() . $queryString;

        // dd($this->parameters, $this->url);
    }

    /**
     * Check end of given string match the specified character/string
     * 
     * @return boolean
     */
    private function endsWith($haystack, $needle)
    {
        $length = strlen($needle);
        if ($length == 0) {
            return true;
        }

        return (substr($haystack, -$length) === $needle);
    }
}

