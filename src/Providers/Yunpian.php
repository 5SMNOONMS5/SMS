<?php

namespace Maxin\Sms\Providers;

use Maxin\Sms\Providers\AbstractProvider as AbstractProvider;

class Yunpian extends AbstractProvider
{
    /**
     * Success code for each provider
     * cf. https://www.yunpian.com/doc/zh_CN/returnValue/common.html
     */
    const SUCCESS_CODE = "0";

    /**
     * {@inheritdoc}
     */
    public function setPrerequisite(array $requireParameters = [], string $requestUrl = '')
    {
        $this->requireParameters = $requireParameters;

        $this->requestUrl        = $this->getConfigValue('url') . $requestUrl;
        
        // dd($this->requireParameters, $this->requestUrl);
        
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setQueryParameters(string $number = '', string $text = '', array $custom = [])
    {   
        $this->queryParameters = array_merge($custom, [
            'mobile' => $number
        ]);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    protected function defaultParameters()
    {
        return [
            'apikey' => $this->getConfigValue('key')
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function mapToObject($sms, $rawData)
    {
		/* Example: Success
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

        /* Example: Error
            {
                "http_status_code" => 400,                      
                "code"             => 3,                         // 错误码
                "msg"              => "账户余额不足",            
                "detail"           => "账户需要充值，请充值后重试"   // 具体错误描述或解决方法
            }
        */

        /// Common
        $sms->map([
            'message'      => $rawData['msg'],
            'code'         => (string)$rawData['code'],
        ]);

        // dd($rawData, self::SUCCESS_CODE, $sms->code);

        /// Error
        if (array_key_exists('detail', $rawData) || $sms->code !== self::SUCCESS_CODE) {
            return $sms->map([
                'errorMessage' => $rawData['detail'],
            ]);   
        }

        /// Success
        return $sms->map([
            'number'  => $rawData['mobile'],
            'fee'     => $rawData['fee'],
            'count'   => $rawData['count'],
        ]);
    }



}