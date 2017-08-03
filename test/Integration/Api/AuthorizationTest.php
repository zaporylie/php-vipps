<?php

namespace zaporylie\Vipps\Tests\Integration\Api;

use zaporylie\Vipps\Exceptions\VippsException;
use zaporylie\Vipps\Tests\Integration\IntegrationTestBase;

/**
 * Class AuthorizationTest
 *
 * @package Vipps\Tests\Integration\Api
 */
class AuthorizationTest extends IntegrationTestBase
{

    /**
     * @covers \zaporylie\Vipps\Api\Authorization::getToken()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     */
    public function testValidGetToken()
    {
        // Get API.
        $api = $this->vipps->authorization('test_subscription_key');

        // Mock response.
        $this->mockResponse($this->getResponse([
            'access_token' => 'test_access_token',
            'token_type' => 'test_token_type',
            'expires_in' => 123,
            'ext_expires_in' => 321,
            'expires_on' => 1765432100,
            'not_before' => 1765432100,
            'resource' => 'test_resource',
        ]));

        // Do request.
        $response = $api->getToken('test_client_secret');

        // Assert response.
        $this->assertEquals('test_access_token', $response->getAccessToken());
        $this->assertEquals('test_token_type', $response->getTokenType());
        $this->assertEquals(123, $response->getExpiresIn());
        $this->assertEquals(321, $response->getExtExpiresIn());
        $this->assertInstanceOf(\DateTimeInterface::class, $response->getExpiresOn());
        $this->assertInstanceOf(\DateTimeInterface::class, $response->getNotBefore());
        $this->assertEquals('test_resource', $response->getResource());
    }

    /**
     * @covers \zaporylie\Vipps\Api\Authorization::getToken()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     */
    public function testInvalidGetToken()
    {
        $api = $this->vipps->authorization('test_subscription_key');
        $this->mockResponse(parent::getErrorResponse());
        $this->expectException(VippsException::class);
        $this->expectExceptionCode(400);
        $api->getToken('test_client_secret');
    }

    /**
     * @covers \zaporylie\Vipps\Api\Authorization::getToken()
     * @covers \zaporylie\Vipps\Resource\ResourceBase::makeCall()
     */
    public function testServerError()
    {
        $api = $this->vipps->authorization('test_subscription_key');
        $this->mockResponse(parent::getErrorResponse(500, 'Error'));
        $this->expectException(VippsException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage('Error');
        $api->getToken('test_client_secret');
    }
}
