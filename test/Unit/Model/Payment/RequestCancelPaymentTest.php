<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\CustomerInfo;
use zaporylie\Vipps\Model\Payment\MerchantInfo;
use zaporylie\Vipps\Model\Payment\RequestCancelPayment;
use zaporylie\Vipps\Model\Payment\Transaction;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class RequestCancelPaymentTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\RequestCancelPayment
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
     * @covers \zaporylie\Vipps\Model\Payment\RequestCancelPayment::setMerchantInfo()
     * @covers \zaporylie\Vipps\Model\Payment\RequestCancelPayment::getMerchantInfo()
     */
    public function testMerchantInfo()
    {
        $this->assertNull($this->model->getMerchantInfo());
        $this->assertInstanceOf(RequestCancelPayment::class, $this->model->setMerchantInfo(new MerchantInfo()));
        $this->assertInstanceOf(MerchantInfo::class, $this->model->getMerchantInfo());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\RequestCancelPayment::setTransaction()
     * @covers \zaporylie\Vipps\Model\Payment\RequestCancelPayment::getTransaction()
     */
    public function testTransaction()
    {
        $this->assertNull($this->model->getTransaction());
        $this->assertInstanceOf(RequestCancelPayment::class, $this->model->setTransaction(new Transaction()));
        $this->assertInstanceOf(Transaction::class, $this->model->getTransaction());
    }
}
