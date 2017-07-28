<?php

namespace Vipps\Resource\Payment;

use Vipps\Model\Payment\RequestCapturePayment;
use Vipps\Resource\HttpMethod;
use Vipps\VippsInterface;

class CapturePayment extends PaymentResourceBase
{

    /**
     * @var \Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/capture';

    /**
     * InitiatePayment constructor.
     *
     * @param \Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $order_id
     * @param \Vipps\Model\Payment\RequestCapturePayment $requestObject
     */
    public function __construct(VippsInterface $vipps, $subscription_key, $order_id, RequestCapturePayment $requestObject)
    {
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
     * @return \Vipps\Model\Payment\ResponseCapturePayment
     */
    public function call()
    {
        $response = parent::call();
        $body = $response->getBody()->getContents();
        /** \Vipps\Model\Authorization\ResponseCapturePayment */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                'Vipps\Model\Payment\ResponseCapturePayment',
                'json'
            );

        return $responseObject;
    }
}
