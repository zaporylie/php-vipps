<?php

namespace zaporylie\Vipps\Tests\Integration;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use PHPUnit\Framework\TestCase;
use zaporylie\Vipps\Client;
use zaporylie\Vipps\Tests\Unit\Authentication\TestTokenStorage;
use zaporylie\Vipps\Vipps;

abstract class IntegrationTestBase extends TestCase
{

    /**
     * @var \Psr\Http\Client\ClientInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $httpClient;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

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
    protected function setUp() : void
    {
        parent::setUp();
        $this->httpClient = $this->getMockBuilder(ClientInterface::class)
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();


        $this->client = new Client('test_client_id', [
            'http_client' => $this->httpClient,
            'token_storage' => new TestTokenStorage(),
        ]);

        $this->vipps = new Vipps($this->client);
    }

    /**
     * @param \GuzzleHttp\Psr7\Response $response
     */
    protected function mockResponse(Response $response)
    {
        $this->httpClient
            ->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));
    }

    /**
     * @param array $content
     *
     * @return \GuzzleHttp\Psr7\Response
     */
    public static function getResponse(array $content = [])
    {
        return new Response(200, [], \GuzzleHttp\Psr7\Utils::streamFor(json_encode($content)));
    }

    /**
     * @return \GuzzleHttp\Psr7\Response
     */
    public static function getErrorResponse($error_code = 400, $error_message = null)
    {
        if (!isset($error_message)) {
            $error_message = [
                'error_code' => 'test_access_token',
                'error_message' => 'test_token_type',
            ];
        }
        return new Response($error_code, [], \GuzzleHttp\Psr7\Utils::streamFor(json_encode($error_message)));
    }
}
