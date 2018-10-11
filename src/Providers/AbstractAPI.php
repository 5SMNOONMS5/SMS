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
     * The custom parameters to be sent with the request.
     *
     * @var array
     */
    public $parameters = [];

    /**
     * Response Data from each provider
     */
    public $response   = [];

    /**
     * Response Data from each provider
     */
    public $url        = [];

    /**
     * Get require request parameters
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
            RequestOptions::BODY => http_build_query($this->parameters)
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
     * Get value by given key in sms config file
     *
     * @return string 
     */
	protected function getConfigValue($key) 
	{	
		$class = $this->getProviderName();
        $value = config('sms.' . strtolower($class) . '.' . $key);

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
     * Check wether all query parameters fulfill provider needs
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
     * While http method is get, concatenate together with query parameter and given url
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

