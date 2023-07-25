<?php

/**
 * Vipps class.
 *
 * Vipps client handles all requests, has built in factories for all resources.
 */

namespace zaporylie\Vipps;

use zaporylie\Vipps\Api\Authorization;
use zaporylie\Vipps\Api\AuthorizationInterface;
use zaporylie\Vipps\Api\Payment;
use zaporylie\Vipps\Api\PaymentInterface;
use zaporylie\Vipps\Api\RecurringPayment;
use zaporylie\Vipps\Api\RecurringPaymentInterface;
use zaporylie\Vipps\Api\UserInfo;
use zaporylie\Vipps\Api\UserInfoInterface;

/**
 * Class Vipps
 * @package Vipps
 */
class Vipps implements VippsInterface
{

    /**
     * @var \zaporylie\Vipps\ClientInterface
     */
    protected ClientInterface $client;

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
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     * @param string $custom_path
     *
     * @return \zaporylie\Vipps\Api\PaymentInterface
     */
    public function payment(string $subscription_key, string $merchant_serial_number, string $custom_path = 'ecomm'): PaymentInterface
    {
        return new Payment($this, $subscription_key, $merchant_serial_number, $custom_path);
    }

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     *
     * @return \zaporylie\Vipps\Api\RecurringPaymentInterface
     */
    public function recurringPayment(string $subscription_key, string $merchant_serial_number): RecurringPaymentInterface
    {
        return new RecurringPayment($this, $subscription_key, $merchant_serial_number);
    }

    /**
     * @return \zaporylie\Vipps\Api\UserInfoInterface
     */
    public function userInfo(): UserInfoInterface
    {
        return new UserInfo($this);
    }

    /**
     * @param string $subscription_key
     *
     * @return \zaporylie\Vipps\Api\AuthorizationInterface
     */
    public function authorization(string $subscription_key): AuthorizationInterface
    {
        return new Authorization($this, $subscription_key);
    }
}
