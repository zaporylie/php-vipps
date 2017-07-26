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
        return parent::doRequest($resource);
    }
}
