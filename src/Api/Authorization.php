<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\Authorization\ResponseGetToken;
use zaporylie\Vipps\Resource\Authorization\GetToken;

class Authorization extends ApiBase implements AuthorizationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getToken($client_secret): ResponseGetToken
    {
        // Initiate GetToken resource.
        $resource = new GetToken($this->app, $this->getSubscriptionKey(), $client_secret);

        /** @var \zaporylie\Vipps\Model\Authorization\ResponseGetToken $response */
        $response = $resource->call();

        // Save token on Client for future use.
        $this->app->getClient()->getTokenStorage()->set($response);

        return $response;
    }
}
