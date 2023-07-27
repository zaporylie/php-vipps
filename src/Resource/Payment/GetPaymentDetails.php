<?php

namespace zaporylie\Vipps\Resource\Payment;

use zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

class GetPaymentDetails extends PaymentResourceBase
{

    /**
     * @var string
     */
    protected string $path = '/ecomm/v2/payments/{id}/details';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $order_id
     */
    public function __construct(VippsInterface $vipps, $subscription_key, $order_id)
    {
        $this->method = HttpMethod::GET();
        parent::__construct($vipps, $subscription_key);
        $this->id = $order_id;
    }

    /**
     * @return \zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseGetPaymentDetails::class,
                'json'
            );

        return $responseObject;
    }
}
