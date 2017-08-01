<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\TransactionLog;
use Vipps\Tests\Unit\Model\ModelTestBase;

class TransactionLogTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\TransactionLog
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new TransactionLog();
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionLog::getAmount()
     * @covers \Vipps\Model\Payment\TransactionLog::setAmount()
     */
    public function testAmount()
    {
        $this->assertNull($this->model->getAmount());
        $this->assertInstanceOf(TransactionLog::class, $this->model->setAmount(2300));
        $this->assertEquals(2300, $this->model->getAmount());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionLog::getTimeStamp()
     * @covers \Vipps\Model\Payment\TransactionLog::setTimeStamp()
     */
    public function testTimeStamp()
    {
        $this->assertNull($this->model->getTimeStamp());
        $this->assertInstanceOf(TransactionLog::class, $this->model->setTimeStamp(new \DateTime()));
        $this->assertInstanceOf(\DateTimeInterface::class, $this->model->getTimeStamp());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionLog::getTransactionId()
     * @covers \Vipps\Model\Payment\TransactionLog::setTransactionId()
     */
    public function testTransactionId()
    {
        $this->assertNull($this->model->getTransactionId());
        $this->assertInstanceOf(TransactionLog::class, $this->model->setTransactionId('test_transaction_id'));
        $this->assertEquals('test_transaction_id', $this->model->getTransactionId());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionLog::getOperation()
     * @covers \Vipps\Model\Payment\TransactionLog::setOperation()
     */
    public function testOperation()
    {
        $this->assertNull($this->model->getOperation());
        $this->assertInstanceOf(TransactionLog::class, $this->model->setOperation('test_operation'));
        $this->assertEquals('test_operation', $this->model->getOperation());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionLog::getTransactionText()
     * @covers \Vipps\Model\Payment\TransactionLog::setTransactionText()
     */
    public function testTransactionText()
    {
        $this->assertNull($this->model->getTransactionText());
        $this->assertInstanceOf(TransactionLog::class, $this->model->setTransactionText('test_transaction_text'));
        $this->assertEquals('test_transaction_text', $this->model->getTransactionText());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionLog::getRequestId()
     * @covers \Vipps\Model\Payment\TransactionLog::setRequestId()
     */
    public function testRequestId()
    {
        $this->assertNull($this->model->getRequestId());
        $this->assertInstanceOf(TransactionLog::class, $this->model->setRequestId('test_request_id'));
        $this->assertEquals('test_request_id', $this->model->getRequestId());
    }
}
