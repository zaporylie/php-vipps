<?php

namespace Vipps\Test;

use Mockery;
use Vipps\Resources\Payments;
use Vipps\VippsInterface;

class PaymentsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var VippsInterface;
     */
    private $vippsMock;

    /**
     * @var Payments;
     */
    private $payments;

    /**
     * @see PHPUnit_Framework_TestCase::tearDown()
     */
    public function tearDown()
    {
        Mockery::close();
    }

    /**
     * @see PHPUnit_Framework_TestCase::setUp()
     */
    public function setUp()
    {
        $this->vippsMock = Mockery::mock('Vipps\VippsInterface');
        $this->payments = new Payments($this->vippsMock);
        $this->payments->setOrderID('test');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage text cannot be empty
     */
    public function testCaptureEmptyText()
    {
        $this->payments->capture('');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Amount must be equal or higher than 0
     */
    public function testCaptureTooLowAmount()
    {
        $this->payments->capture('test', -1);
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Amount must be integer
     */
    public function testCaptureStringAmount()
    {
        $this->payments->capture('test', '1');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Missing order ID
     */
    public function testCaptureMissingOrderId()
    {
        $this->payments->setOrderID(null);
        $this->payments->capture('test', 1);
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage text cannot be empty
     */
    public function testRefundEmptyText()
    {
        $this->payments->refund('');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Amount must be equal or higher than 0
     */
    public function testRefundTooLowAmount()
    {
        $this->payments->refund('test', -1);
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Amount must be integer
     */
    public function testRefundStringAmount()
    {
        $this->payments->refund('test', '1');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Missing order ID
     */
    public function testRefundMissingOrderId()
    {
        $this->payments->setOrderID(null);
        $this->payments->refund('test', 1);
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage text cannot be empty
     */
    public function testCancelEmptyText()
    {
        $this->payments->cancel('');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Missing order ID
     */
    public function testCancelMissingOrderId()
    {
        $this->payments->setOrderID(null);
        $this->payments->cancel('test');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Missing order ID
     */
    public function testGetStatusMissingOrderId()
    {
        $this->payments->setOrderID(null);
        $this->payments->getStatus();
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Missing order ID
     */
    public function testGetDetailsMissingOrderId()
    {
        $this->payments->setOrderID(null);
        $this->payments->getDetails();
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage mobileNumber cannot be empty
     */
    public function testCreateEmptyMobileNumber()
    {
        $this->payments->create(null, 1, 'test', 'https://localhost');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage mobileNumber must be integer
     */
    public function testCreateNonIntegerMobileNumber()
    {
        $this->payments->create('123456', 1, 'test', 'https://localhost');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage amount cannot be empty
     */
    public function testCreateEmptyAmount()
    {
        $this->payments->create(21345, 0, 'test', 'https://localhost');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Amount must be integer
     */
    public function testCreateNonIntegerAmount()
    {
        $this->payments->create(21345, '1', 'test', 'https://localhost');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Amount must be equal or higher than 100
     */
    public function testCreateTooLowAmount()
    {
        $this->payments->create(21345, 99, 'test', 'https://localhost');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Amount must be equal or lower than 99999999
     */
    public function testCreateTooHighAmount()
    {
        $this->payments->create(21345, 100000000, 'test', 'https://localhost');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage text cannot be empty
     */
    public function testCreateEmptyText()
    {
        $this->payments->create(21345, 100, '', 'https://localhost');
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage callback must be string
     */
    public function testCreateInvalidCallbackType()
    {
        $this->payments->create(21345, 100, 'test', 1);
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage callback must start with https://
     */
    public function testCreateInvalidCallbackProtocol()
    {
        $this->payments->create(21345, 100, 'test', 'http://localhost');
    }
}
