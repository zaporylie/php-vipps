<?php

namespace Vipps;

use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;

class Client
{

    /**
     * @var \Http\Client\HttpClient|\Http\Client\HttpAsyncClient
     */
    protected $httpClient;

    /**
     * @var \Vipps\EndpointInterface
     */
    protected $endpoint;

    /**
     * @var \Http\Message\MessageFactory
     */
    protected $messageFactory;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * @var string
     */
    protected $subscriptionKey;

    /**
     * VippsClient constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $this->setHttpClient(isset($options['http_client']) ? $options['http_client'] : null);
        if (isset($options['endpoint'])) {
            $this->setEndpoint(call_user_func([
                '\\Vipps\\Endpoint',
                $options['endpoint']
            ]));
        } else {
            $this->setEndpoint(Endpoint::test());
        }
        $this->setClientId(isset($options['client_id']) ? $options['client_id'] : null);
        $this->setClientSecret(isset($options['client_secret']) ? $options['client_secret'] : null);
        $this->setSubscriptionKey(isset($options['subscription_key']) ? $options['subscription_key'] : null);
    }

    /**
     * Gets clientId value.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Sets clientId variable.
     *
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * Gets clientSecret value.
     *
     * @return string
     */
    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    /**
     * Sets clientSecret variable.
     *
     * @param string $clientSecret
     *
     * @return $this
     */
    public function setClientSecret($clientSecret)
    {
        $this->clientSecret = $clientSecret;
        return $this;
    }

    /**
     * Gets subscriptionKey value.
     *
     * @return string
     */
    public function getSubscriptionKey()
    {
        return $this->subscriptionKey;
    }

    /**
     * Sets subscriptionKey variable.
     *
     * @param string $subscriptionKey
     *
     * @return $this
     */
    public function setSubscriptionKey($subscriptionKey)
    {
        $this->subscriptionKey = $subscriptionKey;
        return $this;
    }

    /**
     * Gets connection value.
     *
     * @return \Vipps\EndpointInterface
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Sets connection variable.
     *
     * @param \Vipps\EndpointInterface $endpoint
     *
     * @return $this
     */
    public function setEndpoint(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * Gets httpClient value.
     *
     * @return \Http\Client\HttpAsyncClient|\Http\Client\HttpClient
     */
    public function getHttpClient()
    {
        return $this->httpClient;
    }

    /**
     * Sets httpClient variable.
     *
     * @param \Http\Client\HttpAsyncClient|\Http\Client\HttpClient $httpClient
     *
     * @return $this
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = self::httpClientDiscovery($httpClient);
        unset($this->messageFactory);
        return $this;
    }

    /**
     * Gets messageFactory value.
     *
     * @return \Http\Message\MessageFactory
     */
    public function getMessageFactory()
    {
        if (!isset($this->messageFactory)) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }
        return $this->messageFactory;
    }

    /**
     * Use this static method to get default HTTP Client.
     *
     * @param null|\Http\Client\HttpClient|\Http\Client\HttpAsyncClient $client
     *
     * @return \Http\Client\HttpClient|\Http\Client\HttpAsyncClient
     */
    public static function httpClientDiscovery($client = null)
    {
        if (isset($client) && ($client instanceof HttpAsyncClient || $client instanceof HttpClient)) {
            return $client;
        } elseif (isset($client)) {
            throw new \LogicException(sprintf(
                'HttpClient must be instance of "%s" or "%s"',
                HttpClient::class,
                HttpAsyncClient::class
            ));
        }
        return HttpClientDiscovery::find();
    }
}
