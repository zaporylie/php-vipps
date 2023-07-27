<?php

namespace zaporylie\Vipps\Tests\Unit\Model\UserInfo;

use JMS\Serializer\SerializerBuilder;
use zaporylie\Vipps\Model\UserInfo\AccountInfo;
use zaporylie\Vipps\Model\UserInfo\Address;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class AddressTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\UserInfo\Address
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $data = [
            "address_type" => "home",
            "country" => "NO",
            "default" => true,
            "formatted" => "Robert Levins gate 5\n0154 Oslo",
            "postal_code" => "0154",
            "region" => "Oslo",
            "street_address" => "Robert Levins gate 5"
        ];
        $serializer = SerializerBuilder::create()->build();
        $this->model = $serializer->deserialize(json_encode($data), Address::class, 'json');
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\Address::getAddressType()
     */
    public function testGetAddressType()
    {
        $this->assertEquals('home', $this->model->getAddressType());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\Address::getCountry
     */
    public function testGetCountry()
    {
        $this->assertEquals('NO', $this->model->getCountry());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\Address::getFormatted
     */
    public function testGetFormatted()
    {
        $this->assertEquals("Robert Levins gate 5\n0154 Oslo", $this->model->getFormatted());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\Address::getPostalCode
     */
    public function testGetPostalCode()
    {
        $this->assertEquals('0154', $this->model->getPostalCode());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\Address::getRegion
     */
    public function testGetRegion()
    {
        $this->assertEquals('Oslo', $this->model->getRegion());
    }

    /**
     * @covers \zaporylie\Vipps\Model\UserInfo\Address::getStreetAddress
     */
    public function testGetStreetAddress()
    {
        $this->assertEquals('Robert Levins gate 5', $this->model->getStreetAddress());
    }
}
