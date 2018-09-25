<?php

namespace Maxin\Sms\Providers;

use Maxin\Sms\Providers\AbstractProvider as AbstractProvider;

class Nexmo extends AbstractProvider
{   
    /**
     * Success code for each provider
     */
    const SUCCESS_CODE = "0";

    /**
     * {@inheritdoc}
     */
    public function setPrerequisite(array $requireParameters = [], string $requestUrl = '')
    {
        $this->requireParameters = ['api_key', 'api_secret', 'from', 'to', 'text'];
        $this->requestUrl        = $this->getConfigValue('url');
        
        // dd($this->requireParameters, $this->requestUrl);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setQueryParameters(string $number = '', string $text = '', array $custom = [])
    {   
        $number = $this->formatChinaCallingCode($number);
        
        $this->queryParameters = array_merge($custom, [
            'from'      => "test",
            'to'        => (int)$number,
            'text'      => $text
        ]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function defaultParameters()
    {
        return [
            'api_key'    => $this->getConfigValue('key'),
            'api_secret' => $this->getConfigValue('secret'),
            'type'       => 'unicode'
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function mapToObject($sms, $rawData)
    {
        /*  Example: Error
            array:2 [▼
                "message-count" => "1"
                "messages" => array:1 [
                    0 => array:4 [
                        "to"                => "86123456789"
                        "status"            => "15"
                        "error-text"        => "Illegal Sender Address - rejected"
                        "network"           => "US-VIRTUAL-LEVEL3"
                    ]
                ]
            ]
        */

        /*  Example: Success
            array:2 [
                "message-count" => "1"
                "messages" => array:1 [
                    0 => array:4 [
                        "to"                => "86123456789"
                        "message-id"        => "0F000000C4674A22"
                        "status"            => "0"
                        "remaining-balance" => "14.54120000"
                        "message-price"     => "0.02820000"
                        "network"           => "46001"
                    ]
                ]
            ]
        */

    

        $message = $rawData['messages'][0];

        /// Common
        $sms->map([
            'count'        => $rawData['message-count'],
            'number'       => $message['to'],
            'code'         => (string)$message['status'],
        ]);

        // dd($rawData, self::SUCCESS_CODE, $sms->code);

        /// Error
        if (array_key_exists('error-text', $message) || $sms->code !== self::SUCCESS_CODE) {
            return $sms->map([
                'errorMessage' => $message['error-text'],
            ]);          
        }

        /// Success
        return $sms->map([
            'fee'          => $message['message-price'],
            'message'      => $message['message-id'],
            'balance'      => $message['remaining-balance']
        ]);
    }

    /**
     * cf. https://en.wikipedia.org/wiki/List_of_country_calling_codes  
     * If user forget to add country calling code, then add it
     *
     * @return string 
     */
    private function formatChinaCallingCode($number) 
    {
       if (substr($number, 0, 2) !== '86') {
            return '86' . $number;
       }
    }

}
