<?php

/**
 * Vipps class.
 *
 * Vipps client handles all requests, has built in factories for all resources.
 */

namespace Vipps;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Http\Client\Exception\HttpException;
use Http\Client\Exception\NetworkException;
use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use JMS\Serializer\SerializerBuilder;
use Psr\Http\Message\RequestInterface;
use Vipps\Api\Authorization;
use Vipps\Api\Payment;
use Vipps\EndpointInterface;
use Vipps\Model\DataTime;
use Vipps\Exceptions\ConnectionException;
use Vipps\Exceptions\VippsException;
use Vipps\Resource\Payments;

/**
 * Class Vipps
 * @package Vipps
 */
class Vipps implements VippsInterface
{

    /**
     * @var \Vipps\Client
     */
    protected $client;

    /**
     * Vipps constructor.
     *
     * @param \Vipps\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     *
     * @return \Vipps\Api\Payment
     */
    public function payment($subscription_key, $merchant_serial_number)
    {
        return new Payment($this, $subscription_key, $merchant_serial_number);
    }

    /**
     * @param string $subscription_key
     * @return \Vipps\Api\Authorization
     */
    public function authorization($subscription_key)
    {
        return new Authorization($this, $subscription_key);
    }

    /**
     * {@inheritdoc}
     */
    public function request($method, $uri, array $payload = [])
    {
        try {
            // Build request.
            $request = $this->buildRequest($method, $uri, $payload);

            // Make a request.
            $response = $this->httpClient->sendRequest($request);

            // Get and decode content.
            $content = json_decode($response->getBody()->getContents());

            // Sometimes VIPPS returns 200 with error message :/ They promised
            // to fix it but as a temporary fix we are gonna check if body is
            // "invalid" and throw exception in case it is.
            $exception = new VippsException();
            $exception->setErrorResponse($content);
            if ($exception->getErrorCode() || $exception->getErrorMessage()) {
                throw $exception;
            }

            // If everything is ok return content.
            return $content;
        } catch (HttpException $e) {
            $exception = new VippsException($e->getMessage(), $e->getCode());
            $content = json_decode($e->getResponse()->getBody()->getContents());
            throw $exception->setErrorResponse($content);
        } catch (NetworkException $e) {
            throw new ConnectionException($e->getMessage(), $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new VippsException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Return request for method
     * @param $method
     * @param $uri
     * @param array $payload
     * @return RequestInterface
     */
    protected function buildRequest($method, $uri, array $payload)
    {
        return $this->getMessageFactory()->createRequest(
            $method,
            $this->getUri($uri),
            $this->getHeaders($method),
            $this->getPayload($payload)
        );
    }

    /**
     * @param $uri
     * @return string
     */
    protected function getUri($uri)
    {
        $base_uri = $this->environment->getUri();
        return sprintf('%s/%s%s', $base_uri, $this->version, $uri);
    }

    /**
     * Get request headers.
     * @param string $method
     * @return array
     */
    protected function getHeaders($method)
    {
        $headers = [
          'Content-Type' => 'application/json',
          'X-UserId' => $this->merchantID,
          'Authorization' => 'Secret ' . $this->token,
          'X-Request-Id' => (string) $this->requestID,
          'X-TimeStamp' => (string) new DataTime(),
          'X-Source-Address' => getenv('HTTP_CLIENT_IP')
            ?:getenv('HTTP_X_FORWARDED_FOR')
            ?:getenv('HTTP_X_FORWARDED')
            ?:getenv('HTTP_FORWARDED_FOR')
            ?:getenv('HTTP_FORWARDED')
            ?:getenv('REMOTE_ADDR')
            ?:gethostname(),
        ];

        // @todo: Investigate more why it's like that.
        if ($method == 'GET') {
            $headers['Connection'] = 'close';
            $headers['Transfer-Encoding'] = null;
        }

        return $headers;
    }

    /**
     * Get request payload.
     *
     * @param array $payload
     * @return string
     */
    protected function getPayload(array $payload)
    {
        $payload = array_merge_recursive($payload, [
          'merchantInfo' => [
            'merchantSerialNumber' => $this->merchantSerialNumber,
          ],
        ]);
        return json_encode($payload, JSON_UNESCAPED_SLASHES);
    }
}
