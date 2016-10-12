<?php

namespace Vipps\Connection;

/**
 * Class Live
 * @package Vipps\Connection
 */
class Live extends AbstractConnection implements ConnectionInterface
{
    /**
     * @var string
     */
    protected $scheme = 'https';
    /**
     * @var string
     */
    protected $host = 'gw.dnbnor.no';
    /**
     * @var string
     */
    protected $port = '1447';
    /**
     * @var string
     */
    protected $path = '/vipps';
}
