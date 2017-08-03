<?php

namespace zaporylie\Vipps\Tests\Unit;

use Eloquent\Enumeration\Exception\UndefinedMemberException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\UriInterface;
use zaporylie\Vipps\Endpoint;
use zaporylie\Vipps\EndpointInterface;

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
     * @covers \zaporylie\Vipps\Endpoint::__construct()
     * @covers \zaporylie\Vipps\Endpoint::initializeMembers()
     */
    public function testAllowedEndpoints()
    {
        $this->assertInstanceOf(EndpointInterface::class, Endpoint::test());
        $this->assertInstanceOf(EndpointInterface::class, Endpoint::live());
        $this->expectException(UndefinedMemberException::class);
        Endpoint::foo();
    }

    /**
     * @covers \zaporylie\Vipps\Endpoint::getScheme()
     * @covers \zaporylie\Vipps\Endpoint::getHost()
     * @covers \zaporylie\Vipps\Endpoint::getPort()
     * @covers \zaporylie\Vipps\Endpoint::getPath()
     * @covers \zaporylie\Vipps\Endpoint::getUri()
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
