<?php

namespace zaporylie\Vipps\Tests\Unit\Authentication;

use zaporylie\Vipps\Authentication\TokenMemoryCacheStorage;
use zaporylie\Vipps\Model\Authorization\ResponseGetToken;

class TestTokenStorage extends TokenMemoryCacheStorage
{
    public function get()
    {
        $token = new ResponseGetToken();

        // Create reflection class.
        $reflectionClass = new \ReflectionClass($token);

        // Set access token value.
        $accessToken = $reflectionClass->getProperty('accessToken');
        $accessToken->setAccessible(true);
        $accessToken->setValue($token, 'test_access_token');

        // Set access token value.
        $tokenType = $reflectionClass->getProperty('tokenType');
        $tokenType->setAccessible(true);
        $tokenType->setValue($token, 'test_token_type');

        return $token;
    }
}
