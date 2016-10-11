<?php

namespace Vipps\Resources;

interface ResourceInterface
{
    /**
     * Return URI for resource. Path should start with trailing slash.
     *
     * @return mixed
     */
    public function getResourcePath();
}
