<?php

namespace zaporylie\Vipps\Resource\Payment;

use zaporylie\Vipps\Model\Payment\RequestCancelPayment;
use zaporylie\Vipps\Model\Payment\ResponseCancelPayment;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class CancelPayment
 *
 * @package Vipps\Resource\Payment
 */
class CancelPayment extends PaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::PUT;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/cancel';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $order_id
     * @param \zaporylie\Vipps\Model\Payment\RequestCancelPayment $requestObject
     */
    public function __construct(
        VippsInterface $vipps,
        $subscription_key,
        $order_id,
        RequestCancelPayment $requestObject
    ) {
        parent::__construct($vipps, $subscription_key);
        $this->body = $this
            ->getSerializer()
            ->serialize(
                $requestObject,
                'json'
            );
        $this->id = $order_id;
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\ResponseCancelPayment
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Payment\ResponseCancelPayment $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseCancelPayment::class,
                'json'
            );

        return $responseObject;
    }
}
