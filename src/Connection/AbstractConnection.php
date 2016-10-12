<?php

namespace Vipps\Connection;

abstract class AbstractConnection
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
     * {@inheritdoc}
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
