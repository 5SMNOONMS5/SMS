<?php

namespace Maxin\Sms\Tests;

use Maxin\Sms\Tests\AbstractTestCase;
use Maxin\Sms\Tests\Fixtures\AccountAPITestStub;
use \Mockery;

final class AccountAPITest extends AbstractTestCase
{	 
    /*
     * Fake config values
     */
    public function fakeConfig()
    {
        return [
            'name'     => 'providerName',
            'class'    => Maxin\Sms\Tests\Fixtures\AccountAPITestStub::class,
            'accounts' => [
                [
                    'name'   => 'account1',
                    'key'    => 'account1_key',
                    'secret' => 'account1_secret_key'
                ], [
                    'name'   => 'account2',
                    'key'    => 'account2_key',
                    'secret' => 'account2_secret_key'
                ]
            ]
        ];
    }

    /**
     * Create a instance
     * @test
     */
    public function getInstance()
    {
        return new AccountAPITestStub($this->fakeConfig());
    }

    /**
     * Create a instance
     * @depends getInstance
     * @test
     */
    public function ReturnFirstAccountKey($getInstance)
    {   
        /** arrange */
        $object =  new AccountAPITestStub($this->fakeConfig());        

        /** act */
        $expected = 'account1_key';
        $result = $this->invokeMethod($object, 'getConfigValue', array('key'));

        /** assert */
        $this->assertEquals($expected, $result);
    }

    /**
     * Create a instance
     * @depends getInstance
     * @test
     */
    public function ReturnSecondAccountKey($getInstance)
    {   
        /** arrange */
        $object =  new AccountAPITestStub($this->fakeConfig());        

        /** act */
        $object->setAccount('account2');

        $expected = 'account2_key';
        $result = $this->invokeMethod($object, 'getConfigValue', array('key'));

        /** assert */
        $this->assertEquals($expected, $result);
    }







}