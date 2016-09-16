<?php

namespace Vipps\Resources;

use Vipps\Vipps;

abstract class AbstractResource
{

    /**
     * @var Vipps
     */
    protected $vipps;

    /**
     * @var mixed
     */
    private $response;

    /**
     * AbstractResource constructor.
     *
     * @param Vipps $vipps
     */
    public function __construct(Vipps $vipps)
    {
        $this->vipps = $vipps;
    }

    /**
     * Set RAW response from API.
     *
     * @param mixed $response
     */
    private function setLastResponse($response)
    {
        $this->response = $response;
    }

    /**
     * Get last RAW response from API.
     *
     * @return mixed
     */
    public function getLastResponse()
    {
        return $this->response;
    }

    /**
     * @param \Vipps\Resources\ResourceInterface $resource
     * @param string $method
     * @param string $uri
     * @param array $payload
     * @return mixed
     */
    public function request(ResourceInterface $resource, $method = 'GET', $uri = '', $payload = [])
    {
        $response = $this->vipps->request($method, $resource->getResourceUri() . '/' . $uri, $payload);
        $this->setLastResponse($response);
        return $response;
    }
}
