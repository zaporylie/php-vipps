<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\RequestRefundPayment;
use zaporylie\Vipps\Model\Payment\ResponseRefundPayment;
use zaporylie\Vipps\Model\Payment\TransactionInfo;
use zaporylie\Vipps\Model\Payment\TransactionSummary;
use zaporylie\Vipps\Resource\Payment\RefundPayment;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class ResponseRefundPaymentTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\ResponseRefundPayment
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $resource = new RefundPayment($this->vipps, 'test', 'test', new RequestRefundPayment());
        $this->model = $resource->getSerializer()->deserialize(
            json_encode((object) [
                'orderId' => 'test_order_id',
                'transactionSummary' => [],
                'transactionInfo' => [],
            ]),
            ResponseRefundPayment::class,
            'json'
        );
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\ResponseRefundPayment::getOrderId()
     */
    public function testOrderId()
    {
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\ResponseRefundPayment::getTransactionInfo()
     */
    public function testTransactionInfo()
    {
        $this->assertInstanceOf(TransactionInfo::class, $this->model->getTransactionInfo());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\ResponseRefundPayment::getTransactionSummary()
     */
    public function testTransactionSummary()
    {
        $this->assertInstanceOf(TransactionSummary::class, $this->model->getTransactionSummary());
    }
}
