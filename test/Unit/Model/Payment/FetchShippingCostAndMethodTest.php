<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\FetchShippingCostAndMethod;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

/**
 * Class FetchShippingCostAndMethodTest
 * @package zaporylie\Vipps\Tests\Unit\Model\Payment
 * @coversDefaultClass \zaporylie\Vipps\Model\Payment\FetchShippingCostAndMethod
 */
class FetchShippingCostAndMethodTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\FetchShippingCostAndMethod
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->model = new FetchShippingCostAndMethod();
    }

    public function testAddressId()
    {
        $this->assertNull($this->model->getAddressId());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setAddressId('test_id'));
        $this->assertEquals('test_id', $this->model->getAddressId());
    }

    public function testAddressLine1()
    {
        $this->assertNull($this->model->getAddressLine1());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setAddressLine1('test_first_line'));
        $this->assertEquals('test_first_line', $this->model->getAddressLine1());
    }

    public function testAddressLine2()
    {
        $this->assertNull($this->model->getAddressLine2());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setAddressLine2('test_second_line'));
        $this->assertEquals('test_second_line', $this->model->getAddressLine2());
    }

    public function testCountry()
    {
        $this->assertNull($this->model->getCountry());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setCountry('Norway'));
        $this->assertEquals('Norway', $this->model->getCountry());
    }

    public function testCity()
    {
        $this->assertNull($this->model->getCity());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setCity('Trondheim'));
        $this->assertEquals('Trondheim', $this->model->getCity());
    }

    public function testPostCode()
    {
        $this->assertNull($this->model->getPostCode());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setPostCode(7000));
        $this->assertEquals(7000, $this->model->getPostCode());
    }

    public function testPostalCode()
    {
        $this->assertNull($this->model->getPostalCode());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setPostalCode(7000));
        $this->assertEquals(7000, $this->model->getPostalCode());
    }

    public function testAddressType()
    {
        $this->assertNull($this->model->getAddressType());
        $this->assertInstanceOf(FetchShippingCostAndMethod::class, $this->model->setAddressType('test_type'));
        $this->assertEquals('test_type', $this->model->getAddressType());
    }
}
