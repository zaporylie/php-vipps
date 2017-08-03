<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\CustomerInfo;
use zaporylie\Vipps\Model\Payment\MerchantInfo;
use zaporylie\Vipps\Model\Payment\RequestRefundPayment;
use zaporylie\Vipps\Model\Payment\Transaction;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class RequestRefundPaymentTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\RequestRefundPayment
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
     * @covers \zaporylie\Vipps\Model\Payment\RequestRefundPayment::setMerchantInfo()
     * @covers \zaporylie\Vipps\Model\Payment\RequestRefundPayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestRefundPayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\RequestRefundPayment::setTransaction()
     * @covers \zaporylie\Vipps\Model\Payment\RequestRefundPayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestRefundPayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
