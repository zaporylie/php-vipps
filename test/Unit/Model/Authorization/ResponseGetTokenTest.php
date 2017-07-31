<?php

namespace Vipps\Tests\Unit\Model\Authorization;

use Vipps\Client;
use Vipps\Model\Authorization\ResponseGetToken;
use Vipps\Resource\Authorization\GetToken;
use Vipps\Tests\Unit\Model\ModelTestBase;
use Vipps\Vipps;

class ResponseGetTokenTest extends ModelTestBase
{


    /**
     * @var \Vipps\Resource\Authorization\GetToken
     */
    protected $resource;

    /**
     * @var \Vipps\Model\Authorization\ResponseGetToken
     */
    protected $response;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        $this->resource = new GetToken($this->vipps, 'test', 'test');
        $this->response = $this->resource->getSerializer()->deserialize(
            json_encode((object) [
                'access_token' => 'test_access_token',
                'token_type' => 'test_token_type',
                'expires_in' => 123,
                'ext_expires_in' => 123,
                'expires_on' => (new \DateTime())->format('U'),
                'not_before' => (new \DateTime())->format('U'),
            ]),
            ResponseGetToken::class,
            'json'
        );
    }

    /**
     * @covers \Vipps\Model\Authorization\ResponseGetToken::getAccessToken()
     */
    public function testGetAccessToken()
    {
        $this->assertEquals('test_access_token', $this->response->getAccessToken());
    }

    /**
     * @covers \Vipps\Model\Authorization\ResponseGetToken::getExpiresIn()
     */
    public function testExpiresIn()
    {
        $this->assertEquals(123, $this->response->getExpiresIn());
    }

    /**
     * @covers \Vipps\Model\Authorization\ResponseGetToken::getExtExpiresIn()
     */
    public function testExtExpiresIn()
    {
        $this->assertEquals(123, $this->response->getExtExpiresIn());
    }

    /**
     * @covers \Vipps\Model\Authorization\ResponseGetToken::getExpiresOn()
     */
    public function testExpiresOn()
    {
        $this->assertInstanceOf(\DateTimeInterface::class, $this->response->getExpiresOn());
    }

    /**
     * @covers \Vipps\Model\Authorization\ResponseGetToken::getNotBefore()
     */
    public function testNotBefore()
    {
        $this->assertInstanceOf(\DateTimeInterface::class, $this->response->getNotBefore());
    }

}
