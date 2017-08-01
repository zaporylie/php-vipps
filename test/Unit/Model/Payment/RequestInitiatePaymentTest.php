<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\CustomerInfo;
use Vipps\Model\Payment\MerchantInfo;
use Vipps\Model\Payment\RequestInitiatePayment;
use Vipps\Model\Payment\Transaction;
use Vipps\Tests\Unit\Model\ModelTestBase;

class RequestInitiatePaymentTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\RequestInitiatePayment
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
     * @covers \Vipps\Model\Payment\RequestInitiatePayment::setMerchantInfo()
     * @covers \Vipps\Model\Payment\RequestInitiatePayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestInitiatePayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \Vipps\Model\Payment\RequestInitiatePayment::setCustomerInfo()
     * @covers \Vipps\Model\Payment\RequestInitiatePayment::getCustomerInfo()
     */
    public function testCustomerInfo()
    {
        $this->assertNull($this->model->getCustomerInfo());
        $this->assertInstanceOf(RequestInitiatePayment::class, $this->model->setCustomerInfo(new CustomerInfo()));
        $this->assertInstanceOf(CustomerInfo::class, $this->model->getCustomerInfo());
    }

    /**
     * @covers \Vipps\Model\Payment\RequestInitiatePayment::setTransaction()
     * @covers \Vipps\Model\Payment\RequestInitiatePayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestInitiatePayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
