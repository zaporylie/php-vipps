<?php

/**
 * Connection base class.
 *
 * Abstract connection base class.
 */

namespace zaporylie\Vipps;

use Eloquent\Enumeration\AbstractMultiton;
use Http\Discovery\Psr17FactoryDiscovery;
use Psr\Http\Message\UriInterface;

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

    protected string $scheme;
    protected string $host;
    protected string $port;
    protected string $path;

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
     * {@inheritdoc}
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }

    /**
     * {@inheritdoc}
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * {@inheritdoc}
     */
    public function getPort(): string
    {
        return $this->port;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function getUri(): UriInterface
    {
        $uri = Psr17FactoryDiscovery::findUriFactory();
        return $uri->createUri(sprintf(
            '%s://%s:%s%s',
            $this->getScheme(),
            $this->getHost(),
            $this->getPort(),
            $this->getPath()
        ));
    }
}
