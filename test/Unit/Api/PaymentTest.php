<?php

namespace zaporylie\Vipps\Tests\Unit\Api;

use PHPUnit\Framework\TestCase;
use zaporylie\Vipps\Api\Payment;
use zaporylie\Vipps\Exceptions\Api\InvalidArgumentException;
use zaporylie\Vipps\Vipps;

class PaymentTest extends TestCase
{

    /**
     * @covers \zaporylie\Vipps\Api\Payment::getMerchantSerialNumber()
     * @covers \zaporylie\Vipps\Api\Payment::__construct()
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
