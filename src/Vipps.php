<?php

namespace Vipps;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\TransferException;
use Vipps\Data\DataTime;
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
    protected $version = '';

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
     * Vipps constructor.
     * @param \GuzzleHttp\Client $client
     */
    function __construct(Client $client)
    {
        $this->client = $client;
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
     * @param $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;
        return $this;
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
                'json' => $payload,
                'headers' => [
                    'X-UserId' => $this->merchantID,
                    'Authorization' => 'Secret ' . $this->token,
                    // @todo: We must set this even though documentation say its optional.
                    'X-Request-Id' => 'dummy',
                    'X-TimeStamp' => (string) new DataTime(),
                    'X-Source-Address' => getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR'),
                ],
            ];
            $response = $this->client->request($method, $this->getUri($uri), $parameters);
            return json_decode($response->getBody()->getContents());
        }
        catch (ClientException $e) {
            throw $e;
        }
        catch (ConnectException $e) {
            throw $e;
        }
        catch (ServerException $e) {
            throw $e;
        }
        catch (TransferException $e) {
            throw $e;
        }
    }

    /**
     * @param $uri
     * @return string
     */
    protected function getUri($uri)
    {
        if (($base_uri = $this->client->getConfig('base_uri')) && !empty($base_uri->getPath())) {
            $uri = sprintf('%s/%s/%s',
              $base_uri->getPath(),
              $this->version,
              $uri
            );
        }
        elseif (($base_uri = $this->client->getConfig('base_uri')) && empty($base_uri->getPath())) {
            $uri = sprintf('/%s/%s',
              $this->version,
              $uri
            );
        }
        if (!$base_uri) {
            $uri = sprintf('%s://%s:%s%s',
              $this->protocol,
              $this->url,
              $this->port,
              $uri
            );
        }
        return $uri;
    }
}
