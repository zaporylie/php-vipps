<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\Checkout\RequestAmount;
use zaporylie\Vipps\Model\Checkout\ResponseCancelSession;
use zaporylie\Vipps\Model\Checkout\ResponseGetSessionDetails;
use zaporylie\Vipps\Model\Checkout\ResponseInitiateSession;

/**
 * Interface CheckoutInterface.
 *
 * @package Vipps\Api
 */
interface CheckoutInterface
{

  /**
   * Initiates checkout session.
   *
   * @param string $callback_prefix
   *   Callback prefix.
   * @param string $return_url
   *   Return URL.
   * @param string $callback_auth_token
   *   Callback authorization token.
   * @param \zaporylie\Vipps\Model\Checkout\RequestAmount $amount
   *   Request amount.
   * @param $options array
   *   Options.
   *
   * @return \zaporylie\Vipps\Model\Checkout\ResponseInitiateSession
   *
   * @see https://vippsas.github.io/vipps-checkout-api/#/Session/post_v2_session
   */
    public function initiateSession(
      string $callback_prefix,
      string $return_url,
      string $callback_auth_token,
      RequestAmount $amount,
      array $options = []
    ): ResponseInitiateSession;

    /**
     * Gets checkout session details.
     *
     * @param string $session_id
     *   Session id.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseGetSessionDetails
     *
     * @see https://vippsas.github.io/vipps-checkout-api/#/Session/get_v2_session__sessionId_
     */
    public function getSessionDetails(string $session_id): ResponseGetSessionDetails;

    /**
     * Cancels checkout session.
     *
     * @param string $session_id
     *   Session id.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ResponseCancelSession
     *
     * @see https://vippsas.github.io/vipps-checkout-api/#/Session/post_v2_session_cancel
     */
    public function cancelSession(string $session_id): ResponseCancelSession;
}
