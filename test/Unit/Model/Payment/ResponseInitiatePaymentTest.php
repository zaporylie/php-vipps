<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\RequestInitiatePayment;
use Vipps\Model\Payment\ResponseInitiatePayment;
use Vipps\Model\Payment\TransactionInfo;
use Vipps\Model\Payment\TransactionSummary;
use Vipps\Resource\Payment\InitiatePayment;
use Vipps\Tests\Unit\Model\ModelTestBase;

class ResponseInitiatePaymentTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\ResponseInitiatePayment
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $resource = new InitiatePayment($this->vipps, 'test', new RequestInitiatePayment());
        $this->model = $resource->getSerializer()->deserialize(
            json_encode((object) [
                'orderId' => 'test_order_id',
                'merchantSerialNumber' => 'test_merchant_serial_number',
                'transactionInfo' => [],
            ]),
            ResponseInitiatePayment::class,
            'json'
        );
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseInitiatePayment::getOrderId()
     */
    public function testOrderId()
    {
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseInitiatePayment::getMerchantSerialNumber()
     */
    public function testMerchantSerialNumber()
    {
        $this->assertEquals('test_merchant_serial_number', $this->model->getMerchantSerialNumber());
    }

    /**
     * @covers \Vipps\Model\Payment\ResponseInitiatePayment::getTransactionInfo()
     */
    public function testTransactionInfo()
    {
        $this->assertInstanceOf(TransactionInfo::class, $this->model->getTransactionInfo());
    }
}
