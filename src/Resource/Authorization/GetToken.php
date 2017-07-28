<?php

namespace Vipps\Resource\Authorization;

use Vipps\Resource\ResourceBase;
use Vipps\Resource\HttpMethod;
use Vipps\VippsInterface;

class GetToken extends ResourceBase
{

    /**
     * @var \Vipps\Resource\HttpMethod;
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/accessToken/get';

    /**
     * GetToken constructor.
     *
     * @param \Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $client_secret
     */
    public function __construct(VippsInterface $vipps, $subscription_key, $client_secret)
    {
        parent::__construct($vipps);
        $this->headers['Ocp-Apim-Subscription-Key'] = $subscription_key;
        $this->headers['client_id'] = $this->app->getClient()->getClientId();
        $this->headers['client_secret'] = $client_secret;
    }

    /**
     * @return \Vipps\Model\Authorization\ResponseGetToken
     */
    public function call()
    {
        $response = parent::call();
        /** \Vipps\Model\Authorization\ResponseGetToken */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $response->getBody()->getContents(),
                'Vipps\Model\Authorization\ResponseGetToken',
                'json'
            );

        return $responseObject;
    }
}
