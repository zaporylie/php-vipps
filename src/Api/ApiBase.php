<?php

namespace Vipps\Api;

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
}
