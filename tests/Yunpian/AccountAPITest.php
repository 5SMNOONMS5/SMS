<?php

namespace Maxin\Sms\Tests;


use Maxin\Sms\Providers\Yunpian\AccountAPI;
use Maxin\Sms\Tests\AbstractTestCase;

final class AccountAPITest extends AbstractTestCase
{	
    /**
     * {@inheritdoc}
     */
	public function testCreateInstance()
	{
		return new AccountAPI();
	}

    /**
 	 * @depends testCreateInstance
     */
    public function testConsumer($instance)
    {
        $this->assertSame(['apikey'], $instance->getRequireParameters());
    }
}