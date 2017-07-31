<?php

namespace Vipps\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;
use Http\Client\HttpClient;
use PHPUnit\Framework\TestCase;
use Vipps\Client;
use Vipps\Vipps;

abstract class IntegrationTestBase extends TestCase
{

    /**
     * @var \Http\Client\HttpClient|\Http\Client\HttpAsyncClient
     */
    protected $httpClient;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

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
        $this->httpClient = $this->getMockBuilder(HttpClient::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();

        $this->client = new Client('test_client_id', [
            'http_client' => $this->httpClient,
        ]);

        $this->vipps = new Vipps($this->client);
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     */
    protected function mockResponse(Response $response)
    {
        $this->httpClient->method('sendRequest')->willReturn($response);
    }

    /**
     * @param array $content
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    protected function getResponse(array $content = [])
    {
        return new Response(200, [], stream_for(json_encode($content)));
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    protected function getErrorResponse()
    {
        return new Response(400, [], stream_for(json_encode([
            'error' => 'test_access_token',
            'error_message' => 'test_token_type',
        ])));
    }
}
