<?php

/**
 * Connection interface.
 *
 * Interface which defines connections.
 */

namespace Vipps\Connection;

/**
 * Interface ConnectionInterface
 * @package Vipps
 * @subpackage Connection
 */
interface ConnectionInterface
{

    /**
     * Returns base URI for requests against VIPPS servers.
     *
     * @return string
     */
    public function getUri();
}
