<?php

namespace Vipps;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use Vipps\Data\DataTime;
use Vipps\Exceptions\ConnectionException;
use Vipps\Exceptions\VippsException;
use Vipps\Resources\Payments;

class Vipps
{
    /**
     * Not announced yet!
     *
     * @var string
     */
    protected $protocol = '';
    /**
     * Not announced yet!
     *
     * @var string
     */
    protected $url = '';
    /**
     * Not announced yet!
     *
     * @var string
     */
    protected $port = '';
    /**
     * Not announced yet!
     *
     * @var string
     */
    protected $version = 'v1';

    /**
     * @var Client
     */
    protected $client;

    /**
     * Required to authorize requests against VIPPS API.
     *
     * @var string
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
     * @param \GuzzleHttp\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->requestID = uniqid('', true);
    }

    /**
     * @param $merchantSerialNumber
     * @return $this
     */
    public function setMerchantSerialNumber($merchantSerialNumber)
    {
        $this->merchantSerialNumber = $merchantSerialNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantSerialNumber()
    {
        return $this->merchantSerialNumber;
    }

    /**
     * @param $merchantID
     * @return $this
     */
    public function setMerchantID($merchantID)
    {
        $this->merchantID = $merchantID;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantID()
    {
        return $this->merchantID;
    }

    /**
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $requestID
     * @return Vipps
     */
    public function setRequestID(UuidInterface $requestID)
    {
        $this->requestID = $requestID;
        return $this;
    }

    /**
     * @return string
     */
    public function getRequestID()
    {
        return $this->requestID;
    }

    /**
     * @return \Vipps\Resources\Payments
     */
    public function payments()
    {
        return new Payments($this);
    }

    /**
     * @param $method
     * @param $uri
     * @param array $payload
     * @return mixed
     */
    public function request($method, $uri, array $payload = [])
    {
        try {
            $payload = array_merge_recursive($payload, [
                'merchantInfo' => [
                    'merchantSerialNumber' => $this->merchantSerialNumber,
                ],
            ]);
            $parameters = [
                'body' => json_encode($payload, JSON_UNESCAPED_SLASHES),
                'headers' => [
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
                        ?:getenv('REMOTE_ADDR'),
                ],
            ];
            // Make a request.
            $response = $this->client->request($method, $this->getUri($uri), $parameters);

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
        } catch (ClientException $e) {
            $exception = new VippsException($e->getMessage(), $e->getCode());
            $content = json_decode($e->getResponse()->getBody()->getContents());
            throw $exception->setErrorResponse($content);
        } catch (ConnectException $e) {
            throw new ConnectionException($e->getMessage(), $e->getCode(), $e);
        } catch (\Exception $e) {
            throw new VippsException($e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * @param $uri
     * @return string
     */
    protected function getUri($uri)
    {
        if (($base_uri = $this->client->getConfig('base_uri')) && !empty($base_uri->getPath())) {
            $uri = sprintf(
                '%s/%s/%s',
                $base_uri->getPath(),
                $this->version,
                $uri
            );
        } elseif (($base_uri = $this->client->getConfig('base_uri')) && empty($base_uri->getPath())) {
            $uri = sprintf(
                '/%s/%s',
                $this->version,
                $uri
            );
        }
        if (!$base_uri) {
            $uri = sprintf(
                '%s://%s:%s%s',
                $this->protocol,
                $this->url,
                $this->port,
                $uri
            );
        }
        return $uri;
    }
}
