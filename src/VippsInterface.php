<?php

/**
 * Vipps interface.
 *
 * Provide Vipps client interface.
 */

namespace zaporylie\Vipps;

use zaporylie\Vipps\Api\AuthorizationInterface;
use zaporylie\Vipps\Api\PaymentInterface;
use zaporylie\Vipps\Api\RecurringPaymentInterface;
use zaporylie\Vipps\Api\UserInfoInterface;

/**
 * Interface VippsInterface
 *
 * @package Vipps
 */
interface VippsInterface
{

    /**
     * @return \zaporylie\Vipps\ClientInterface
     */
    public function getClient(): ClientInterface;

    /**
     * @param string $subscription_key
     *
     * @return \zaporylie\Vipps\Api\AuthorizationInterface
     */
    public function authorization(string $subscription_key): AuthorizationInterface;

    /**
     * @return \zaporylie\Vipps\UserInfoInterface
     */
    public function userInfo(): UserInfoInterface;

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     * @param string $custom_path
     *
     * @return \zaporylie\Vipps\Api\PaymentInterface
     */
    public function payment(string $subscription_key, string $merchant_serial_number, string $custom_path): PaymentInterface;

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     *
     * @return \zaporylie\Vipps\Api\RecurringPaymentInterface
     */
    public function recurringPayment(string $subscription_key, string $merchant_serial_number): RecurringPaymentInterface;
}
