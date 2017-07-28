<?php

namespace Vipps;

use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Vipps\Exceptions\Client\InvalidArgumentException;

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
    protected $token;

    /**
     * @var string
     */
    protected $tokenType;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * VippsClient constructor.
     *
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        // Set or autodiscover http client.
        $this->setHttpClient(isset($options['http_client']) ? $options['http_client'] : null);

        // Set endpoint or use default test one.
        if (isset($options['endpoint'])) {
            $this->setEndpoint(call_user_func([
                '\\Vipps\\Endpoint',
                $options['endpoint']
            ]));
        } else {
            $this->setEndpoint(Endpoint::test());
        }

        // Set token.
        $this->setToken(isset($options['token']) ? $options['token'] : null);
        $this->setTokenType(isset($options['token_type']) ? $options['token_type'] : null);

        // Set client ID.
        $this->setClientId(isset($options['client_id']) ? $options['client_id'] : null);
    }

    /**
     * Gets token value.
     *
     * @return string
     */
    public function getToken()
    {
        if (!isset($this->token)) {
            throw new InvalidArgumentException('Missing Token');
        }
        return $this->token;
    }

    /**
     * Sets token variable.
     *
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * Gets tokenType value.
     *
     * @return string
     */
    public function getTokenType()
    {
        if (!isset($this->tokenType)) {
            throw new InvalidArgumentException('Missing Token Type');
        }
        return $this->tokenType;
    }

    /**
     * Sets tokenType variable.
     *
     * @param string $tokenType
     *
     * @return $this
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;
        return $this;
    }

    /**
     * Gets clientId value.
     *
     * @return string
     */
    public function getClientId()
    {
        if (!isset($this->clientId)) {
            throw new InvalidArgumentException('Missing Client ID');
        }
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
