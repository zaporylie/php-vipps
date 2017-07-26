<?php

namespace Vipps\Api;

use Vipps\Resource\ResourceInterface;
use Vipps\VippsInterface;

abstract class ApiBase
{

    /**
     * @var \Vipps\VippsInterface
     */
    protected $app;

    /**
     * ApiBase constructor.
     *
     * @param \Vipps\VippsInterface $app
     */
    public function __construct(VippsInterface $app)
    {
        $this->app = $app;
    }

    /**
     * @param \Vipps\Resource\ResourceInterface $resource
     *
     * @return mixed
     */
    protected function doRequest(ResourceInterface $resource)
    {
        return $resource->call();
    }
}
