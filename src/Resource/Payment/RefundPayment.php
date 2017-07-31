<?php

namespace Vipps\Resource\Payment;

use Vipps\Model\Payment\RequestRefundPayment;
use Vipps\Resource\HttpMethod;
use Vipps\VippsInterface;

/**
 * Class RefundPayment
 *
 * @package Vipps\Resource\Payment
 */
class RefundPayment extends PaymentResourceBase
{

    /**
     * @var \Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/refund';

    /**
     * InitiatePayment constructor.
     *
     * @param \Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $order_id
     * @param \Vipps\Model\Payment\RequestRefundPayment $requestObject
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
     * @return \Vipps\Model\Payment\ResponseRefundPayment
     */
    public function call()
    {
        $response = parent::call();
        $body = $response->getBody()->getContents();
        /** @var \Vipps\Model\Payment\ResponseRefundPayment $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                'Vipps\Model\Payment\ResponseRefundPayment',
                'json'
            );

        return $responseObject;
    }
}
