<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement;
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
    protected $path = '/recurring/v2/agreements/{id}';

    /**
     * InitiatePayment constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $vipps
     * @param string $subscription_key
     * @param $agreement_id
     */
    public function __construct(VippsInterface $vipps, $subscription_key, $agreement_id)
    {
        parent::__construct($vipps, $subscription_key);
        $this->id = $agreement_id;
    }

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                ResponseGetAgreement::class,
                'json'
            );

        return $responseObject;
    }
}
