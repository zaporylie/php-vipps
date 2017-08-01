<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\CustomerInfo;
use Vipps\Model\Payment\MerchantInfo;
use Vipps\Model\Payment\RequestCapturePayment;
use Vipps\Model\Payment\Transaction;
use Vipps\Tests\Unit\Model\ModelTestBase;

class RequestCapturePaymentTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\RequestCapturePayment
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new RequestCapturePayment();
    }

    /**
     * @covers \Vipps\Model\Payment\RequestCapturePayment::setMerchantInfo()
     * @covers \Vipps\Model\Payment\RequestCapturePayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestCapturePayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \Vipps\Model\Payment\RequestCapturePayment::setTransaction()
     * @covers \Vipps\Model\Payment\RequestCapturePayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestCapturePayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
