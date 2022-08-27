<?php

namespace zaporylie\Vipps\Resource\Checkout;

use zaporylie\Vipps\Model\Checkout\GetSessionDetailsResponse;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

class GetSessionDetails extends CheckoutResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::GET;

    /**
     * @var string
     */
    protected $path = '/v2/session/{id}';

    /**
     * GetSessionDetails constructor.
     */
    public function __construct(VippsInterface $vipps, string $subscription_key, string $client_secret, string $session_id)
    {
        parent::__construct($vipps, $subscription_key, $client_secret);
        $this->id = $session_id;
    }

  /**
   * @return \zaporylie\Vipps\Model\Checkout\GetSessionDetailsResponse
   *
   * @throws \zaporylie\Vipps\Exceptions\VippsException
   */
    public function call(): GetSessionDetailsResponse {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Checkout\GetSessionDetailsResponse $response_object */
        $response_object = $this
            ->getSerializer()
            ->deserialize(
                $body,
                GetSessionDetailsResponse::class,
                'json'
            );

        return $response_object;
    }
}
