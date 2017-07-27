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
     * @param string $client_id
     * @param string $client_secret
     */
    public function __construct(VippsInterface $vipps, $client_id, $client_secret)
    {
        parent::__construct($vipps);
        $this->headers['client_id'] = $client_id;
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
            ->app
            ->getSerializer()
            ->deserialize(
                $response->getBody()->getContents(),
                'Vipps\Model\Authorization\ResponseGetToken',
                'json'
            );

        return $responseObject;
    }
}
