<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCreateAgreement;
use zaporylie\Vipps\Resource\HttpMethod;
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
    protected $path = '/recurring/v2/agreements';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement $requestObject
     */
    public function __construct(VippsInterface $vipps, $subscription_key, RequestCreateAgreement $requestObject)
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
                ResponseCreateAgreement::class,
                'json'
            );

        return $responseObject;
    }
}
