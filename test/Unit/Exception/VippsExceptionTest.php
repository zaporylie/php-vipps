<?php

namespace Vipps\Tests\Unit\Exception;

use PHPUnit\Framework\TestCase;
use Vipps\Exceptions\VippsException;
use Vipps\Resource\ResourceBase;
use Vipps\Tests\Integration\IntegrationTestBase;
use Vipps\Vipps;

class VippsExceptionTest extends TestCase
{

    /**
     * @var \Vipps\VippsInterface|\PHPUnit_Framework_MockObject_MockObject
     */
    protected $vipps;

    /**
     * @var \Vipps\Resource\ResourceBase
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
     * @covers \Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \Vipps\Exceptions\VippsException::getPhrase()
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
     * @covers \Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \Vipps\Exceptions\VippsException::getPhrase()
     * @covers \Vipps\Exceptions\VippsException::__construct()
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
     * @covers \Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \Vipps\Exceptions\VippsException::getPhrase()
     * @covers \Vipps\Exceptions\VippsException::getError()
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
     * @covers \Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \Vipps\Exceptions\VippsException::getPhrase()
     * @covers \Vipps\Exceptions\VippsException::getError()
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
     * @covers \Vipps\Exceptions\VippsException::createFromResponse()
     * @covers \Vipps\Exceptions\VippsException::getPhrase()
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
