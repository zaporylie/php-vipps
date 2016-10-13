<?php

namespace Vipps;

use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Vipps\Resources\PaymentsInterface;

/**
 * Interface VippsInterface
 * @package Vipps
 */
interface VippsInterface
{

    /**
     * @param string $method
     *   HTTP method: GET, POST, PUT
     * @param string $uri
     *   Resource path.
     * @param array $payload
     *   Payload array.
     *
     * @return mixed
     *
     * @throws Exceptions\VippsException
     */
    public function request($method, $uri, array $payload = []);

    /**
     * @return PaymentsInterface
     */
    public function payments();

    /**
     * Return merchant credential: serial number.
     * @return string
     */
    public function getMerchantSerialNumber();

    /**
     * Return merchant credential: merchant id.
     * @return string
     */
    public function getMerchantID();

    /**
     * Return merchant credential: token.
     * @return string
     */
    public function getToken();

    /**
     * Sets merchant credential: serial number.
     * @param string|int $merchantSerialNumber
     * @return VippsInterface
     */
    public function setMerchantSerialNumber($merchantSerialNumber);

    /**
     * Sets merchant credential: merchant id.
     * @param string $merchantID
     * @return VippsInterface
     */
    public function setMerchantID($merchantID);

    /**
     * Sets merchant credential: token.
     * @param string $token
     * @return VippsInterface
     */
    public function setToken($token);

    /**
     * @param HttpClient|HttpAsyncClient $httpClient
     * @return VippsInterface
     */
    public function setHttpClient($httpClient);
}
