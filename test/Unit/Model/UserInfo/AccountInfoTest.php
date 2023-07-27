<?php

namespace zaporylie\Vipps\Tests\Unit\Model\UserInfo;

use JMS\Serializer\SerializerBuilder;
use zaporylie\Vipps\Model\UserInfo\AccountInfo;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class AccountInfoTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\UserInfo\AccountInfo
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $data = [
            "account_name" => "Savings account",
            "account_number" => 86011117947,
            "bank_name" => "ACME Bank"
        ];
        $serializer = SerializerBuilder::create()->build();
        $this->model = $serializer->deserialize(json_encode($data), AccountInfo::class, 'json');
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\AccountInfo::getAccountName()
     */
    public function testGetAccountName()
    {
        $this->assertEquals('Savings account', $this->model->getAccountName());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\AccountInfo::getAccountNumber()
     */
    public function testGetAccountNumber()
    {
        $this->assertEquals(86011117947, $this->model->getAccountNumber());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\AccountInfo::getBankName()
     */
    public function testGetBankName()
    {
        $this->assertEquals('ACME Bank', $this->model->getBankName());
    }
}
