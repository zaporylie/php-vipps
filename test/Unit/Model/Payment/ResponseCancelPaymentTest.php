<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\RequestCancelPayment;
use Vipps\Model\Payment\ResponseCancelPayment;
use Vipps\Model\Payment\TransactionInfo;
use Vipps\Model\Payment\TransactionSummary;
use Vipps\Resource\Payment\CancelPayment;
use Vipps\Tests\Unit\Model\ModelTestBase;

class ResponseCancelPaymentTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\ResponseCancelPayment
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $resource = new CancelPayment($this->vipps, 'test', 'test', new RequestCancelPayment());
        $this->model = $resource->getSerializer()->deserialize(
            json_encode((object) [
                'orderId' => 'test_order_id',
                'transactionSummary' => [],
                'transactionInfo' => [],
            ]),
            ResponseCancelPayment::class,
            'json'
        );
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseCancelPayment::getOrderId()
     */
    public function testOrderId()
    {
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseCancelPayment::getTransactionInfo()
     */
    public function testTransactionInfo()
    {
        $this->assertInstanceOf(TransactionInfo::class, $this->model->getTransactionInfo());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseCancelPayment::getTransactionSummary()
     */
    public function testTransactionSummary()
    {
        $this->assertInstanceOf(TransactionSummary::class, $this->model->getTransactionSummary());
    }
}
