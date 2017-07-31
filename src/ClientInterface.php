<?php

namespace Vipps;

interface ClientInterface
{

    /**
     * Gets token value.
     *
     * @return string
     */
    public function getToken();

    /**
     * Sets token variable.
     *
     * @param string $token
     *
     * @return $this
     */
    public function setToken($token);

    /**
     * Gets tokenType value.
     *
     * @return string
     */
    public function getTokenType();

    /**
     * Sets tokenType variable.
     *
     * @param string $tokenType
     *
     * @return $this
     */
    public function setTokenType($tokenType);

    /**
     * Gets clientId value.
     *
     * @return string
     */
    public function getClientId();

    /**
     * Sets clientId variable.
     *
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId($clientId);

    /**
     * Gets connection value.
     *
     * @return \Vipps\EndpointInterface
     */
    public function getEndpoint();

    /**
     * Sets connection variable.
     *
     * @param \Vipps\EndpointInterface $endpoint
     *
     * @return $this
     */
    public function setEndpoint(EndpointInterface $endpoint);

    /**
     * Gets httpClient value.
     *
     * @return \Http\Client\HttpAsyncClient|\Http\Client\HttpClient
     */
    public function getHttpClient();

    /**
     * Sets httpClient variable.
     *
     * @param \Http\Client\HttpAsyncClient|\Http\Client\HttpClient $httpClient
     *
     * @return $this
     */
    public function setHttpClient($httpClient);

    /**
     * Gets messageFactory value.
     *
     * @return \Http\Message\MessageFactory
     */
    public function getMessageFactory();
}
