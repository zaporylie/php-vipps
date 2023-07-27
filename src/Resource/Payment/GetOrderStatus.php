<?php

namespace zaporylie\Vipps\Resource\Payment;

use zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class GetOrderStatus
 * @package zaporylie\Vipps\Resource\Payment
 * @deprecated
 *   This API call allows the merchant to get the status of the last payment transaction.
 *   Primarily use of this service is meant for inApp where simple response to check order
 *   status is preferred.
 */
class GetOrderStatus extends PaymentResourceBase
{

    /**
     * @var string
     */
    protected string $path = '/ecomm/v2/payments/{id}/status';

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
     * @return \zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseGetOrderStatus::class,
                'json'
            );

        return $responseObject;
    }
}
