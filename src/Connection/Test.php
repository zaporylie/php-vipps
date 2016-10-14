<?php

/**
 * Live connection.
 *
 * Implements ConnectionInterface with live environment data.
 */

namespace Vipps\Connection;

/**
 * Class Test
 * @package Vipps\Connection
 */
class Test extends ConnectionBase implements ConnectionInterface
{
    /**
     * @var string
     */
    protected $scheme = 'https';
    /**
     * @var string
     */
    protected $host = 'gw.atest.dnbnor.no';
    /**
     * @var string
     */
    protected $port = '1447';
    /**
     * @var string
     */
    protected $path = '/vipps';
}
