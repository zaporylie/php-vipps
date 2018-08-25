<?php

namespace zaporylie\Vipps\Resource\Payment;

use zaporylie\Vipps\Model\Payment\RequestInitiatePayment;
use zaporylie\Vipps\Model\Payment\ResponseInitiatePayment;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class InitiatePayment
 *
 * @package Vipps\Resource\Payment
 */
class InitiatePayment extends PaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/ecomm/v2/payments';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param \zaporylie\Vipps\Model\Payment\RequestInitiatePayment $requestObject
     */
    public function __construct(VippsInterface $vipps, $subscription_key, RequestInitiatePayment $requestObject)
    {
        parent::__construct($vipps, $subscription_key);
        $this->body = $this
            ->getSerializer()
            ->serialize(
                $requestObject,
                'json'
            );
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\ResponseInitiatePayment
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Payment\ResponseInitiatePayment $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseInitiatePayment::class,
                'json'
            );

        return $responseObject;
    }
}
