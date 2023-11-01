<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement;
use zaporylie\Vipps\Model\RecurringPayment\v2\ResponseGetAgreement as ResponseGetAgreementV2; 
use zaporylie\Vipps\Model\RecurringPayment\v3\ResponseGetAgreement as ResponseGetAgreementV3;
use zaporylie\Vipps\Resource\HttpMethod;

/**
 * Class GetAgreements
 *
 * @package Vipps\Resource\RecurringPayment
 */
class GetAgreements extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::GET;

    /**
     * @var string
     */
    protected $path = '/recurring/v{api_endpoint_version}/agreements';

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement[]
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement[] $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                //Not a good way to go about version management
                sprintf("array<%s>", $this->api_endpoint_version == 3 ? ResponseGetAgreementV3::class : ResponseGetAgreementV2::class),
                'json'
            );

        return $responseObject;
    }
}
