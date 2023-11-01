<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\Resource\IdempotencyKeyFactory;
use zaporylie\Vipps\Resource\RequestIdFactory;
use zaporylie\Vipps\VippsInterface;

/**
 * Class CreateCharge
 *
 * @package Vipps\Resource\RecurringPayment
 */
class CreateCharge extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/recurring/v{api_endpoint_version}/agreements/{id}/charges';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param string $agreementId
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge $requestObject
     */
    public function __construct(
        VippsInterface $vipps,
        $api_endpoint_version,
        $subscription_key,
        $agreementId,
        RequestCreateCharge $requestObject
    ) {
        $this->id = $agreementId;
        parent::__construct($vipps, $api_endpoint_version, $subscription_key);
        $this->body = $this
            ->getSerializer()
            ->serialize(
                $requestObject,
                'json'
            );
    }

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseCreateCharge::class,
                'json'
            );

        return $responseObject;
    }
}
