<?php 

namespace Maxin\Sms\Contracts;

use Maxin\Sms\Account;

interface AccountAPIInterface 
{
    /**
     * Map the raw response data to a Account instance.
     *
     * @param  object $account
     * @param  array  $rawData
     * @return \Maxin\Sms\Account
     */
    public function mapToAccountObject(Account $account, $rawData);

    /**
     * Map response raw data into account's properties
     *
     * @return account object | error object
     */
    public function getAccountObject();
}