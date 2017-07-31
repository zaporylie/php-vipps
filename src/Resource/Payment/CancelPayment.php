<?php

namespace Vipps\Resource\Payment;

use Vipps\Model\Payment\RequestCancelPayment;
use Vipps\Resource\HttpMethod;
use Vipps\VippsInterface;

/**
 * Class CancelPayment
 *
 * @package Vipps\Resource\Payment
 */
class CancelPayment extends PaymentResourceBase
{

    /**
     * @var \Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::PUT;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/cancel';

    /**
     * InitiatePayment constructor.
     *
     * @param \Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $order_id
     * @param \Vipps\Model\Payment\RequestCancelPayment $requestObject
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
     * @return \Vipps\Model\Payment\ResponseCancelPayment
     */
    public function call()
    {
        $response = parent::call();
        $body = $response->getBody()->getContents();
        /** \Vipps\Model\Authorization\ResponseCancelPayment */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                'Vipps\Model\Payment\ResponseCancelPayment',
                'json'
            );

        return $responseObject;
    }
}
