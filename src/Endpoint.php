<?php

/**
 * Connection base class.
 *
 * Abstract connection base class.
 */

namespace zaporylie\Vipps;

use Eloquent\Enumeration\AbstractMultiton;
use Http\Discovery\UriFactoryDiscovery;

/**
 * Class ConnectionBase
 * @package Vipps
 * @subpackage Connection
 */
class Endpoint extends AbstractMultiton implements EndpointInterface
{

    protected static $live = [
        'scheme' => 'https',
        'host' => 'api.vipps.no',
        'port' => '443',
        'path' => '',
    ];

    protected static $test = [
        'scheme' => 'https',
        'host' => 'apitest.vipps.no',
        'port' => '443',
        'path' => '',
    ];

    protected $scheme;
    protected $host;
    protected $port;
    protected $path;

    /**
     * {@inheritdoc}
     */
    protected static function initializeMembers()
    {
        $reflectionClass = new \ReflectionClass(self::class);
        foreach ($reflectionClass->getStaticProperties() as $staticPropertyName => $staticPropertyValue) {
            new static(
                $staticPropertyName,
                $staticPropertyValue['scheme'],
                $staticPropertyValue['host'],
                $staticPropertyValue['port'],
                $staticPropertyValue['path']
            );
        }
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
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri()
    {
        $uri = UriFactoryDiscovery::find();
        return $uri->createUri(sprintf(
            '%s://%s:%s%s',
            $this->getScheme(),
            $this->getHost(),
            $this->getPort(),
            $this->getPath()
        ));
    }
}
