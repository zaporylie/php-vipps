<?php

/**
 * Resource base class.
 *
 * Abstract resource base class.
 */

namespace zaporylie\Vipps\Resource;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Http\Client\Exception\HttpException;
use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\RequestInterface;
use zaporylie\Vipps\Exceptions\VippsException;
use zaporylie\Vipps\VippsInterface;

/**
 * Class ResourceBase
 * @package Vipps\Resources
 */
abstract class ResourceBase implements ResourceInterface, SerializableInterface
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
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method;

    /**
     * @var \JMS\Serializer\Serializer
     */
    protected $serializer;

    /**
     * AbstractResource constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
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
     * @throws \zaporylie\Vipps\Exceptions\VippsException
     */
    protected function makeCall()
    {
        try {
            $request = $this->getRequest();
            $response = $this->handleRequest($request);
        } catch (HttpException $e) {
            // Catch exceptions thrown by http client.
            // We must do that in order to normalize output.
            $response = $e->getResponse();
        } catch (\Exception $e) {
            // Something went really bad here.
            throw new VippsException($e->getMessage(), $e->getCode(), $e);
        }
        return $this->handleResponse($response);
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function handleRequest(RequestInterface $request)
    {
        // Get client.
        $client = $this->app->getClient()->getHttpClient();

        // Handle requests, sync precedence.
        if ($client instanceof HttpClient) {
            // Send sync request.
            $response = $client->sendRequest($request);
        } elseif ($client instanceof HttpAsyncClient) {
            // Send async request.
            $response = $client->sendAsyncRequest($request)->wait();
        } else {
            throw new \LogicException('Unknown HTTP Client type: '. implode(',', class_implements($client)));
        }

        return $response;
    }

    /**
     * @return \Psr\Http\Message\RequestInterface
     */
    protected function getRequest()
    {
        return $this->app->getClient()->getMessageFactory()->createRequest(
            $this->getMethod(),
            $this->getUri($this->getPath()),
            $this->getHeaders(),
            $this->getBody()
        );
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \zaporylie\Vipps\Exceptions\VippsException
     */
    protected function handleResponse($response)
    {
        // Handle request errors.
        if ($response->getStatusCode() >= 400) {
            throw VippsException::createFromResponse($response, $this->getSerializer());
        }

        // Sometimes VIPPS returns 200 with error message :/ They promised
        // to fix it but as a temporary fix we are gonna check if body is
        // "invalid" and throw exception in such a case.
        $exception = VippsException::createFromResponse($response, $this->getSerializer(), false);
        if ($exception instanceof VippsException) {
            throw $exception;
        }

        return $response;
    }
}
