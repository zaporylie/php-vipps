<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreementBase;
use zaporylie\Vipps\Model\RecurringPayment\v2\ResponseGetAgreement as ResponseGetAgreementV2; 
use zaporylie\Vipps\Model\RecurringPayment\v3\ResponseGetAgreement as ResponseGetAgreementV3;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class GetAgreement
 *
 * @package Vipps\Resource\RecurringPayment
 */
class GetAgreement extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::GET;

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
     */
    public function __construct(VippsInterface $vipps, $api_endpoint_version, $subscription_key, $agreement_id)
    {
        parent::__construct($vipps, $api_endpoint_version, $subscription_key);
        $this->id = $agreement_id;
    }

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreementBase
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreementBase $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                //Not a good way to go about version management
                $this->api_endpoint_version == 3 ? ResponseGetAgreementV3::class : ResponseGetAgreementV2::class,
                'json'
            );

        return $responseObject;
    }
}
