<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\Checkout\RequestInitiateSession;
use zaporylie\Vipps\Model\Checkout\ResponseCancelSession;
use zaporylie\Vipps\Model\Checkout\ResponseGetSessionDetails;
use zaporylie\Vipps\Model\Checkout\RequestCancelSession;
use zaporylie\Vipps\Model\Checkout\ResponseInitiateSession;
use zaporylie\Vipps\Resource\Checkout\CancelSession;
use zaporylie\Vipps\Resource\Checkout\GetSessionDetails;
use zaporylie\Vipps\Resource\Checkout\InitiateSession;

/**
 * Class Checkout.
 *
 * @package Vipps\Api
 */
class Checkout extends ApiBase implements CheckoutInterface {

    /**
     * {@inheritdoc}
     */
    public function initiateSession(string $client_secret, array $options): ResponseInitiateSession
    {
        $request = new RequestInitiateSession();
        // @todo Populate request options.

        $resource = new InitiateSession(
            $this->app,
            $this->getSubscriptionKey(),
            $client_secret,
            $request
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }


    /**
     * {@inheritdoc}
     */
    public function getSessionDetails(string $client_secret, string $session_id): ResponseGetSessionDetails
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
    public function cancelSession(string $client_secret, string $session_id): ResponseCancelSession {
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
