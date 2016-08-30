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
    protected $protocol = 'https';
    protected $url = 'vipps.dnb.no';
    protected $port = '80';
    protected $version = 'v1';

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var
     */
    protected $merchantSerialNumber;
    protected $merchantID;
    protected $token;

    function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setMerchantSerialNumber($merchantSerialNumber)
    {
        $this->merchantSerialNumber = $merchantSerialNumber;
        return $this;
    }

    public function getMerchantSerialNumber()
    {
        return $this->merchantSerialNumber;
    }

    public function setMerchantID($merchantID)
    {
        $this->merchantID = $merchantID;
        return $this;
    }

    public function setToken($token)
    {
        $this->token = $token;
        return $this;
    }

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
                  'Authorization' => 'Secret ' . $this->token,
                  'X-UserId' => $this->merchantID,
                  'X-TimeStamp' => (string) new DataTime(),
                  'X-SourceAddress' => getenv('HTTP_CLIENT_IP')?:getenv('HTTP_X_FORWARDED_FOR')?:getenv('HTTP_X_FORWARDED')?:getenv('HTTP_FORWARDED_FOR')?:getenv('HTTP_FORWARDED')?:getenv('REMOTE_ADDR'),
              ]
            ];
            return $this->client->request($method, $this->getUri() . $uri, $parameters);
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

    public function payments()
    {
        return new Payments($this);
    }

    protected function getUri()
    {
        return sprintf('%s://%s:%s/%s/',
          $this->protocol,
          $this->url,
          $this->port,
          $this->version
        );
    }
}
