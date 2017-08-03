<?php

/**
 * Connection interface.
 *
 * Interface which defines connections.
 */

namespace zaporylie\Vipps;

/**
 * Interface ConnectionInterface
 * @package Vipps
 * @subpackage Connection
 */
interface EndpointInterface
{

    /**
     * @return string
     */
    public function getScheme();

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return string
     */
    public function getPort();

    /**
     * @return string
     */
    public function getPath();

    /**
     * Returns base URI for requests against VIPPS servers.
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri();
}
