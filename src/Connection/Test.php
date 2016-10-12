<?php

namespace Vipps\Connection;

class Test extends AbstractConnection implements ConnectionInterface
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
