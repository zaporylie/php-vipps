<?php

/**
 * Vipps class.
 *
 * Vipps client handles all requests, has built in factories for all resources.
 */

namespace Vipps;

use Http\Client\Exception\HttpException;
use Http\Client\Exception\NetworkException;
use Http\Client\HttpAsyncClient;
use Http\Client\HttpClient;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Psr\Http\Message\RequestInterface;
use Vipps\Connection\ConnectionInterface;
use Vipps\Data\DataTime;
use Vipps\Exceptions\ConnectionException;
use Vipps\Exceptions\VippsException;
use Vipps\Resources\Payments;

/**
 * Class Vipps
 * @package Vipps
 */
class Vipps implements VippsInterface
{

    /**
     * @var ConnectionInterface
     */
    protected $environment;

    /**
     * @var string
     */
    protected $version = 'v1';

    /**
     * @var HttpClient|HttpAsyncClient
     */
    protected $httpClient;

    /**
     * @var RequestFactory
     */
    protected $messageFactory;

    /**
     * Required to authorize requests against VIPPS API.
     *
     * @var string|int
     */
    protected $merchantSerialNumber;

    /**
     * Required to authorize requests against VIPPS API.
     *
     * @var string
     */
    protected $merchantID;

    /**
     * Required to authorize requests against VIPPS API.
     *
     * @var string
     */
    protected $token;

    /**
     * Request ID.
     *
     * @var string
     */
    protected $requestID;

    /**
     * Vipps constructor.
     * @param HttpClient|HttpAsyncClient $httpClient
     * @param ConnectionInterface $environment
     */
    public function __construct($httpClient, ConnectionInterface $environment = null)
    {
        $this->environment = $environment ?: new Connection\Test();
        $this->setHttpClient($httpClient);
        $this->generateRequestID();
    }

    /**
     * {@inheritdoc}
     *
     * @throws \LogicException
     */
    public function setHttpClient($httpClient)
    {
        if (!($httpClient instanceof HttpAsyncClient || $httpClient instanceof HttpClient)) {
            throw new \LogicException(sprintf(
                'Parameter to Vipps::setHttpClient must be instance of "%s" or "%s"',
                HttpClient::class,
                HttpAsyncClient::class
            ));
        }
        $this->httpClient = $httpClient;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setMerchantSerialNumber($merchantSerialNumber)
    {
        $this->merchantSerialNumber = $merchantSerialNumber;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMerchantSerialNumber()
    {
        return $this->merchantSerialNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function setMerchantID($merchantID)
    {
        $this->merchantID = $merchantID;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMerchantID()
    {
        return $this->merchantID;
    }

    /**
     * {@inheritdoc}
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * {@inheritdoc}
     */
    public function setRequestID($requestID)
    {
        $this->requestID = $requestID;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getRequestID()
    {
        return $this->requestID;
    }

    /**
     * @return VippsInterface
     */
    public function generateRequestID()
    {
        $this->requestID = uniqid('', true);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function payments()
    {
        return new Payments($this);
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

    /**
     * @return RequestFactory
     */
    protected function getMessageFactory()
    {
        if (!$this->messageFactory) {
            $this->messageFactory = MessageFactoryDiscovery::find();
        }
        return $this->messageFactory;
    }
}
