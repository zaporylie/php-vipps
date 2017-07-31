<?php

namespace Vipps\Tests\Unit\Model;

use PHPUnit\Framework\TestCase;
use Vipps\Client;
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

        // Create Client stub.
        $stub = $this->createMock(Client::class);
        $stub->method('getClientId')->willReturn('foo');
        $this->client = $stub;

        // Get Vipps.
        $this->vipps = new Vipps($this->client);
    }
}
