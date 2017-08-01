<?php

namespace Vipps\Tests\Unit\Resource;

use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use Vipps\Client;
use Vipps\Vipps;

abstract class ResourceTestBase extends TestCase
{

    /**
     * @var \Vipps\Vipps
     */
    protected $vipps;

    /**
     * @var \Vipps\Client
     */
    protected $client;

    /**
     * @var \Http\Client\HttpClient
     */
    protected $httpClient;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->httpClient = $this->createMock(HttpClient::class);
        $this->client = new Client('test_client_id', [
            'http_client' => $this->httpClient,
            'token' => 'test_token',
        ]);
        $this->vipps = new Vipps($this->client);
    }
}
