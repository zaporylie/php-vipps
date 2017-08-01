<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\ResponseGetOrderStatus;
use Vipps\Model\Payment\TransactionInfo;
use Vipps\Resource\Payment\GetOrderStatus;
use Vipps\Tests\Unit\Model\ModelTestBase;

class ResponseGetOrderStatusTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\ResponseGetOrderStatus
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $resource = new GetOrderStatus($this->vipps, 'test', 'test_merchant_serial_number', 'test_order_id');
        $this->model = $resource->getSerializer()->deserialize(
            json_encode((object) [
                'orderId' => 'test_order_id',
                'transactionInfo' => [],
            ]),
            ResponseGetOrderStatus::class,
            'json'
        );
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseGetOrderStatus::getOrderId()
     */
    public function testOrderId()
    {
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseGetOrderStatus::getTransactionInfo()
     */
    public function testTransactionInfo()
    {
        $this->assertInstanceOf(TransactionInfo::class, $this->model->getTransactionInfo());
    }
}
