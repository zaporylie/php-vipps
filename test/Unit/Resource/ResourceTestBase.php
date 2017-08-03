<?php

namespace zaporylie\Vipps\Tests\Unit\Resource;

use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use zaporylie\Vipps\Client;
use zaporylie\Vipps\Tests\Unit\Authentication\TestTokenStorage;
use zaporylie\Vipps\Vipps;

abstract class ResourceTestBase extends TestCase
{

    /**
     * @var \zaporylie\Vipps\Vipps
     */
    protected $vipps;

    /**
     * @var \zaporylie\Vipps\Client
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
            'token_storage' => new TestTokenStorage(),
        ]);
        $this->vipps = new Vipps($this->client);
    }
}
