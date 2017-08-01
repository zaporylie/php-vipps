<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\CustomerInfo;
use Vipps\Model\Payment\MerchantInfo;
use Vipps\Model\Payment\RequestCancelPayment;
use Vipps\Model\Payment\Transaction;
use Vipps\Tests\Unit\Model\ModelTestBase;

class RequestCancelPaymentTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\RequestCancelPayment
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new RequestCancelPayment();
    }

    /**
     * @covers \Vipps\Model\Payment\RequestCancelPayment::setMerchantInfo()
     * @covers \Vipps\Model\Payment\RequestCancelPayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestCancelPayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \Vipps\Model\Payment\RequestCancelPayment::setTransaction()
     * @covers \Vipps\Model\Payment\RequestCancelPayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestCancelPayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
