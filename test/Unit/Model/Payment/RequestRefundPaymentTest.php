<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\CustomerInfo;
use Vipps\Model\Payment\MerchantInfo;
use Vipps\Model\Payment\RequestRefundPayment;
use Vipps\Model\Payment\Transaction;
use Vipps\Tests\Unit\Model\ModelTestBase;

class RequestRefundPaymentTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\RequestRefundPayment
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new RequestRefundPayment();
    }

    /**
     * @covers \Vipps\Model\Payment\RequestRefundPayment::setMerchantInfo()
     * @covers \Vipps\Model\Payment\RequestRefundPayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestRefundPayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \Vipps\Model\Payment\RequestRefundPayment::setTransaction()
     * @covers \Vipps\Model\Payment\RequestRefundPayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestRefundPayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
