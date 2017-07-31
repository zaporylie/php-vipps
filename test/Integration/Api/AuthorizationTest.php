<?php

namespace Vipps\Tests\Integration\Api;

use GuzzleHttp\Psr7\Response;
use function GuzzleHttp\Psr7\stream_for;
use Vipps\Exceptions\VippsException;
use Vipps\Tests\Integration\IntegrationTestBase;

class AuthorizationTest extends IntegrationTestBase
{

    /**
     * @covers \Vipps\Api\Authorization::getToken()
     */
    public function testValidGetToken()
    {
        $api = $this->vipps->authorization('test_subscription_key');
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(200, [], stream_for(json_encode([
                'access_token' => 'test_access_token',
                'token_type' => 'test_token_type',
                'expires_in' => 123,
                'ext_expires_in' => 321,
                'expires_on' => 1765432100,
                'not_before' => 1765432100,
                'resource' => 'test_resource',
            ]))));
        $response = $api->getToken('test_client_secret');
        $this->assertEquals('test_access_token', $response->getAccessToken());
        $this->assertEquals('test_token_type', $response->getTokenType());
        $this->assertEquals(123, $response->getExpiresIn());
        $this->assertEquals(321, $response->getExtExpiresIn());
        $this->assertInstanceOf(\DateTimeInterface::class, $response->getExpiresOn());
        $this->assertInstanceOf(\DateTimeInterface::class, $response->getNotBefore());
        $this->assertEquals('test_resource', $response->getResource());
    }

    /**
     * @covers \Vipps\Api\Authorization::getToken()
     */
    public function testInvalidGetToken()
    {
        $api = $this->vipps->authorization('test_subscription_key');
        $this->httpClient
            ->method('sendRequest')
            ->willReturn(new Response(401, [], stream_for(json_encode([
                'error' => 'test_access_token',
                'error_message' => 'test_token_type',
            ]))));
        $this->expectException(VippsException::class);
        $api->getToken('test_client_secret');
    }
}
