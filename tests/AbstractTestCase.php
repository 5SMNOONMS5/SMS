<?php

namespace Maxin\Sms\Tests;

use \Mockery;
use PHPUnit\Framework\TestCase;
use Maxin\Sms\Providers\AbstractAPI;

abstract class AbstractTestCase extends TestCase
{
 	/*
     * Fake config values
     */
 	abstract public function mockConfig();

    protected function setUp()
    {
        parent::setUp();
    }

 	protected function tearDown()
    {
        parent::tearDown();
        $this->target = null;
    }

	public function initMock($object)
	{		       
        return Mockery::mock($object)->shouldAllowMockingProtectedMethods();
	}
}