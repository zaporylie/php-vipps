<?php

/**
 * Vipps class.
 *
 * Vipps client handles all requests, has built in factories for all resources.
 */

namespace zaporylie\Vipps;

use zaporylie\Vipps\Api\Authorization;
use zaporylie\Vipps\Api\Payment;

/**
 * Class Vipps
 * @package Vipps
 */
class Vipps implements VippsInterface
{

    /**
     * @var \zaporylie\Vipps\ClientInterface
     */
    protected $client;

    /**
     * Vipps constructor.
     *
     * @param \zaporylie\Vipps\ClientInterface $client
     */
    public function __construct(ClientInterface $client)
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
     * @return \zaporylie\Vipps\Api\Payment
     */
    public function payment($subscription_key, $merchant_serial_number)
    {
        return new Payment($this, $subscription_key, $merchant_serial_number);
    }

    /**
     * @param string $subscription_key
     *
     * @return \zaporylie\Vipps\Api\Authorization
     */
    public function authorization($subscription_key)
    {
        return new Authorization($this, $subscription_key);
    }
}
