<?php

namespace zaporylie\Vipps\Tests\Unit\Resource;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;
use Http\Client\Exception\HttpException;
use Http\Client\HttpAsyncClient;
use Http\Promise\FulfilledPromise;
use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use zaporylie\Vipps\Exceptions\VippsException;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\Resource\ResourceBase;
use zaporylie\Vipps\Tests\Integration\IntegrationTestBase;

class ResourceBaseTest extends ResourceTestBase
{

    /**
     * @var \zaporylie\Vipps\Resource\ResourceBase
     */
    protected $resourceBase;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->resourceBase = $this->getMockForAbstractClass(
            ResourceBase::class,
            [
                $this->vipps,
                'test_subscription_key',
            ]
        );

        // Set default method.
        $reflection = new \ReflectionClass($this->resourceBase);
        $method = $reflection->getProperty('method');
        $method->setAccessible(true);
        $method->setValue($this->resourceBase, HttpMethod::POST);

        // Set default body.
        $body = $reflection->getProperty('body');
        $body->setAccessible(true);
        $body->setValue($this->resourceBase, 'test_body');

        // Set default body.
        $path = $reflection->getProperty('path');
        $path->setAccessible(true);
        $path->setValue($this->resourceBase, 'test_path');
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::__construct()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getSerializer()
     */
    public function testSerializer()
    {
        $this->assertInstanceOf(
            Serializer::class,
            $this->resourceBase->getSerializer()
        );
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::__construct()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getHeaders()
     */
    public function testHeaders()
    {
        $this->assertArrayHasKey(
            'Ocp-Apim-Subscription-Key',
            $this->resourceBase->getHeaders()
        );
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getMethod()
     */
    public function testMethod()
    {
        $this->assertEquals(HttpMethod::POST, $this->resourceBase->getMethod());

        $reflection = new \ReflectionClass($this->resourceBase);
        $method = $reflection->getProperty('method');
        $method->setAccessible(true);
        $method->setValue($this->resourceBase, null);

        $this->expectException(\LogicException::class);
        $this->resourceBase->getMethod();
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getPath()
     */
    public function testPath()
    {
        $this->assertEquals('test_path', $this->resourceBase->getPath());

        $reflection = new \ReflectionClass($this->resourceBase);
        $path = $reflection->getProperty('path');
        $path->setAccessible(true);
        $path->setValue($this->resourceBase, null);

        $this->expectException(\LogicException::class);
        $this->resourceBase->getPath();
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getBody()
     */
    public function testBody()
    {
        $this->assertEquals('test_body', $this->resourceBase->getBody());
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getPath()
     */
    public function testId()
    {
        $reflection = new \ReflectionClass($this->resourceBase);

        $id = $reflection->getProperty('id');
        $id->setAccessible(true);
        $id->setValue($this->resourceBase, 123);

        $path = $reflection->getProperty('path');
        $path->setAccessible(true);
        $path->setValue($this->resourceBase, 'test_path/{id}');
        $this->assertEquals('test_path/123', $this->resourceBase->getPath());
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getUri()
     */
    public function testUri()
    {
        $this->assertInstanceOf(UriInterface::class, $uri = $this->resourceBase->getUri('/test_path'));
        $this->assertEquals('/test_path', $uri->getPath());
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::handleRequest()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::getRequest()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::handleResponse()
     */
    public function testHttpSuccess()
    {
        $response = new Response(200, [], stream_for(json_encode([])));
        $this->httpClient
            ->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue($response));

        $reflection = new \ReflectionClass($this->resourceBase);
        $makeCall = $reflection->getMethod('makeCall');
        $makeCall->setAccessible(true);

        // Test HttpClient.
        $this->assertInstanceOf(ResponseInterface::class, $makeCall->invoke($this->resourceBase));

        // Test HttpAsyncClient.
        $this->httpClient = $this->createMock(HttpAsyncClient::class);
        $this->vipps->getClient()->setHttpClient($this->httpClient);
        $this->httpClient
            ->expects($this->any())
            ->method('sendAsyncRequest')
            ->will($this->returnValue(new FulfilledPromise($response)));

        $this->assertInstanceOf(ResponseInterface::class, $makeCall->invoke($this->resourceBase));
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::handleResponse()
     */
    public function testHttpErrorsResponse()
    {
        $this->expectException(VippsException::class);
        $reflection = new \ReflectionClass($this->resourceBase);
        $makeCall = $reflection->getMethod('makeCall');
        $makeCall->setAccessible(true);
        $this->httpClient
            ->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue(IntegrationTestBase::getErrorResponse()));
        $this->vipps->getClient()->setHttpClient($this->httpClient);
        $this->assertNotInstanceOf(ResponseInterface::class, $response = $makeCall->invoke($this->resourceBase));
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::handleResponse()
     */
    public function testHttpErrorsResponseWithException()
    {
        $this->expectException(VippsException::class);
        $reflection = new \ReflectionClass($this->resourceBase);
        $makeCall = $reflection->getMethod('makeCall');
        $makeCall->setAccessible(true);
        $response = IntegrationTestBase::getErrorResponse();
        // Test http client with 'http_errors' => true.
        $this->httpClient
            ->expects($this->any())
            ->method('sendRequest')
            ->willThrowException(new HttpException(
                $response->getReasonPhrase(),
                $this->createMock(Request::class),
                $response
            ));
        $this->vipps->getClient()->setHttpClient($this->httpClient);
        $this->assertNotInstanceOf(ResponseInterface::class, $response = $makeCall->invoke($this->resourceBase));
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::handleResponse()
     */
    public function testHttpServerError()
    {
        $this->expectException(VippsException::class);
        $reflection = new \ReflectionClass($this->resourceBase);
        $makeCall = $reflection->getMethod('makeCall');
        $makeCall->setAccessible(true);
        $this->httpClient
            ->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue(IntegrationTestBase::getErrorResponse(500)));
        $this->vipps->getClient()->setHttpClient($this->httpClient);
        $this->assertNotInstanceOf(ResponseInterface::class, $response = $makeCall->invoke($this->resourceBase));
    }

    /**
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::handleResponse()
     */
    public function testHttpSuccessWithErrorInBody()
    {
        $this->expectException(VippsException::class);
        $reflection = new \ReflectionClass($this->resourceBase);
        $makeCall = $reflection->getMethod('makeCall');
        $makeCall->setAccessible(true);
        $this->httpClient
            ->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue(IntegrationTestBase::getResponse([[
                'errorGroup' => 'test_group',
                'errorCode' => 'test_code',
                'errorMessage' => 'test_message',
            ]])));
        $this->vipps->getClient()->setHttpClient($this->httpClient);
        $this->assertNotInstanceOf(ResponseInterface::class, $response = $makeCall->invoke($this->resourceBase));
    }
}
