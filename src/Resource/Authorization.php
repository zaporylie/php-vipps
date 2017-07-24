<?php

namespace Vipps\Resource;

class Authorization extends ResourceBase
{

    /**
     * @return string
     */
    public function getResourcePath()
    {
        return '/accessToken';
    }

    /**
     * @param $clientId
     * @param $clientSecret
     * @param $subscriptionKey
     */
    public function getToken($clientId, $clientSecret, $subscriptionKey)
    {
        $this->request(
            $this,
            'POST',
            'get'
        );
    }
}
