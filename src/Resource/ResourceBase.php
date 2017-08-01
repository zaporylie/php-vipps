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
     * @var string
     */
    protected $path;

    /**
     * @var \Vipps\Resource\HttpMethod
     */
    protected $method;

    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     * AbstractResource constructor.
     *
     * @param \Vipps\VippsInterface $vipps
     * @param string $subscription_key
     */
    public function __construct(VippsInterface $vipps, $subscription_key)
    {
        $this->app = $vipps;

        $this->headers['Ocp-Apim-Subscription-Key'] = $subscription_key;

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
     * {@inheritdoc}
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod()
    {
        if (!isset($this->method)) {
            throw new \LogicException('Missing HTTP method');
        }
        return $this->method;
    }

    /**
     * {@inheritdoc}
     *
     * All occurrences of {id} pattern will be replaced with $this->id
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
    protected function makeCall()
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
        } elseif ($response->getStatusCode() >= 500 && $response->getStatusCode() < 600) {
            throw new VippsException($response->getReasonPhrase(), $response->getStatusCode());
        }

        return $response;
    }
}
