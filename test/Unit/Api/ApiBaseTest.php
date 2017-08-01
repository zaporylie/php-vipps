<?php

namespace Vipps\Tests\Unit\Api;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Vipps\Api\ApiBase;
use Vipps\Client;
use Vipps\Exceptions\Api\InvalidArgumentException;
use Vipps\Resource\ResourceInterface;
use Vipps\Vipps;

class ApiBaseTest extends TestCase
{

    /**
     * @var \Vipps\Api\ApiBase
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
     * @covers \Vipps\Api\ApiBase::getSubscriptionKey()
     * @covers \Vipps\Api\ApiBase::setSubscriptionKey()
     * @covers \Vipps\Api\ApiBase::__construct()
     */
    public function testSubscriptionKey()
    {
        $this->assertEquals('test_subscription_key', $this->apiBase->getSubscriptionKey());
        $this->assertInstanceOf(ApiBase::class, $this->apiBase->setSubscriptionKey(null));
        $this->expectException(InvalidArgumentException::class);
        $this->apiBase->getSubscriptionKey();
    }
}
