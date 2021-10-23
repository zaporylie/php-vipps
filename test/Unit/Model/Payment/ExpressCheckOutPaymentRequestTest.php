<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\CallbackErrorInfo;
use zaporylie\Vipps\Model\Payment\ExpressCheckOutPaymentRequest;
use zaporylie\Vipps\Model\Payment\ShippingDetailsRequest;
use zaporylie\Vipps\Model\Payment\TransactionInfo;
use zaporylie\Vipps\Model\Payment\UserDetails;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

/**
 * Class ExpressCheckOutPaymentRequestTest
 * @package zaporylie\Vipps\Tests\Unit\Model\Payment
 * @coversDefaultClass \zaporylie\Vipps\Model\Payment\ExpressCheckOutPaymentRequest
 */
class ExpressCheckOutPaymentRequestTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\ExpressCheckOutPaymentRequest
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->model = new ExpressCheckOutPaymentRequest();
        $reflection = new \ReflectionClass($this->model);
        $reflectionProperty = $reflection->getProperty('orderId');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'test_order_id');
        $reflectionProperty = $reflection->getProperty('merchantSerialNumber');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'test_merchant_serial_number');
        $reflectionProperty = $reflection->getProperty('shippingDetails');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, new ShippingDetailsRequest());
        $reflectionProperty = $reflection->getProperty('userDetails');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, new UserDetails());
        $reflectionProperty = $reflection->getProperty('transactionInfo');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, new TransactionInfo());
        $reflectionProperty = $reflection->getProperty('errorInfo');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, new CallbackErrorInfo());
    }

    public function testGetShippingMethodId()
    {
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }

    public function testGetShippingMethod()
    {
        $this->assertEquals('test_merchant_serial_number', $this->model->getMerchantSerialNumber());
    }

    public function testGetShippingCost()
    {
        $this->assertInstanceOf(TransactionInfo::class, $this->model->getTransactionInfo());
    }

    public function testGetErrorInfo()
    {
        $this->assertInstanceOf(CallbackErrorInfo::class, $this->model->getErrorInfo());
    }

    public function testUserDetails()
    {
        $this->assertInstanceOf(UserDetails::class, $this->model->getUserDetails());
    }

    public function testShippingDetails()
    {
        $this->assertInstanceOf(ShippingDetailsRequest::class, $this->model->getShippingDetails());
    }
}
