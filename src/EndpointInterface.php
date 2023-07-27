<?php

/**
 * Connection interface.
 *
 * Interface which defines connections.
 */

namespace zaporylie\Vipps;

use Psr\Http\Message\UriInterface;

/**
 * Interface ConnectionInterface
 *
 * @package Vipps
 * @subpackage Connection
 */
interface EndpointInterface
{

    /**
     * @return string
     */
    public function getScheme(): string;

    /**
     * @return string
     */
    public function getHost(): string;

    /**
     * @return string
     */
    public function getPort(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * Returns base URI for requests against VIPPS servers.
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri(): UriInterface;
}
