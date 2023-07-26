<?php

namespace zaporylie\Vipps\Tests\Unit\Model\UserInfo;

use zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus;
use zaporylie\Vipps\Model\Payment\TransactionInfo;
use zaporylie\Vipps\Model\UserInfo\Address;
use zaporylie\Vipps\Model\UserInfo\ResponseUserInfo;
use zaporylie\Vipps\Resource\Payment\GetOrderStatus;
use zaporylie\Vipps\Resource\UserInfo\UserInfo;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class ResponseUserInfoTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $resource = new UserInfo($this->vipps, 'test');
        $this->model = $resource->getSerializer()->deserialize(
            json_encode((object) [
                "accounts" => [[
                    "account_name" => "Savings account",
                    "account_number" => 86011117947,
                    "bank_name" => "ACME Bank"
                ]],
                "address" => [
                    "address_type" => "home",
                    "country" => "NO",
                    "default" => true,
                    "formatted" => "Robert Levins gate 5\n0154 Oslo",
                    "postal_code" => "0154",
                    "region" => "Oslo",
                    "street_address" => "Robert Levins gate 5"
                ],
                "other_addresses" => [[
                    "address_type" => "home",
                    "country" => "NO",
                    "default" => true,
                    "formatted" => "Robert Levins gate 5\n0154 Oslo",
                    "postal_code" => "0154",
                    "region" => "Oslo",
                    "street_address" => "Robert Levins gate 5"
                ]],
                "birthdate" => "2000-12-31",
                "email" => "user@example.com",
                "email_verified" => true,
                "family_name" => "Lovelace",
                "given_name" => "Ada",
                "name" => "Ada Lovelace",
                "nin" => "09057517287",
                "phone_number" => "47912345678",
                "sid" => "7d78a726-af92-499e-b857-de263ef9a969",
                "sub" => "c06c4afe-d9e1-4c5d-939a-177d752a0944"
            ]),
            ResponseUserInfo::class,
            'json'
        );
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getAccounts
     */
    public function testGetAccounts()
    {
        $this->assertIsArray($this->model->getAccounts());
        $this->assertNotEmpty($this->model->getAccounts());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getAddress
     */
    public function testGetAddress()
    {
        $this->assertInstanceOf(Address::class, $this->model->getAddress());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getBirthdate
     */
    public function testGetBirthday()
    {
        $this->assertEquals('2000-12-31', $this->model->getBirthdate());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getEmail
     */
    public function testGetEmail()
    {
        $this->assertEquals('user@example.com', $this->model->getEmail());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getFamilyName
     */
    public function testGetFamilyName()
    {
        $this->assertEquals('Lovelace', $this->model->getFamilyName());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getGivenName
     */
    public function testGetGivenName()
    {
        $this->assertEquals('Ada', $this->model->getGivenName());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getName
     */
    public function testGetName()
    {
        $this->assertEquals('Ada Lovelace', $this->model->getName());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getNin
     */
    public function testGetNin()
    {
        $this->assertEquals('09057517287', $this->model->getNin());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getPhoneNumber
     */
    public function testGetPhoneNumber()
    {
        $this->assertEquals('47912345678', $this->model->getPhoneNumber());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getSid
     */
    public function testGetSid()
    {
        $this->assertEquals('7d78a726-af92-499e-b857-de263ef9a969', $this->model->getSid());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getSub
     */
    public function testGetSub()
    {
        $this->assertEquals('c06c4afe-d9e1-4c5d-939a-177d752a0944', $this->model->getSub());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo::getOtherAddresses
     */
    public function testGetOtherAddresses()
    {
        $this->assertIsArray($this->model->getOtherAddresses());
        $this->assertNotEmpty($this->model->getOtherAddresses());
    }
}
