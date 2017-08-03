<?php

namespace zaporylie\Vipps\Tests\Unit\Api;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use zaporylie\Vipps\Api\ApiBase;
use zaporylie\Vipps\Client;
use zaporylie\Vipps\Exceptions\Api\InvalidArgumentException;
use zaporylie\Vipps\Resource\ResourceInterface;
use zaporylie\Vipps\Vipps;

class ApiBaseTest extends TestCase
{

    /**
     * @var \zaporylie\Vipps\Api\ApiBase
     */
    protected $apiBase;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();
        $this->apiBase = $this->getMockForAbstractClass(ApiBase::class, [
            new Vipps(new Client('test')),
            'test_subscription_key'
        ]);
    }

    /**
     * @covers \zaporylie\Vipps\Api\ApiBase::getSubscriptionKey()
     * @covers \zaporylie\Vipps\Api\ApiBase::setSubscriptionKey()
     * @covers \zaporylie\Vipps\Api\ApiBase::__construct()
     */
    public function testSubscriptionKey()
    {
        $this->assertEquals('test_subscription_key', $this->apiBase->getSubscriptionKey());
        $this->assertInstanceOf(ApiBase::class, $this->apiBase->setSubscriptionKey(null));
        $this->expectException(InvalidArgumentException::class);
        $this->apiBase->getSubscriptionKey();
    }
}
