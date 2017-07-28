<?php

namespace Vipps\Api;

use Vipps\Exceptions\Api\InvalidArgumentException;
use Vipps\Resource\ResourceInterface;
use Vipps\VippsInterface;

abstract class ApiBase
{

    /**
     * @var \Vipps\VippsInterface
     */
    protected $app;

    /**
     * @var string
     */
    protected $subscriptionKey;

    /**
     * ApiBase constructor.
     *
     * @param \Vipps\VippsInterface $app
     * @param string $subscription_key
     */
    public function __construct(VippsInterface $app, $subscription_key)
    {
        $this->app = $app;
        $this->subscriptionKey = $subscription_key;
    }

    /**
     * Gets subscription_key value.
     *
     * @return string
     */
    public function getSubscriptionKey()
    {
        if (empty($this->subscriptionKey)) {
            throw new InvalidArgumentException('Missing subscription key');
        }
        return $this->subscriptionKey;
    }

    /**
     * Sets subscription_key variable.
     *
     * @param string $subscriptionKey
     *
     * @return $this
     */
    public function setSubscriptionKey($subscriptionKey)
    {
        $this->subscriptionKey = $subscriptionKey;
        return $this;
    }

    /**
     * @param \Vipps\Resource\ResourceInterface $resource
     *
     * @return mixed
     */
    protected function doRequest(ResourceInterface $resource)
    {
        return $resource->call();
    }
}
