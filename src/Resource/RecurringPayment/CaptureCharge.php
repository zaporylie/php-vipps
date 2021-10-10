<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCaptureCharge;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge;
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
    protected $path = '/recurring/v2/agreements/{id}/charges/{charge_id}/capture';

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
        $subscription_key,
        $agreement_id,
        $charge_id
    ) {
        $this->id = $agreement_id;
        $this->charge_id = $charge_id;
        // By default RequestID is different for each Resource object.
        $this->headers['Idempotency-Key'] = IdempotencyKeyFactory::generate();
        parent::__construct($vipps, $subscription_key);
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
