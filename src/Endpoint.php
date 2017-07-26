<?php

/**
 * Connection base class.
 *
 * Abstract connection base class.
 */

namespace Vipps\Endpoint;

use Eloquent\Enumeration\AbstractMultiton;

/**
 * Class ConnectionBase
 * @package Vipps
 * @subpackage Connection
 */
class Endpoint extends AbstractMultiton implements EndpointInterface
{

    protected static $live = [
        'scheme' => 'https',
        'host' => '',
        'port' => '',
        'path' => '',
    ];

    protected static $test = [
        'scheme' => 'https',
        'host' => 'apitest.vipps.no',
        'port' => '80',
        'path' => '',
    ];

    protected $scheme;
    protected $host;
    protected $port;
    protected $path;

    protected static function initializeMembers()
    {
        $reflectionClass = new \ReflectionClass(self::class);
        foreach ($reflectionClass->getStaticProperties() as $staticPropertyName => $staticPropertyValue) {
            new static(
                $staticPropertyName,
                $staticPropertyValue['schema'],
                $staticPropertyValue['host'],
                $staticPropertyValue['port'],
                $staticPropertyValue['path']
            );
        }
//        new static('test', 'https', 'apitest.vipps.no', '80', '');
//        new static('live', '', '', '', '');
    }

    protected function __construct($key, $scheme, $host, $port, $path)
    {
        parent::__construct($key);
        $this->scheme = $scheme;
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
    }

    /**
     * Gets scheme value.
     *
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * Gets host value.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Gets port value.
     *
     * @return string
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Gets path value.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Get connection base uri.
     *
     * @return string
     */
    public function getUri()
    {
        return sprintf(
            '%s://%s:%s%s',
            $this->getScheme(),
            $this->getHost(),
            $this->getPort(),
            $this->getPath()
        );
    }
}
