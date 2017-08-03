<?php

namespace zaporylie\Vipps;

use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use zaporylie\Vipps\Authentication\TokenMemoryCacheStorage;
use zaporylie\Vipps\Authentication\TokenStorageInterface;
use zaporylie\Vipps\Exceptions\Client\InvalidArgumentException;

class Client implements ClientInterface
{

    /**
     * @var \Http\Client\HttpClient|\Http\Client\HttpAsyncClient
     */
    protected $httpClient;

    /**
     * @var \zaporylie\Vipps\EndpointInterface
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
     * @var \zaporylie\Vipps\Authentication\TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @var string
     */
    protected $clientId;

    /**
     * VippsClient constructor.
     *
     * @param string $client_id
     * @param array $options
     */
    public function __construct($client_id, array $options = [])
    {
        // Set Client ID.
        $this->setClientId($client_id);

        // Set or discover http client.
        $this->setHttpClient(isset($options['http_client']) ? $options['http_client'] : null);

        // Set endpoint or use default one.
        if (isset($options['endpoint'])) {
            $this->setEndpoint(call_user_func([
                Endpoint::class,
                $options['endpoint']
            ]));
        } else {
            $this->setEndpoint(Endpoint::test());
        }

        // Set custom token storage. If option is missing default in-memory
        // storage will be in use.
        $this->setTokenStorage(
            isset($options['token_storage'])
                ? $options['token_storage']
                : new TokenMemoryCacheStorage()
        );
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
     * Gets tokenStorage value.
     *
     * @return \zaporylie\Vipps\Authentication\TokenStorageInterface
     */
    public function getTokenStorage()
    {
        return $this->tokenStorage;
    }

    /**
     * Sets tokenStorage variable.
     *
     * @param \zaporylie\Vipps\Authentication\TokenStorageInterface $tokenStorage
     *
     * @return $this
     */
    public function setTokenStorage(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
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
     * @return \zaporylie\Vipps\EndpointInterface
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Sets connection variable.
     *
     * @param \zaporylie\Vipps\EndpointInterface $endpoint
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
    protected function httpClientDiscovery($client = null)
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
