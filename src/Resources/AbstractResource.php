<?php

namespace Vipps\Resources;

use Vipps\Vipps;

abstract class AbstractResource
{

    /**
     * @var Vipps
     */
    protected $vipps;

    /**
     * AbstractResource constructor.
     *
     * @param Vipps $vipps
     */
    public function __construct(Vipps $vipps)
    {
        $this->vipps = $vipps;
    }
}
