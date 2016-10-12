<?php

namespace Vipps\Connection;

interface ConnectionInterface
{

    /**
     * Returns base URI for requests against VIPPS servers.
     *
     * @return string
     */
    public function getUri();
}
