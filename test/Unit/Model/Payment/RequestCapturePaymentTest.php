<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\CustomerInfo;
use zaporylie\Vipps\Model\Payment\MerchantInfo;
use zaporylie\Vipps\Model\Payment\RequestCapturePayment;
use zaporylie\Vipps\Model\Payment\Transaction;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class RequestCapturePaymentTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\RequestCapturePayment
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
     * @covers \zaporylie\Vipps\Model\Payment\RequestCapturePayment::setMerchantInfo()
     * @covers \zaporylie\Vipps\Model\Payment\RequestCapturePayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestCapturePayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\RequestCapturePayment::setTransaction()
     * @covers \zaporylie\Vipps\Model\Payment\RequestCapturePayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestCapturePayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
