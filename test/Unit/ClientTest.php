<?php

namespace Vipps\Tests\Unit;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PHPUnit\Framework\TestCase;
use Vipps\Authentication\TokenMemoryCacheStorage;
use Vipps\Authentication\TokenStorageInterface;
use Vipps\Client;
use Vipps\ClientInterface;
use Vipps\Endpoint;
use Vipps\EndpointInterface;
use Vipps\Exceptions\Client\InvalidArgumentException;
use Vipps\Tests\Unit\Authentication\TestTokenStorage;

class ClientTest extends TestCase
{

    /**
     * @var \Vipps\ClientInterface
     */
    protected $client;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->client = new Client('test');
    }

    /**
     * @covers \Vipps\Client::getClientId()
     * @covers \Vipps\Client::setClientId()
     */
    public function testClientId()
    {
        $this->assertEquals('test', $this->client->getClientId());
        $this->assertInstanceOf(ClientInterface::class, $this->client->setClientId(null));
        $this->expectException(InvalidArgumentException::class);
        $this->client->getClientId();
    }

    /**
     * @covers \Vipps\Client::getEndpoint()
     * @covers \Vipps\Client::setEndpoint()
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
     * @covers \Vipps\Client::getTokenStorage()
     * @covers \Vipps\Client::setTokenStorage()
     */
    public function testTokenStorage()
    {
        $this->client->setTokenStorage(new TestTokenStorage());
        $this->assertInstanceOf(TestTokenStorage::class, $this->client->getTokenStorage());
    }

    /**
     * @covers \Vipps\Client::getHttpClient()
     * @covers \Vipps\Client::setHttpClient()
     * @covers \Vipps\Client::httpClientDiscovery()
     */
    public function testHttpClient()
    {
        $this->assertInstanceOf(HttpClient::class, $this->client->getHttpClient());
        $httpClient = $this->createMock(HttpClient::class);
        $this->assertInstanceOf(Client::class, $this->client->setHttpClient($httpClient));
        $this->expectException(\LogicException::class);
        $this->client->setHttpClient('');
    }

    /**
     * @covers \Vipps\Client::getMessageFactory()
     */
    public function testGetMessageFactory()
    {
        $this->assertInstanceOf(MessageFactory::class, $this->client->getMessageFactory());
    }

    /**
     * @covers \Vipps\Client::__construct()
     */
    public function testConstruct()
    {
        $client = new Client('test_client_id', [
            'endpoint' => 'test',
            'http_client' => $this->createMock(HttpClient::class),
        ]);
        $this->assertEquals('test_client_id', $client->getClientId());
        $this->assertEquals('test', $client->getEndpoint());
        $this->assertInstanceOf(TokenMemoryCacheStorage::class, $client->getTokenStorage());
        $this->assertInstanceOf(HttpClient::class, $client->getHttpClient());


        $client = new Client('test_client_id', [
            'token_storage' => new TestTokenStorage(),
        ]);
        $this->assertInstanceOf(TestTokenStorage::class, $client->getTokenStorage());
    }
}
