<?php

namespace Maxin\Sms\Providers\Yunpian;

use Maxin\Sms\Providers\AbstractAPI;
use Maxin\Sms\Contracts\MessageAPIInterface;

use Maxin\Sms\Message;
use Maxin\Sms\Error;

class MessageAPI extends AbstractAPI implements MessageAPIInterface
{
    /**
     * Success code for each provider
     * cf. https://www.yunpian.com/doc/zh_CN/returnValue/common.html
     */
    const SUCCESS_CODE = "0";

    /**
     * {@inheritdoc}
     */
    public function getRequireParameters()
    {
        return ['apikey', 'mobile', 'text'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestURL()
    {
        return "https://sms.yunpian.com/v2/sms/single_send.json";
    }

    /**
     * Set and map each parameter into provider special query keys
     *
     * @param  array  $parameters
     * @return self
     */
    public function setParameters(int $number, string $text)
    {        
        $this->parameters = [
            'apikey' => $this->getConfigValue('key'),
            'mobile' => $number,
            'text'   => $text,
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
        /** Example: Success
            {
                "code"   => 0
                "msg"    => "发送成功"
                "count"  => 1
                "fee"    => 0.05
                "unit"   => "RMB"
                "mobile" => "13049080495"
                "sid"    => 28787281658
            }
        */

        /** Example: Error
         *  {
         *      "http_status_code" => 400,                      
         *      "code"             => 3,                         // 错误码
         *      "msg"              => "账户余额不足",            
         *      "detail"           => "账户需要充值，请充值后重试"   // 具体错误描述或解决方法
         *  }
         */

        // dd($rawData);

        /// Error
        if (array_key_exists('detail', $rawData) && $rawData['code'] !== self::SUCCESS_CODE) {
            return (new Error($this->getProviderName()))->map([
              'message' => $rawData['msg'],
              'code'    => (string)$rawData['code'],
              'detail'  => $rawData['detail'],
            ]);   
        }

        /// Success
        return $message->map([
            'message' => $rawData['msg'],
            'code'    => (string)$rawData['code'],
            'number'  => $rawData['mobile'],
            'fee'     => $rawData['fee'],
            'count'   => $rawData['count'],
        ]);
    }


}
