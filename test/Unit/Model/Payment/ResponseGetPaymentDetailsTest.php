<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\ResponseGetPaymentDetails;
use Vipps\Model\Payment\TransactionSummary;
use Vipps\Resource\Payment\GetPaymentDetails;
use Vipps\Tests\Unit\Model\ModelTestBase;

class ResponseGetPaymentDetailsTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\ResponseGetPaymentDetails
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $resource = new GetPaymentDetails($this->vipps, 'test', 'test_merchant_serial_number', 'test_order_id');
        $this->model = $resource->getSerializer()->deserialize(
            json_encode((object) [
                'orderId' => 'test_order_id',
                'transactionSummary' => [],
                'transactionLogHistory' => [],
            ]),
            ResponseGetPaymentDetails::class,
            'json'
        );
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseGetPaymentDetails::getOrderId()
     */
    public function testOrderId()
    {
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseGetPaymentDetails::getTransactionSummary()
     */
    public function testTransactionSummary()
    {
        $this->assertInstanceOf(TransactionSummary::class, $this->model->getTransactionSummary());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseGetPaymentDetails::getTransactionLogHistory()
     */
    public function testTransactionLogHistory()
    {
        $this->assertNotNull($this->model->getTransactionLogHistory());
    }
}
