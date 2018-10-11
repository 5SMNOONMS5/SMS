<?php 

namespace Maxin\Sms\Providers\Nexmo;

use Maxin\Sms\Providers\AbstractAPI;
use Maxin\Sms\Contracts\AccountAPIInterface;

use Maxin\Sms\Account;

class BalanceAPI extends AbstractAPI implements AccountAPIInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRequireParameters()
    {
        return ['api_key', 'api_secret'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestURL()
    {
        return 'https://rest.nexmo.com/account/get-balance';
    }

    /**
     * Set and map each parameter into provider special query keys
     *
     * @param  array  $parameters
     * @return self
     */
    public function setParameters()
    {   
        $this->parameters = [
            'api_key'    => $this->getConfigValue('key'),
            'api_secret' => $this->getConfigValue('secret')
        ];

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function request()
    {
        $this->checkRequireParameters();

        $this->concatenateQueryString();

        $this->get();

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
        /** Example: Success
         *  {
         *      "code"   => 0
         *      "msg"    => "发送成功"
         *      "count"  => 1
         *      "fee"    => 0.05
         *      "unit"   => "RMB"
         *      "mobile" => "13049080495"
         *      "sid"    => 28787281658
         *  }
         */

        // dd($rawData);

        return $account->map([
            'balance'    => $rawData['value'],
            'autoReload' => $rawData['autoReload']
        ]);
    }

}