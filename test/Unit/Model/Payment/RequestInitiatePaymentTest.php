<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\CustomerInfo;
use zaporylie\Vipps\Model\Payment\MerchantInfo;
use zaporylie\Vipps\Model\Payment\RequestInitiatePayment;
use zaporylie\Vipps\Model\Payment\Transaction;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class RequestInitiatePaymentTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\RequestInitiatePayment
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new RequestInitiatePayment();
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\RequestInitiatePayment::setMerchantInfo()
     * @covers \zaporylie\Vipps\Model\Payment\RequestInitiatePayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestInitiatePayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\RequestInitiatePayment::setCustomerInfo()
     * @covers \zaporylie\Vipps\Model\Payment\RequestInitiatePayment::getCustomerInfo()
     */
    public function testCustomerInfo()
    {
        $this->assertNull($this->model->getCustomerInfo());
        $this->assertInstanceOf(RequestInitiatePayment::class, $this->model->setCustomerInfo(new CustomerInfo()));
        $this->assertInstanceOf(CustomerInfo::class, $this->model->getCustomerInfo());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\RequestInitiatePayment::setTransaction()
     * @covers \zaporylie\Vipps\Model\Payment\RequestInitiatePayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestInitiatePayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
