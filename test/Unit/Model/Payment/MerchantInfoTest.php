<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Payment;

use zaporylie\Vipps\Model\Payment\MerchantInfo;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class MerchantInfoTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Payment\MerchantInfo
     */
    protected $model;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->model = (new MerchantInfo())
            ->setMerchantSerialNumber(12345)
            ->setCallBack('http://example.com');
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\MerchantInfo::getMerchantSerialNumber()
     */
    public function testGetMerchantSerialNumber()
    {
        $this->assertEquals(12345, $this->model->getMerchantSerialNumber());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\MerchantInfo::setMerchantSerialNumber()
     */
    public function testSetMobileNumber()
    {
        $this->assertInstanceOf(MerchantInfo::class, $this->model->setMerchantSerialNumber(54321));
        $this->assertEquals('54321', $this->model->getMerchantSerialNumber());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\MerchantInfo::getCallBack()
     */
    public function testGetCallBack()
    {
        $this->assertEquals('http://example.com', $this->model->getCallBack());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Payment\MerchantInfo::setCallBack()
     */
    public function testSetCallBack()
    {
        $this->assertInstanceOf(MerchantInfo::class, $this->model->setCallBack('http://test.example.com'));
        $this->assertEquals('http://test.example.com', $this->model->getCallBack());
    }
}
