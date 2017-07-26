<?php

namespace Vipps\Resource;

abstract class AuthorizedResourceBase extends ResourceBase
{

    /**
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return parent::getHeaders() + [
            'Authorization' => $this->app->getClient()->getTokenType().' '.$this->app->getClient()->getToken(),
        ];
    }
}
