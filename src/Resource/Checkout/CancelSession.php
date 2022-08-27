<?php

namespace zaporylie\Vipps\Resource\Checkout;

use zaporylie\Vipps\Model\Checkout\CancelSessionResponse;
use zaporylie\Vipps\Model\Checkout\RequestCancelSession;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

class CancelSession extends CheckoutResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/v2/session/cancel';

    /**
     * CancelSession constructor.
     */
    public function __construct(VippsInterface $vipps, $subscription_key, string $client_secret, RequestCancelSession $request_object) {
      parent::__construct($vipps, $subscription_key, $client_secret);
      $this->body = $this
        ->getSerializer()
        ->serialize(
          $request_object,
          'json'
        );
    }

  /**
   * @return \zaporylie\Vipps\Model\Checkout\CancelSessionResponse
   *
   * @throws \zaporylie\Vipps\Exceptions\VippsException
   */
    public function call(): CancelSessionResponse {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();

        // For now response has empty body, but let's keep that like this,
        // assuming something might be added by "Vipps" in the future.
        /** @var \zaporylie\Vipps\Model\Checkout\CancelSessionResponse $response_object */
        $response_object = $this
            ->getSerializer()
            ->deserialize(
                $body,
                CancelSessionResponse::class,
                'json'
            );

        return $response_object;
    }
}
