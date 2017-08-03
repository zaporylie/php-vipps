<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\TransactionInfo;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class TransactionInfoTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\TransactionInfo
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new TransactionInfo();
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::getAmount()
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::setAmount()
     */
    public function testAmount()
    {
        $this->assertNull($this->model->getAmount());
        $this->assertInstanceOf(TransactionInfo::class, $this->model->setAmount(2300));
        $this->assertEquals(2300, $this->model->getAmount());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::getTimeStamp()
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::setTimeStamp()
     */
    public function testTimeStamp()
    {
        $this->assertNull($this->model->getTimeStamp());
        $this->assertInstanceOf(TransactionInfo::class, $this->model->setTimeStamp(new \DateTime()));
        $this->assertInstanceOf(\DateTimeInterface::class, $this->model->getTimeStamp());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::getTransactionId()
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::setTransactionId()
     */
    public function testTransactionId()
    {
        $this->assertNull($this->model->getTransactionId());
        $this->assertInstanceOf(TransactionInfo::class, $this->model->setTransactionId('test_transaction_id'));
        $this->assertEquals('test_transaction_id', $this->model->getTransactionId());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::getStatus()
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::setStatus()
     */
    public function testStatus()
    {
        $this->assertNull($this->model->getStatus());
        $this->assertInstanceOf(TransactionInfo::class, $this->model->setStatus('test_status'));
        $this->assertEquals('test_status', $this->model->getStatus());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::getMessage()
     * @covers \zaporylie\Vipps\Model\Payment\TransactionInfo::setMessage()
     */
    public function testMessage()
    {
        $this->assertNull($this->model->getMessage());
        $this->assertInstanceOf(TransactionInfo::class, $this->model->setMessage('test_message'));
        $this->assertEquals('test_message', $this->model->getMessage());
    }
}
