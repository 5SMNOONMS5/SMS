<?php

namespace Maxin\Sms\Tests;

use \Mockery;
use Maxin\Sms\Tests\AbstractTestCase;
use Maxin\Sms\Tests\Fixtures\AccountAPITestStub;

final class AccountAPITest extends AbstractTestCase
{	 
    /** @var AccountAPITestStub */
    protected $target;

    /*
     * @dataprovider
     */
    protected function setUp()
    {
        parent::setUp();
        $this->target = $this->initMock(new AccountAPITestStub($this->mockConfig()));
    }

    /*
     * Fake config values
     */
    public function mockConfig()
    {
        return [
            'providerName' => 'providerName',
            'class'        => Maxin\Sms\Tests\Fixtures\AccountAPITestStub::class,
            'accounts'     => [
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
     * @covers
     */
    public function 沒有設置帳號默認回傳第一個帳號的鑰匙()
    {   
        /** arrange */
        $expected = 'account1_key';

        /** act */
        $result   = $this->target->getAccountDetail('key');
    
        /** assert */
        $this->assertEquals($expected, $result);
    }

    /**
     * Create a instance
     * @test
     */
    public function 測試回傳廠商的名字()
    {   
        /** arrange */ 
        $expected = 'providerName';

        /** act */
        $result   = $this->target->getProviderName();
        
        /** assert */
        $this->assertEquals($expected, $result);
    }

    /**
     * Create a instance
     * @test
     */
    public function 設置指定帳號之後則回傳第指定帳號的鑰匙()
    {   
        /** arrange */ 
        $this->target->setAccount('account2');
        $expected = 'account2_key';

        /** act */
        $result   = $this->target->getAccountDetail('key');
        
        /** assert */
        $this->assertEquals($expected, $result);
    }

    /**
     * @test
     */
    public function 是不是請求的默認值都沒有漏掉()
    {   
        /** arrange */

        /** act */
        $result = $this->target->checkRequireParameters();

        // /** assert */
        $this->assertTrue($result);
    }




}