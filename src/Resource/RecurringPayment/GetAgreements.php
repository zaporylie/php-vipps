<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement;
use zaporylie\Vipps\Resource\HttpMethod;
use zaporylie\Vipps\VippsInterface;

/**
 * Class GetAgreements
 *
 * @package Vipps\Resource\RecurringPayment
 */
class GetAgreements extends RecurringPaymentResourceBase
{

    /**
     * @var string
     */
    protected string $path = '/recurring/v2/agreements';

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
                sprintf("array<%s>", ResponseGetAgreement::class),
                'json'
            );

        return $responseObject;
    }
}
