<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreementBase;
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
    protected $path = '/recurring/v{api_endpoint_version}/agreements/{id}';

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
        $api_endpoint_version,
        $subscription_key,
        $agreement_id,
        RequestUpdateAgreementBase $requestObject
    ) {
        parent::__construct($vipps, $api_endpoint_version, $subscription_key);
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
        
        if ($this->api_endpoint_version > 2) {
            $responseObject = new ResponseUpdateAgreement();
            $responseObject->setAgreementId($this->id);
        } else {
            $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseUpdateAgreement::class,
                'json'
            );
        }
        return $responseObject;
    }
}
