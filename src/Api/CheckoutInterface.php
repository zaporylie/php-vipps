<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\Checkout\ResponseCancelSession;
use zaporylie\Vipps\Model\Checkout\ResponseGetSessionDetails;

/**
 * Interface CheckoutInterface.
 *
 * @package Vipps\Api
 */
interface CheckoutInterface
{

    /**
     * @param int $amount
     * @param string $reference
     * @param string $callbackPrefix
     * @param string $fallback
     * @param $options array
     *   Optional values.
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseInitiatePayment
     *
     * @see https://vippsas.github.io/vipps-ecom-api/#/Vipps_eCom_API/initiatePaymentV3UsingPOST
     */
    public function initiateSession($amount, $reference, $callbackPrefix, $fallback, $options = []);

    /**
     * @param string $client_secret
     *   Client secret.
     * @param string $session_id
     *   Session id.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseGetSessionDetails
     */
    public function getSessionDetails(string $client_secret, string $session_id): ResponseGetSessionDetails;

    /**
     * @param string $client_secret
     *   Client secret.
     * @param string $session_id
     *   Session id.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseCancelSession
     */
    public function cancelSession(string $client_secret, string $session_id): ResponseCancelSession;
}
