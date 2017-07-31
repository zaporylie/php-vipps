<?php

namespace Vipps\Resource\Payment;

use Vipps\Resource\HttpMethod;
use Vipps\VippsInterface;

class GetOrderStatus extends PaymentResourceBase
{

    /**
     * @var \Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::GET;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/serialNumber/{merchantSerialNumber}/status';

    /**
     * InitiatePayment constructor.
     *
     * @param \Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $merchant_serial_number
     * @param string $order_id
     */
    public function __construct(VippsInterface $vipps, $subscription_key, $merchant_serial_number, $order_id)
    {
        parent::__construct($vipps, $subscription_key);
        $this->id = $order_id;
        $this->path = str_replace('{merchantSerialNumber}', $merchant_serial_number, $this->path);
    }

    /**
     * @return \Vipps\Model\Payment\ResponseGetOrderStatus
     */
    public function call()
    {
        $response = parent::call();
        $body = $response->getBody()->getContents();
        /** @var \Vipps\Model\Payment\ResponseGetOrderStatus $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                'Vipps\Model\Payment\ResponseGetOrderStatus',
                'json'
            );

        return $responseObject;
    }
}
