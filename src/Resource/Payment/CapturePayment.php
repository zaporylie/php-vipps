<?php

namespace zaporylie\Vipps\Resource\Payment;

use zaporylie\Vipps\Model\Payment\RequestCapturePayment;
use zaporylie\Vipps\Model\Payment\ResponseCapturePayment;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class CapturePayment
 *
 * @package Vipps\Resource\Payment
 */
class CapturePayment extends PaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/capture';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $order_id
     * @param \zaporylie\Vipps\Model\Payment\RequestCapturePayment $requestObject
     */
    public function __construct(
        VippsInterface $vipps,
        $subscription_key,
        $order_id,
        RequestCapturePayment $requestObject
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
     * @return \zaporylie\Vipps\Model\Payment\ResponseCapturePayment
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Payment\ResponseCapturePayment $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseCapturePayment::class,
                'json'
            );

        return $responseObject;
    }
}
