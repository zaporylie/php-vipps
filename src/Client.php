<?php

namespace zaporylie\Vipps;

use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface as HttpClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use zaporylie\Vipps\Authentication\TokenMemoryCacheStorage;
use zaporylie\Vipps\Authentication\TokenStorageInterface;
use zaporylie\Vipps\Exceptions\Client\InvalidArgumentException;

class Client implements ClientInterface
{

    /**
     * @var \Psr\Http\Client\ClientInterface
     */
    protected $httpClient;

    /**
     * @var \zaporylie\Vipps\EndpointInterface
     */
    protected $endpoint;

    /**
     * @var \Psr\Http\Message\RequestFactoryInterface
     */
    protected $requestFactory;

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
     * {@inheritdoc}
     */
    public function getEndpoint(): EndpointInterface
    {
        return $this->endpoint;
    }

    /**
     * {@inheritdoc}
     */
    public function setEndpoint(EndpointInterface $endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getHttpClient(): HttpClientInterface
    {
        return $this->httpClient;
    }

    /**
     * {@inheritdoc}
     */
    public function setHttpClient(?HttpClientInterface $httpClient)
    {
        $this->httpClient = self::httpClientDiscovery($httpClient);
        unset($this->requestFactory);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestFactory(): RequestFactoryInterface
    {
        if (!isset($this->requestFactory)) {
            $this->requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        }
        return $this->requestFactory;
    }

    /**
     * Use this static method to get default HTTP Client.
     *
     * @param \Psr\Http\Client\ClientInterface|null $client
     *
     * @return \Psr\Http\Client\ClientInterface
     */
    protected function httpClientDiscovery(?HttpClientInterface $client = null) : HttpClientInterface
    {
        if (isset($client)) {
            return $client;
        }
        return Psr18ClientDiscovery::find();
    }
}
