<?php

namespace Maxin\Sms\Tests;

use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    /**
     * create a instance
     */
	abstract public function testCreateInstance();
}