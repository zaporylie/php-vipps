<?php

namespace Vipps\Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Vipps\Authentication\TokenStorageInterface;
use Vipps\Client;
use Vipps\Tests\Unit\Authentication\TestTokenStorage;
use Vipps\Vipps;

abstract class ModelTestBase extends TestCase
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

        $token = new TestTokenStorage();

        // Create Client stub.
        $this->client = $this->createMock(Client::class);
        $this->client
            ->expects($this->any())
            ->method('getClientId')
            ->willReturn('foo');

        $this->client
            ->expects($this->any())
            ->method('getTokenStorage')
            ->will($this->returnValue($token));


        // Get Vipps.
        $this->vipps = new Vipps($this->client);
    }
}
