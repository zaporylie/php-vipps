<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCaptureCharge;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\v3\RequestCaptureCharge;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\Resource\IdempotencyKeyFactory;
use zaporylie\Vipps\Resource\RequestIdFactory;
use zaporylie\Vipps\VippsInterface;

/**
 * Class CaptureCharge
 *
 * @package Vipps\Resource\RecurringPayment
 */
class CaptureCharge extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/recurring/v{api_endpoint_version}/agreements/{id}/charges/{charge_id}/capture';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $agreement_id
     * @param string $charge_id
     */
    public function __construct(
        VippsInterface $vipps,
        $api_endpoint_version,
        $subscription_key,
        $agreement_id,
        $charge_id,
        RequestCaptureCharge $requestObject
    ) {
        $this->id = $agreement_id;
        $this->charge_id = $charge_id;
        parent::__construct($vipps, $api_endpoint_version, $subscription_key);
        $this->body = $this
        ->getSerializer()
        ->serialize(
            $requestObject,
            'json'
        );
    }

    /**
     * @return string
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        return $body;
    }
}
