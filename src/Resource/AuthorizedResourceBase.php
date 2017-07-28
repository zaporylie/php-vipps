<?php

namespace Vipps\Resource;

use Vipps\VippsInterface;

abstract class AuthorizedResourceBase extends ResourceBase
{

    public function __construct(\Vipps\VippsInterface $vipps)
    {
        parent::__construct($vipps);
        $this->headers['Authorization'] = $this->app->getClient()->getTokenType().' '.$this->app->getClient()->getToken();
    }
}
