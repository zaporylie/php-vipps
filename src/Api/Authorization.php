<?php

namespace Vipps\Api;

use Vipps\Resource\Authorization\GetToken;

class Authorization extends ApiBase implements AuthorizationInterface
{

    /**
     * {@inheritdoc}
     *
     * @return \Vipps\Model\Authorization\ResponseGetToken
     */
    public function getToken($client_secret)
    {
        // Initiate GetToken resource.
        $resource = new GetToken($this->app, $this->getSubscriptionKey(), $client_secret);

        /** @var \Vipps\Model\Authorization\ResponseGetToken $response */
        $response = parent::doRequest($resource);

        // Save token on Client for future use.
        $this->app->getClient()->setToken($response->getAccessToken())->setTokenType($response->getTokenType());

        return $response;
    }
}
