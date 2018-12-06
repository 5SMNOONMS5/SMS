<?php 

namespace Maxin\Sms\Providers\Yunpian;

use Maxin\Sms\Account;
use Maxin\Sms\Providers\AbstractAPI;
use Maxin\Sms\Contracts\AccountAPIInterface;

class AccountAPI extends AbstractAPI implements AccountAPIInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRequireParameters()
    {
        return ['apikey'];
    } 

    /**
     * {@inheritdoc}
     */
    public function getRequestURL()
    {
        return 'https://sms.yunpian.com/v2/user/get.json';
    }

    /**
     * Set and map each parameter into provider special query keys
     *
     * @param  string  $apikey
     * @return self
     */
    public function setParameters(string $apikey = null)
    {   
        $this->parameters = [
            'apikey' => ($apikey) ?: $this->getAccountDetail('key'),
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
    public function getAccountObject()
    {
        return $this->mapToAccountObject(new Account($this->getProviderName()), $this->response);
    }

    /**
     * {@inheritdoc}
     */
    public function mapToAccountObject(Account $account, $rawData)
    {
        /**  Example: Success
         *      {
         *          "nick"              => "sssssss"
         *          "gmt_created"       => "2018-10-01"
         *          "mobile"            => "18676858627"
         *          "email"             => "xxxxxxxx@gmail.com"
         *          "ip_whitelist"      => "180.232.66.154,113.116.53.52,"
         *          "api_version"       => "v2"
         *          "alarm_balance"     => 10
         *          "emergency_contact" => ""
         *          "emergency_mobile"  => ""
         *          "balance"           => 1111.2222
         *      }
        */

        // dd($rawData);

        return $account->map([
            'nickName' => $rawData['nick'],
            'email'    => $rawData['email'],
            'mobile'   => $rawData['mobile'],
            'balance'  => $rawData['balance']
        ]);
    }

}