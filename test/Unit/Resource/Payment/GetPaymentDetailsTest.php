<?php

namespace zaporylie\Vipps\Tests\Unit\Resource\Payment;

use GuzzleHttp\Psr7\Response;
use zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails;
use zaporylie\Vipps\Resource\Payment\GetPaymentDetails;
use zaporylie\Vipps\Resource\HttpMethod;

class GetPaymentDetailsTest extends PaymentResourceBaseTestBase
{

    /**
     * @var \zaporylie\Vipps\Resource\Payment\GetPaymentDetails
     */
    protected $resource;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        parent::setUp(); // TODO: Change the autogenerated stub
        $this->resource = $this->getMockBuilder(GetPaymentDetails::class)
            ->setConstructorArgs([
                $this->vipps,
                'test_subscription_key',
                'test_order_id'
            ])
            ->disallowMockingUnknownTypes()
            ->setMethods(['makeCall'])
            ->getMock();

        $this->resource
            ->expects($this->any())
            ->method('makeCall')
            ->will($this->returnValue(new Response(200, [], \GuzzleHttp\Psr7\Utils::streamFor(json_encode([])))));
    }

    /**
     * @covers \zaporylie\Vipps\Resource\Payment\GetPaymentDetails::getBody()
     * @covers \zaporylie\Vipps\Resource\Payment\GetPaymentDetails::__construct()
     */
    public function testBody()
    {
        $this->assertEmpty($this->resource->getBody());
    }

    /**
     * @covers \zaporylie\Vipps\Resource\Payment\GetPaymentDetails::getMethod()
     */
    public function testMethod()
    {
        $this->assertEquals(HttpMethod::GET, $this->resource->getMethod());
    }

    /**
     * @covers \zaporylie\Vipps\Resource\Payment\GetPaymentDetails::getPath()
     */
    public function testPath()
    {
        $this->assertEquals(
            '/ecomm/v2/payments/test_order_id/details',
            $this->resource->getPath()
        );
        $this->getStringReplace();
        $this->assertEquals(
            '/test_path/v2/payments/test_order_id/details',
            $this->resource->getPath()
        );
    }

    /**
     * @covers \zaporylie\Vipps\Resource\Payment\GetPaymentDetails::call()
     */
    public function testCall()
    {
        $this->assertInstanceOf(ResponseGetPaymentDetails::class, $response = $this->resource->call());
        $this->assertEquals(new ResponseGetPaymentDetails(), $response);
    }
}
