<?php

namespace Maxin\Sms\Tests;

use PHPUnit\Framework\TestCase;
use Maxin\Sms\Providers\AbstractAPI;

abstract class AbstractTestCase extends TestCase
{
    /**
     * create a instance
     */
	abstract public function testCreateInstance();
}