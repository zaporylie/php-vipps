<?php

namespace zaporylie\Vipps\Tests\Unit;

use PHPUnit\Framework\TestCase;
use zaporylie\Vipps\Api\Authorization;
use zaporylie\Vipps\Api\Payment;
use zaporylie\Vipps\ClientInterface;
use zaporylie\Vipps\Vipps;
use zaporylie\Vipps\VippsInterface;

class VippsTest extends TestCase
{

    /**
     * @var \zaporylie\Vipps\ClientInterface
     */
    protected $client;

    /**
     * @var \zaporylie\Vipps\VippsInterface
     */
    protected $vipps;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->client = $this->createMock(ClientInterface::class);
        $this->vipps = new Vipps($this->client);
    }

    /**
     * @covers \zaporylie\Vipps\Vipps::getClient()
     */
    public function testClient()
    {
        $this->assertEquals($this->client, $this->vipps->getClient());
    }

    /**
     * @covers \zaporylie\Vipps\Vipps::payment()
     */
    public function testPayment()
    {
        $this->assertInstanceOf(
            Payment::class,
            $this->vipps->payment('test_subscription_key', 'test_merchant_serial_key')
        );
    }

    /**
     * @covers \zaporylie\Vipps\Vipps::authorization()
     */
    public function testAuthorization()
    {
        $this->assertInstanceOf(Authorization::class, $this->vipps->authorization('test_subscription_key'));
    }

    /**
     * @covers \zaporylie\Vipps\Vipps::__construct()
     */
    public function testConstruct()
    {
        $this->assertEquals($this->client, $this->vipps->getClient());
    }
}
