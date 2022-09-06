<?php

namespace zaporylie\Vipps\Resource\Checkout;

use zaporylie\Vipps\Model\Checkout\RequestInitiateSession;
use zaporylie\Vipps\Model\Checkout\ResponseInitiateSession;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

class InitiateSession extends CheckoutResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/checkout/v2/session';

    /**
     * InitiateSession constructor.
     */
    public function __construct(
        VippsInterface $vipps,
        string $subscription_key,
        string $client_secret,
        RequestInitiateSession $request_object
    ) {
        parent::__construct($vipps, $subscription_key, $client_secret);
        $this->body = $this
            ->getSerializer()
            ->serialize(
                ['initiateSessionRequest' => $request_object],
                'json'
            );
    }

    /**
     * @return \zaporylie\Vipps\Model\Checkout\ResponseInitiateSession
     *
     * @throws \zaporylie\Vipps\Exceptions\VippsException
     */
    public function call(): ResponseInitiateSession
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Checkout\ResponseInitiateSession $response_object */
        $response_object = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseInitiateSession::class,
                'json'
            );

        return $response_object;
    }
}
