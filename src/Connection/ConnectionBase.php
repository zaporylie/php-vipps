<?php

/**
 * Connection base class.
 *
 * Abstract connection base class.
 */

namespace Vipps\Connection;

/**
 * Class ConnectionBase
 * @package Vipps
 * @subpackage Connection
 */
abstract class ConnectionBase
{

    /**
     * @var string
     */
    protected $scheme;

    /**
     * @var string
     */
    protected $host;

    /**
     * @var string
     */
    protected $port;

    /**
     * @var string
     */
    protected $path;

    /**
     * Get connection base uri.
     *
     * @return string
     */
    public function getUri()
    {
        return sprintf(
            '%s://%s:%s%s',
            $this->scheme,
            $this->host,
            $this->port,
            $this->path
        );
    }
}
