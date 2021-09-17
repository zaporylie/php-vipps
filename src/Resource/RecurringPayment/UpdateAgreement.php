<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreement;
use zaporylie\Vipps\Model\RecurringPayment\ResponseUpdateAgreement;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class UpdateAgreement
 *
 * @package Vipps\Resource\RecurringPayment
 */
class UpdateAgreement extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::PATCH;

    /**
     * @var string
     */
    protected $path = '/recurring/v2/agreements/{id}';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param $agreement_id
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreement $requestObject
     */
    public function __construct(
        VippsInterface $vipps,
        $subscription_key,
        $agreement_id,
        RequestUpdateAgreement $requestObject
    ) {
        parent::__construct($vipps, $subscription_key);
        $this->id = $agreement_id;
        $this->body = $this
            ->getSerializer()
            ->serialize(
                $requestObject,
                'json'
            );
    }

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseUpdateAgreement
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseUpdateAgreement $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseUpdateAgreement::class,
                'json'
            );

        return $responseObject;
    }
}
