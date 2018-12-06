<?php

namespace Maxin\Sms\Providers\Nexmo;

use Maxin\Sms\Providers\AbstractAPI;
use Maxin\Sms\Contracts\MessageAPIInterface;

use Maxin\Sms\Message;
use Maxin\Sms\Error;

class MessageAPI extends AbstractAPI implements MessageAPIInterface
{
    private $sendMessage;

    /**
     * Success code for each provider
     */
    const SUCCESS_CODE = "0";

    /**
     * {@inheritdoc}
     */
    public function getRequireParameters()
    {
        return ['api_key', 'api_secret', 'from', 'to'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestURL()
    {
        return "https://rest.nexmo.com/sms/json";
    }

    /**
     * Set and map each parameter into provider special query keys
     *
     * @param  mix      $number
     * @param  string   $text
     * @param  string   $from
     * @param  string   $apikey
     * @param  string   $apiSecret
     * 
     * @return self
     */
    public function setParameters($number, $text, 
        string $from      = '',
        string $apikey    = null,
        string $apiSecret = null)
    {
        $number = $this->formatChinaCallingCode($number);

        $this->sendMessage = $text;
             
        $this->parameters = [
            'api_key'    => ($apikey)    ?: $this->getAccountDetail('key'),
            'api_secret' => ($apiSecret) ?: $this->getAccountDetail('secret'),
            'from'       => $from,
            'to'         => $number,
            'text'       => $text,
            'type'       => 'unicode'
        ];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function request()
    {
        $this->checkRequireParameters();

        $this->post();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessageObject()
    {
        return $this->mapToMessageObject(new Message($this->getProviderName()), $this->response);
    }

    /**
     * {@inheritdoc}
     */
    public function mapToMessageObject(Message $message, $rawData)
    {
        /**  Example: Error
         *   array:2 [▼
         *      "message-count" => "1"
         *      "messages" => array:1 [
         *          0 => array:4 [
         *              "to"                => "86123456789"
         *              "status"            => "15"
         *              "error-text"        => "Illegal Sender Address - rejected"
         *              "network"           => "US-VIRTUAL-LEVEL3"
         *          ]
         *      ]
         *  ]
        */

        /**  Example: Success
         *   array:2 [
         *      "message-count" => "1"
         *      "messages" => array:1 [
         *          0 => array:4 [
         *              "to"                => "86123456789"
         *              "message-id"        => "0F000000C4674A22"
         *              "status"            => "0"
         *              "remaining-balance" => "14.54120000"
         *              "message-price"     => "0.02820000"
         *              "network"           => "46001"
         *          ]
         *      ]
         *  ]
         */

        $response = $rawData['messages'][0];

        // dd($response);

        /// Error
        if (array_key_exists('error-text', $response) && $response['status'] !== self::SUCCESS_CODE) {
            return (new Error($this->getProviderName()))->map([
                'code'    => (string)$message['status'],
                'message' => $message['error-text'],
            ]);
        }

        /// Success
        return $message->map([
            'count'        => $rawData['message-count'],
            'number'       => $response['to'],
            'sendMessage'  => $this->sendMessage,
            'currency'     => "USD",
            'code'         => (string)$response['status'],
            'fee'          => $response['message-price'],
            'message'      => $response['message-id'],
            'balance'      => $response['remaining-balance']
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
