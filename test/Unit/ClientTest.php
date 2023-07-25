<?php

namespace zaporylie\Vipps\Tests\Unit;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PHPUnit\Framework\TestCase;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use zaporylie\Vipps\Authentication\TokenMemoryCacheStorage;
use zaporylie\Vipps\Authentication\TokenStorageInterface;
use zaporylie\Vipps\Client;
use zaporylie\Vipps\ClientInterface;
use zaporylie\Vipps\Endpoint;
use zaporylie\Vipps\EndpointInterface;
use zaporylie\Vipps\Exceptions\Client\InvalidArgumentException;
use zaporylie\Vipps\Tests\Unit\Authentication\TestTokenStorage;

class ClientTest extends TestCase
{

    /**
     * @var \zaporylie\Vipps\ClientInterface
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        parent::setUp();

        $this->client = new Client('test');
    }

    /**
     * @covers \zaporylie\Vipps\Client::getClientId()
     * @covers \zaporylie\Vipps\Client::setClientId()
     */
    public function testClientId()
    {
        $this->assertEquals('test', $this->client->getClientId());
    }

    /**
     * @covers \zaporylie\Vipps\Client::getEndpoint()
     * @covers \zaporylie\Vipps\Client::setEndpoint()
     */
    public function testEndpoint()
    {
        $this->assertEquals('test', $this->client->getEndpoint());
        $this->assertInstanceOf(EndpointInterface::class, $this->client->getEndpoint());
        $this->assertInstanceOf(ClientInterface::class, $this->client->setEndpoint(Endpoint::live()));
        $this->expectException(\Exception::class);
        $this->client->setEndpoint(Endpoint::error());
    }

    /**
     * @covers \zaporylie\Vipps\Client::getTokenStorage()
     * @covers \zaporylie\Vipps\Client::setTokenStorage()
     */
    public function testTokenStorage()
    {
        $this->client->setTokenStorage(new TestTokenStorage());
        $this->assertInstanceOf(TestTokenStorage::class, $this->client->getTokenStorage());
    }

    /**
     * @covers \zaporylie\Vipps\Client::getHttpClient()
     * @covers \zaporylie\Vipps\Client::setHttpClient()
     * @covers \zaporylie\Vipps\Client::httpClientDiscovery()
     */
    public function testHttpClient()
    {
        $this->assertInstanceOf(HttpClientInterface::class, $this->client->getHttpClient());
        $httpClient = $this->createMock(HttpClientInterface::class);
        $this->assertInstanceOf(Client::class, $this->client->setHttpClient($httpClient));
        $this->expectError();
        $this->client->setHttpClient('');
    }

    /**
     * @covers \zaporylie\Vipps\Client::getRequestFactory()
     */
    public function testGetMessageFactory()
    {
        $this->assertInstanceOf(RequestFactoryInterface::class, $this->client->getRequestFactory());
    }

    /**
     * @covers \zaporylie\Vipps\Client::__construct()
     */
    public function testConstruct()
    {
        $client = new Client('test_client_id', [
            'endpoint' => 'test',
            'http_client' => $this->createMock(HttpClientInterface::class),
        ]);
        $this->assertEquals('test_client_id', $client->getClientId());
        $this->assertEquals('test', $client->getEndpoint());
        $this->assertInstanceOf(TokenMemoryCacheStorage::class, $client->getTokenStorage());
        $this->assertInstanceOf(HttpClientInterface::class, $client->getHttpClient());


        $client = new Client('test_client_id', [
            'token_storage' => new TestTokenStorage(),
        ]);
        $this->assertInstanceOf(TestTokenStorage::class, $client->getTokenStorage());
    }
}
