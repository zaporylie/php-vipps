<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\Transaction;
use Vipps\Tests\Unit\Model\ModelTestBase;

class TransactionTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\Transaction
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new Transaction();
    }

    /**
     * @covers \Vipps\Model\Payment\Transaction::setOrderId()
     * @covers \Vipps\Model\Payment\Transaction::getOrderId()
     */
    public function testOrderId()
    {
        $this->assertInstanceOf(Transaction::class, $this->model->setOrderId('test_order_id'));
        $this->assertEquals('test_order_id', $this->model->getOrderId());
    }


    /**
     * @covers \Vipps\Model\Payment\Transaction::getTransactionText()
     * @covers \Vipps\Model\Payment\Transaction::setTransactionText()
     */
    public function testTransactionText()
    {
        $this->assertInstanceOf(Transaction::class, $this->model->setTransactionText('test_transaction_text'));
        $this->assertEquals('test_transaction_text', $this->model->getTransactionText());
    }

    /**
     * @covers \Vipps\Model\Payment\Transaction::getTimeStamp()
     * @covers \Vipps\Model\Payment\Transaction::setTimeStamp()
     */
    public function testTimeStamp()
    {
        $this->assertNull($this->model->getTimeStamp());
        $this->assertInstanceOf(Transaction::class, $this->model->setTimeStamp(new \DateTime()));
        $this->assertInstanceOf(\DateTimeInterface::class, $this->model->getTimeStamp());
    }

    /**
     * @covers \Vipps\Model\Payment\Transaction::getAmount()
     * @covers \Vipps\Model\Payment\Transaction::setAmount()
     */
    public function testAmount()
    {
        $this->assertInstanceOf(Transaction::class, $this->model->setAmount(1200));
        $this->assertEquals(1200, $this->model->getAmount());
    }

    /**
     * @covers \Vipps\Model\Payment\Transaction::getRefOrderId()
     * @covers \Vipps\Model\Payment\Transaction::setRefOrderId()
     */
    public function testRefOrderId()
    {
        $this->assertInstanceOf(Transaction::class, $this->model->setRefOrderId('test_ref_order_id'));
        $this->assertEquals('test_ref_order_id', $this->model->getRefOrderId());
    }
}
