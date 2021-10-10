<?php

/**
 * Vipps interface.
 *
 * Provide Vipps client interface.
 */

namespace zaporylie\Vipps;

/**
 * Interface VippsInterface
 * @package Vipps
 */
interface VippsInterface
{

    /**
     * @return \zaporylie\Vipps\ClientInterface
     */
    public function getClient();

    /**
     * @param string $subscription_key
     *
     * @return \zaporylie\Vipps\Api\AuthorizationInterface
     */
    public function authorization($subscription_key);

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     * @param string $custom_path
     *
     * @return \zaporylie\Vipps\Api\PaymentInterface
     */
    public function payment($subscription_key, $merchant_serial_number, $custom_path);

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     *
     * @return \zaporylie\Vipps\Api\RecurringPaymentInterface
     */
    public function recurringPayment($subscription_key, $merchant_serial_number);
}
