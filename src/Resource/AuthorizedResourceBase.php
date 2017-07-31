<?php

namespace Vipps\Resource;

use Vipps\VippsInterface;

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
    public function __construct(VippsInterface $vipps)
    {
        parent::__construct($vipps);
        $this->headers['Authorization'] =
                $this->app->getClient()->getTokenType()
                .' '.
                $this->app->getClient()->getToken();
    }
}
