<?php

namespace Vipps\Api;

use Vipps\Model\Authorization\RequestGetToken;
use Vipps\Resource\Authorization\GetToken;

class Authorization extends ApiBase implements AuthorizationInterface
{

    /**
     * {@inheritdoc}
     *
     * @return \Vipps\Model\Authorization\ResponseGetToken
     */
    public function getToken($client_id, $client_secret)
    {
        $resource = new GetToken($this->app, $client_id, $client_secret);
        /** @var \Vipps\Model\Authorization\ResponseGetToken $response */
        $response = parent::doRequest($resource);
        // Save token in client.
        $this->app->getClient()->setToken($response->getAccessToken())->setTokenType($response->getTokenType());
        return $response;
    }
}
