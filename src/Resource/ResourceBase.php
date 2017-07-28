<?php

/**
 * Resource base class.
 *
 * Abstract resource base class.
 */

namespace Vipps\Resource;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\RequestInterface;
use Vipps\Exceptions\ViPPSErrorException;
use Vipps\Exceptions\VippsException;
use Vipps\VippsInterface;

/**
 * Class ResourceBase
 * @package Vipps\Resources
 */
abstract class ResourceBase implements ResourceInterface
{

    /**
     * @var VippsInterface
     */
    protected $app;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $body = '';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     * AbstractResource constructor.
     *
     * @param VippsInterface $vipps
     */
    public function __construct(VippsInterface $vipps)
    {
        $this->app = $vipps;

        // Initiate serializer.
        AnnotationRegistry::registerLoader('class_exists');
        $this->serializer = SerializerBuilder::create()
            ->build();
    }

    /**
     * Gets serializer value.
     *
     * @return \JMS\Serializer\Serializer
     */
    public function getSerializer()
    {
        return $this->serializer;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return \Vipps\Resource\HttpMethod
     * @throws \LogicException
     */
    public function getMethod()
    {
        if (!isset($this->method)) {
            throw new \LogicException('Missing HTTP method');
        }
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        if (!isset($this->path)) {
            throw new \LogicException('Missing resource path');
        }
        // Get local var.
        $path = $this->path;
        // If ID is set replace {id} pattern with model's ID.
        if (isset($this->id)) {
            $path = str_replace('{id}', $this->id, $path);
        }
        return $path;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param $path
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri($path)
    {
        return $this->app->getClient()->getEndpoint()->getUri()->withPath($path);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Vipps\Exceptions\VippsException
     */
    public function call()
    {
        $request = $this->app->getClient()->getMessageFactory()->createRequest(
            $this->getMethod(),
            $this->getUri($this->getPath()),
            $this->getHeaders(),
            $this->getBody()
        );
        $response = $this->app->getClient()->getHttpClient()->sendRequest($request);
        // @todo: Handle response.

        if ($response->getStatusCode() >= 400 && $response->getStatusCode() < 500) {
            $error = $response->getBody()->getContents();
            throw new VippsException($error, $response->getStatusCode());
        }
        elseif ($response->getStatusCode() >= 500 && $response->getStatusCode() < 600) {
            throw new VippsException($response->getReasonPhrase(), $response->getStatusCode());
        }

        return $response;
    }

}
