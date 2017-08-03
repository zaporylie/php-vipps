<?php

namespace zaporylie\Vipps\Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use zaporylie\Vipps\Authentication\TokenStorageInterface;
use zaporylie\Vipps\Client;
use zaporylie\Vipps\Tests\Unit\Authentication\TestTokenStorage;
use zaporylie\Vipps\Vipps;

abstract class ModelTestBase extends TestCase
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
