<?php

namespace Vipps\Tests\Unit\Resource;

use JMS\Serializer\Serializer;
use Psr\Http\Message\UriInterface;
use Vipps\Resource\HttpMethod;
use Vipps\Resource\ResourceBase;

class ResourceBaseTest extends ResourceTestBase
{

    /**
     * @var \Vipps\Resource\ResourceBase
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
     * @covers \Vipps\Resource\ResourceBase::__construct()
     * @covers \Vipps\Resource\ResourceBase::getSerializer()
     */
    public function testSerializer()
    {
        $this->assertInstanceOf(
            Serializer::class,
            $this->resourceBase->getSerializer()
        );
    }

    /**
     * @covers \Vipps\Resource\ResourceBase::__construct()
     * @covers \Vipps\Resource\ResourceBase::getHeaders()
     */
    public function testHeaders()
    {
        $this->assertArrayHasKey(
            'Ocp-Apim-Subscription-Key',
            $this->resourceBase->getHeaders()
        );
    }

    /**
     * @covers \Vipps\Resource\ResourceBase::getMethod()
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
     * @covers \Vipps\Resource\ResourceBase::getPath()
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
     * @covers \Vipps\Resource\ResourceBase::getBody()
     */
    public function testBody()
    {
        $this->assertEquals('test_body', $this->resourceBase->getBody());
    }

    /**
     * @covers \Vipps\Resource\ResourceBase::getPath()
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
     * @covers \Vipps\Resource\ResourceBase::getUri()
     */
    public function testUri()
    {
        $this->assertInstanceOf(UriInterface::class, $uri = $this->resourceBase->getUri('/test_path'));
        $this->assertEquals('/test_path', $uri->getPath());
    }
}
