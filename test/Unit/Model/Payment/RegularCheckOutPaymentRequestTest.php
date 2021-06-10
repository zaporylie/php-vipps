<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\CallbackErrorInfo;
use zaporylie\Vipps\Model\Payment\RegularCheckOutPaymentRequest;
use zaporylie\Vipps\Model\Payment\TransactionInfo;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

/**
 * Class RegularCheckOutPaymentRequestTest
 * @package zaporylie\Vipps\Tests\Unit\Model\Payment
 * @coversDefaultClass \zaporylie\Vipps\Model\Payment\RegularCheckOutPaymentRequest
 */
class RegularCheckOutPaymentRequestTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\RegularCheckOutPaymentRequest
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp() : void
    {
        parent::setUp();
        $this->model = new RegularCheckOutPaymentRequest();
        $reflection = new \ReflectionClass($this->model);
        $reflectionProperty = $reflection->getProperty('orderId');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'test_order_id');
        $reflectionProperty = $reflection->getProperty('merchantSerialNumber');
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($this->model, 'test_merchant_serial_number');
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
}
