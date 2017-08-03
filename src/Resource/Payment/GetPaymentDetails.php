<?php

namespace zaporylie\Vipps\Resource\Payment;

use zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

class GetPaymentDetails extends PaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::GET;

    /**
     * @var string
     */
    protected $path = '/Ecomm/v1/payments/{id}/serialNumber/{merchantSerialNumber}/details';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
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
