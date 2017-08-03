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
     * @return \zaporylie\Vipps\Api\Authorization
     */
    public function authorization($subscription_key);

    /**
     * @param string $subscription_key
     * @param string $merchant_serial_number
     *
     * @return \zaporylie\Vipps\Api\Payment
     */
    public function payment($subscription_key, $merchant_serial_number);
}
