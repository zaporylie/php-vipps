<?php

namespace Vipps\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Vipps\Api\Authorization;
use Vipps\Api\Payment;
use Vipps\ClientInterface;
use Vipps\Vipps;
use Vipps\VippsInterface;

class VippsTest extends TestCase
{

    /**
     * @var \Vipps\ClientInterface
     */
    protected $client;

    /**
     * @var \Vipps\VippsInterface
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
     * @covers \Vipps\Vipps::getClient()
     */
    public function testClient()
    {
        $this->assertEquals($this->client, $this->vipps->getClient());
    }

    /**
     * @covers \Vipps\Vipps::payment()
     */
    public function testPayment()
    {
        $this->assertInstanceOf(
            Payment::class,
            $this->vipps->payment('test_subscription_key', 'test_merchant_serial_key')
        );
    }

    /**
     * @covers \Vipps\Vipps::authorization()
     */
    public function testAuthorization()
    {
        $this->assertInstanceOf(Authorization::class, $this->vipps->authorization('test_subscription_key'));
    }

    /**
     * @covers \Vipps\Vipps::__construct()
     */
    public function testConstruct()
    {
        $this->assertEquals($this->client, $this->vipps->getClient());
    }
}
