<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Exceptions\Api\InvalidArgumentException;
use zaporylie\Vipps\Model\Checkout\CancelSessionResponse;
use zaporylie\Vipps\Model\Checkout\GetSessionDetailsResponse;
use zaporylie\Vipps\Model\Checkout\RequestCancelSession;
use zaporylie\Vipps\Model\Payment\CustomerInfo;
use zaporylie\Vipps\Model\Payment\MerchantInfo;
use zaporylie\Vipps\Model\Payment\RequestCancelPayment;
use zaporylie\Vipps\Model\Payment\RequestCapturePayment;
use zaporylie\Vipps\Model\Payment\RequestInitiatePayment;
use zaporylie\Vipps\Model\Payment\RequestRefundPayment;
use zaporylie\Vipps\Model\Payment\Transaction;
use zaporylie\Vipps\Resource\Checkout\CancelSession;
use zaporylie\Vipps\Resource\Checkout\GetSessionDetails;
use zaporylie\Vipps\Resource\Payment\CancelPayment;
use zaporylie\Vipps\Resource\Payment\CapturePayment;
use zaporylie\Vipps\Resource\Payment\GetOrderStatus;
use zaporylie\Vipps\Resource\Payment\GetPaymentDetails;
use zaporylie\Vipps\Resource\Payment\InitiatePayment;
use zaporylie\Vipps\Resource\Payment\RefundPayment;
use zaporylie\Vipps\VippsInterface;

/**
 * Class Checkout.
 *
 * @package Vipps\Api
 */
class Checkout extends ApiBase implements CheckoutInterface {

    /**
     * {@inheritdoc}
     */
    public function initiateSession($amount, $reference, $callbackPrefix, $fallback, $options = []) {
        // TODO: Implement initiateSession() method.
    }


    /**
     * {@inheritdoc}
     */
    public function getSessionDetails(string $client_secret, string $session_id): GetSessionDetailsResponse
    {
        $resource = new GetSessionDetails(
            $this->app,
            $this->getSubscriptionKey(),
            $client_secret,
            $session_id
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }

    /**
     * {@inheritdoc}
     */
    public function cancelSession(string $client_secret, string $session_id): CancelSessionResponse {
        $request = (new RequestCancelSession())->setSessionId($session_id);
        $resource = new CancelSession(
            $this->app,
            $this->getSubscriptionKey(),
            $client_secret,
            $request
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }
}
