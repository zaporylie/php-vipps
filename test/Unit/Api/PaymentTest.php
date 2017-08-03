<?php

namespace Vipps\Tests\Unit\Api;

use PHPUnit\Framework\TestCase;
use Vipps\Api\Payment;
use Vipps\Exceptions\Api\InvalidArgumentException;
use Vipps\Vipps;

class PaymentTest extends TestCase
{

    /**
     * @covers \Vipps\Api\Payment::getMerchantSerialNumber()
     * @covers \Vipps\Api\Payment::__construct()
     */
    public function testMerchantSerialNumber()
    {
        $vipps = $this->createMock(Vipps::class);
        $api = new Payment($vipps, 'test_subscription_key', 'test_merchant_serial_number');
        $this->assertEquals('test_merchant_serial_number', $api->getMerchantSerialNumber());
        $api = new Payment($vipps, 'test_subscription_key', null);
        $this->expectException(InvalidArgumentException::class);
        $api->getMerchantSerialNumber();
    }
}
