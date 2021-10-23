<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\Address;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

/**
 * Class AddressTest
 * @package zaporylie\Vipps\Tests\Unit\Model\Payment
 * @coversDefaultClass \zaporylie\Vipps\Model\Payment\Address
 */
class AddressTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\Address
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->model = new Address();
        $reflection = new \ReflectionClass($this->model);
        $reflectionProperty = $reflection->getProperty('addressLine1');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'test_first_line');
        $reflectionProperty = $reflection->getProperty('addressLine2');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'test_second_line');
        $reflectionProperty = $reflection->getProperty('city');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'Trondheim');
        $reflectionProperty = $reflection->getProperty('country');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'Norway');
        $reflectionProperty = $reflection->getProperty('postCode');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 7000);
    }

    public function testGetAddressLine1()
    {
        $this->assertEquals('test_first_line', $this->model->getAddressLine1());
    }

    public function testGetAddressLine2()
    {
        $this->assertEquals('test_second_line', $this->model->getAddressLine2());
    }

    public function testCountry()
    {
        $this->assertEquals('Norway', $this->model->getCountry());
    }

    public function testCity()
    {
        $this->assertEquals('Trondheim', $this->model->getCity());
    }

    public function testPostCode()
    {
        $this->assertEquals(7000, $this->model->getPostCode());
    }
}
