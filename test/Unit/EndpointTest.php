<?php

namespace Vipps\Tests\Unit;

use Eloquent\Enumeration\Exception\UndefinedMemberException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;
use Vipps\Endpoint;
use Vipps\EndpointInterface;

class EndpointTest extends TestCase
{

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
    }

    /**
     * @covers \Vipps\Endpoint::__construct()
     */
    public function testAllowedEndpoints()
    {
        $this->assertInstanceOf(EndpointInterface::class, Endpoint::test());
        $this->assertInstanceOf(EndpointInterface::class, Endpoint::live());
        $this->expectException(UndefinedMemberException::class);
        Endpoint::foo();
    }

    /**
     * @covers \Vipps\Endpoint::getScheme()
     * @covers \Vipps\Endpoint::getHost()
     * @covers \Vipps\Endpoint::getPort()
     * @covers \Vipps\Endpoint::getPath()
     * @covers \Vipps\Endpoint::getUri()
     */
    public function testGetters()
    {
        $endpoint = Endpoint::test();
        $this->assertNotEmpty($endpoint->getScheme());
        $this->assertNotEmpty($endpoint->getHost());
        $this->assertNotEmpty($endpoint->getPort());
        $this->assertNotNull($endpoint->getPath());
        $this->assertInstanceOf(UriInterface::class, $endpoint->getUri());
    }
}
