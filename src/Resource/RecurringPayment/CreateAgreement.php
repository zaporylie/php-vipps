<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreementBase;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\Resource\IdempotencyKeyFactory;
use zaporylie\Vipps\VippsInterface;

/**
 * Class CreateAgreement
 *
 * @package Vipps\Resource\RecurringPayment
 */
class CreateAgreement extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::POST;

    /**
     * @var string
     */
    protected $path = '/recurring/v{api_endpoint_version}/agreements';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement $requestObject
     */
    public function __construct(VippsInterface $vipps, $api_endpoint_version, $subscription_key, RequestCreateAgreementBase $requestObject)
    {
        parent::__construct($vipps, $api_endpoint_version, $subscription_key);
        $this->body = $this
            ->getSerializer()
            ->serialize(
                $requestObject,
                'json'
            );
    }

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateAgreement
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateAgreement $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateAgreement::class,
                'json'
            );

        return $responseObject;
    }
}
