<?php

namespace zaporylie\Vipps\Resource;

use zaporylie\Vipps\VippsInterface;

/**
 * Class AuthorizedResourceBase
 *
 * @package Vipps\Resource
 */
abstract class AuthorizedResourceBase extends ResourceBase
{

    /**
     * {@inheritdoc}
     *
     * In addition to setting Vipps this base class adds authorization header
     * to each request.
     */
    public function __construct(VippsInterface $vipps, $subscription_key)
    {
        parent::__construct($vipps, $subscription_key);
        $this->headers['Authorization'] =
                $this->app->getClient()->getTokenStorage()->get()->getTokenType()
                .' '.
                $this->app->getClient()->getTokenStorage()->get()->getAccessToken();
    }
}
