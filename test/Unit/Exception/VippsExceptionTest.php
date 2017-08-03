<?php

namespace zaporylie\Vipps\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use zaporylie\Vipps\Exceptions\VippsException;
use zaporylie\Vipps\Resource\ResourceBase;
use zaporylie\Vipps\Tests\Integration\IntegrationTestBase;
use zaporylie\Vipps\Vipps;

class VippsExceptionTest extends TestCase
{

    /**
     * @var \zaporylie\Vipps\VippsInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $vipps;

    /**
     * @var \zaporylie\Vipps\Resource\ResourceBase
     */
    protected $resource;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->vipps = $this->createMock(Vipps::class);
        $this->resource = $this->getMockForAbstractClass(ResourceBase::class, [
            $this->vipps,
            'test_subscription_key'
        ]);
    }

    /**
     * @covers \zaporylie\Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::parsePhrase()
     */
    public function testParserOnBodyWithoutError()
    {
        $this->assertNull(VippsException::createFromResponse(
            IntegrationTestBase::getResponse(),
            null,
            false
        ));
    }

    /**
     * @covers \zaporylie\Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::parsePhrase()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::__construct()
     */
    public function testParserOnBodyWithErrorCode()
    {
        $this->assertInstanceOf(VippsException::class, VippsException::createFromResponse(
            IntegrationTestBase::getErrorResponse(),
            null,
            false
        ));
    }

    /**
     * @covers \zaporylie\Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::parsePhrase()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::getError()
     */
    public function testParserOnBodyWithParsableAuthorizationErrorMessage()
    {
        $this->assertInstanceOf(VippsException::class, $exception = VippsException::createFromResponse(
            IntegrationTestBase::getErrorResponse(400, [
                'error' => 'test_error',
                'error_description' => 'test_message',
                'error_codes' => [
                    5000
                ],
            ]),
            $this->resource->getSerializer()
        ));
        $this->assertEquals('test_message', $exception->getMessage());
        $this->assertEquals('5000', $exception->getError()->getCode());
        $this->assertEquals('test_error', $exception->getError()->getError());
        $this->assertEquals(400, $exception->getCode());
    }

    /**
     * @covers \zaporylie\Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::parsePhrase()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::getError()
     */
    public function testParserOnBodyWithParsablePaymentErrorMessage()
    {
        $this->assertInstanceOf(VippsException::class, $exception = VippsException::createFromResponse(
            IntegrationTestBase::getErrorResponse(400, [[
                'errorGroup' => 'test_error',
                'errorMessage' => 'test_message',
                'errorCode' => 5000,
            ]]),
            $this->resource->getSerializer()
        ));
        $this->assertEquals('test_message', $exception->getMessage());
        $this->assertEquals('5000', $exception->getError()->getCode());
        $this->assertEquals('test_error', $exception->getError()->getErrorGroup());
        $this->assertEquals(400, $exception->getCode());
    }

    /**
     * @covers \zaporylie\Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \zaporylie\Vipps\Exceptions\VippsException::parsePhrase()
     */
    public function testParserOnBodyWithUnparsablePaymentErrorMessage()
    {
        $this->assertInstanceOf(VippsException::class, $exception = VippsException::createFromResponse(
            IntegrationTestBase::getErrorResponse(400, $message = [[
                'errorGroup' => 'test_error',
                'errorMessage' => 'test_message',
                'errorCode' => [
                    5000
                ],
            ]]),
            $this->resource->getSerializer()
        ));
        $this->assertEquals(400, $exception->getCode());
        $this->assertEquals(json_encode($message), $exception->getMessage());
    }
}
