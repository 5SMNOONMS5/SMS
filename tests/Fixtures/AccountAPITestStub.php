<?php

namespace Maxin\Sms\Tests\Fixtures;

use Maxin\Sms\Account;
use Maxin\Sms\Providers\AbstractAPI;
use Maxin\Sms\Contracts\AccountAPIInterface;
 
class AccountAPITestStub extends AbstractAPI
{
    /**
     * {@inheritdoc}
     */
    public function getRequireParameters()
    {
        return ['para1', 'para2', 'para3'];
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestURL()
    {
        return 'https://request.url';
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
            'para1' => 'para1_foo',
            'para2' => 'para2_foo',
            'para3' => 'para3_foo',
        ];

        return $this;
    }

    /**
     * Request
     *
     * @return self
     */
     public function request()
     {
        
     }
}