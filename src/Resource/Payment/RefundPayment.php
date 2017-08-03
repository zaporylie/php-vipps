<?php

namespace zaporylie\Vipps\Resource\Payment;

use zaporylie\Vipps\Model\Payment\RequestRefundPayment;
use zaporylie\Vipps\Model\Payment\ResponseRefundPayment;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class RefundPayment
 *
 * @package Vipps\Resource\Payment
 */
class RefundPayment extends PaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/refund';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $order_id
     * @param \zaporylie\Vipps\Model\Payment\RequestRefundPayment $requestObject
     */
    public function __construct(
        VippsInterface $vipps,
        $subscription_key,
        $order_id,
        RequestRefundPayment $requestObject
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
     * @return \zaporylie\Vipps\Model\Payment\ResponseRefundPayment
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Payment\ResponseRefundPayment $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseRefundPayment::class,
                'json'
            );

        return $responseObject;
    }
}
