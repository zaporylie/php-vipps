<?php

namespace Vipps\Tests\Unit;

use Http\Client\HttpClient;
use Http\Message\MessageFactory;
use PHPUnit\Framework\TestCase;
use Vipps\Client;
use Vipps\ClientInterface;
use Vipps\Endpoint;
use Vipps\EndpointInterface;
use Vipps\Exceptions\Client\InvalidArgumentException;

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
     * @covers \Vipps\Client::getToken()
     * @covers \Vipps\Client::setToken()
     */
    public function testToken()
    {
        $this->client->setToken('token');
        $this->assertEquals('token', $this->client->getToken());
        $this->assertInstanceOf(ClientInterface::class, $this->client->setToken(null));
        $this->expectException(InvalidArgumentException::class);
        $this->client->getToken();
    }

    /**
     * @covers \Vipps\Client::getTokenType()
     * @covers \Vipps\Client::setTokenType()
     */
    public function testTokenType()
    {
        $this->assertEquals('Bearer', $this->client->getTokenType());
        $this->assertInstanceOf(ClientInterface::class, $this->client->setTokenType(null));
        $this->expectException(InvalidArgumentException::class);
        $this->client->getTokenType();
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
            'token' => 'test_token',
            'token_type' => 'test_token_type',
            'http_client' => $this->createMock(HttpClient::class),
        ]);
        $this->assertEquals('test_client_id', $client->getClientId());
        $this->assertEquals('test_token', $client->getToken());
        $this->assertEquals('test_token_type', $client->getTokenType());
        $this->assertEquals('test', $client->getEndpoint());
        $this->assertInstanceOf(HttpClient::class, $client->getHttpClient());
    }

}
