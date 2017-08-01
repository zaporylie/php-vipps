<?php

namespace Vipps\Tests\Unit\Model\Payment;

use Vipps\Model\Payment\TransactionSummary;
use Vipps\Tests\Unit\Model\ModelTestBase;

class TransactionSummaryTest extends ModelTestBase
{

    /**
     * @var \Vipps\Model\Payment\TransactionSummary
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = new TransactionSummary();
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionSummary::getRemainingAmountToRefund()
     * @covers \Vipps\Model\Payment\TransactionSummary::setRemainingAmountToRefund()
     */
    public function testRemainingAmountToRefund()
    {
        $this->assertNull($this->model->getRemainingAmountToRefund());
        $this->assertInstanceOf(TransactionSummary::class, $this->model->setRemainingAmountToRefund(10));
        $this->assertEquals(10, $this->model->getRemainingAmountToRefund());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionSummary::getRefundedAmount()
     * @covers \Vipps\Model\Payment\TransactionSummary::setRefundedAmount()
     */
    public function testRefundedAmount()
    {
        $this->assertNull($this->model->getRefundedAmount());
        $this->assertInstanceOf(TransactionSummary::class, $this->model->setRefundedAmount(10));
        $this->assertEquals(10, $this->model->getRefundedAmount());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionSummary::getRemainingAmountToCapture()
     * @covers \Vipps\Model\Payment\TransactionSummary::setRemainingAmountToCapture()
     */
    public function testRemainingAmountToCapture()
    {
        $this->assertNull($this->model->getRemainingAmountToCapture());
        $this->assertInstanceOf(TransactionSummary::class, $this->model->setRemainingAmountToCapture(10));
        $this->assertEquals(10, $this->model->getRemainingAmountToCapture());
    }

    /**
     * @covers \Vipps\Model\Payment\TransactionSummary::getCapturedAmount()
     * @covers \Vipps\Model\Payment\TransactionSummary::setCapturedAmount()
     */
    public function testCapturedAmount()
    {
        $this->assertNull($this->model->getCapturedAmount());
        $this->assertInstanceOf(TransactionSummary::class, $this->model->setCapturedAmount(10));
        $this->assertEquals(10, $this->model->getCapturedAmount());
    }
}
