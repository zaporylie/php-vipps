<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\Charge;
use zaporylie\Vipps\Resource\HttpMethod;

/**
 * Class GetCharges
 *
 * @package Vipps\Resource\RecurringPayment
 */
class GetCharges extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::GET;

    /**
     * @var string
     */
    protected $path = '/recurring/v2/agreements/{id}/charges';

    public function __construct(
        \zaporylie\Vipps\VippsInterface $vipps,
        $subscription_key,
        $agreement_id
    ) {
        parent::__construct($vipps, $subscription_key);
        $this->id = $agreement_id;
    }

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\Charge[]
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\Charge[] $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                sprintf("array<%s>", Charge::class),
                'json'
            );

        return $responseObject;
    }
}
