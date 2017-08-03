<?php

namespace zaporylie\Vipps\Tests\Unit\Resource;

use zaporylie\Vipps\Resource\AuthorizedResourceBase;

class AuthorizedResourceBaseTest extends ResourceTestBase
{

    /**
     * @covers \zaporylie\Vipps\Resource\AuthorizedResourceBase::__construct()
     */
    public function testAuthorizationHeader()
    {
        /** @var \zaporylie\Vipps\Resource\AuthorizedResourceBase $authorized */
        $authorized = $this->getMockForAbstractClass(AuthorizedResourceBase::class, [
            $this->vipps,
            'test_subscription_key'
        ]);
        $this->assertArrayHasKey('Authorization', $authorized->getHeaders());
        $this->assertEquals('test_token_type test_access_token', $authorized->getHeaders()['Authorization']);
    }
}
