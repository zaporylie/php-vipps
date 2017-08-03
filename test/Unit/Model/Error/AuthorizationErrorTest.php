<?php

namespace zaporylie\Vipps\Tests\Unit\Model\Error;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use zaporylie\Vipps\Model\Authorization\ResponseGetToken;
use zaporylie\Vipps\Model\Error\AuthorizationError;
use zaporylie\Vipps\Tests\Unit\Model\ModelTestBase;

class AuthorizationErrorTest extends ModelTestBase
{

    /**
     * @var \zaporylie\Vipps\Model\Error\AuthorizationError
     */
    protected $response;

    /**
     * {@inheritdoc}
     */
    public function setUp()
    {
        parent::setUp();
        AnnotationRegistry::registerLoader('class_exists');
        $serializer = SerializerBuilder::create()->build();
        $this->response = $serializer->deserialize(
            json_encode([
                'error' => 'test_error',
                'error_description' => 'test_error_description',
                'error_codes' => [
                    1000
                ],
                'timestamp' => (new \DateTime())->format('Y-m-d H:i:s\Z'),
                'trace_id' => 'test_trace_id',
                'correlation_id' => 'test_correlation_id',
            ]),
            AuthorizationError::class,
            'json'
        );
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getError()
     */
    public function testGetError()
    {
        $this->assertEquals('test_error', $this->response->getError());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getErrorDescription()
     */
    public function testGetErrorDescription()
    {
        $this->assertEquals('test_error_description', $this->response->getErrorDescription());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getErrorCodes()
     */
    public function testGetErrorCodes()
    {
        $this->assertEquals(1000, $this->response->getErrorCodes()[0]);
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getTimestamp()
     */
    public function testTimestamp()
    {
        $this->assertInstanceOf(\DateTimeInterface::class, $this->response->getTimestamp());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getTraceId()
     */
    public function testGetTraceId()
    {
        $this->assertEquals('test_trace_id', $this->response->getTraceId());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getCorrelationId()
     */
    public function testGetCorrelationId()
    {
        $this->assertEquals('test_correlation_id', $this->response->getCorrelationId());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getCode()
     */
    public function testGetCode()
    {
        $this->assertEquals('1000', $this->response->getCode());
    }

    /**
     * @covers \zaporylie\Vipps\Model\Error\AuthorizationError::getMessage()
     */
    public function testGetMessage()
    {
        $this->assertEquals('test_error_description', $this->response->getMessage());
    }
}
