<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\RequestRefundPayment;
use Vipps\Model\Payment\ResponseRefundPayment;
use Vipps\Model\Payment\TransactionInfo;
use Vipps\Model\Payment\TransactionSummary;
use Vipps\Resource\Payment\RefundPayment;
use Vipps\Tests\Unit\Model\ModelTestBase;

class ResponseRefundPaymentTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\ResponseRefundPayment
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
     * @covers \Vipps\Model\Payment\ResponseRefundPayment::getOrderId()
     */
    public function testOrderId()
    {
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseRefundPayment::getTransactionInfo()
     */
    public function testTransactionInfo()
    {
        $this->assertInstanceOf(TransactionInfo::class, $this->model->getTransactionInfo());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseRefundPayment::getTransactionSummary()
     */
    public function testTransactionSummary()
    {
        $this->assertInstanceOf(TransactionSummary::class, $this->model->getTransactionSummary());
    }
}
