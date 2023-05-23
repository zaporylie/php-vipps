<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use zaporylie\Vipps\Model\RecurringPayment\Charge;
use zaporylie\Vipps\Resource\HttpMethod;

/**
 * Class GetCharge
 *
 * @package Vipps\Resource\RecurringPayment
 */
class GetCharge extends RecurringPaymentResourceBase
{

    /**
     * @var \zaporylie\Vipps\Resource\HttpMethod
     */
    protected $method = HttpMethod::GET;

    /**
     * @var string
     */
    protected $path = '/recurring/v{api_endpoint_version}/agreements/{id}/charges/{charge_id}';

    public function __construct(
        \zaporylie\Vipps\VippsInterface $vipps,
        $api_endpoint_version,
        $subscription_key,
        $agreement_id,
        $charge_id
    ) {
        parent::__construct($vipps, $api_endpoint_version, $subscription_key);
        $this->id = $agreement_id;
        $this->charge_id = $charge_id;
    }

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\Charge
     */
    public function call()
    {
        $response = $this->makeCall();
        $body = $response->getBody()->getContents();
        /** @var \zaporylie\Vipps\Model\RecurringPayment\Charge $responseObject */
        $responseObject = $this
            ->getSerializer()
            ->deserialize(
                $body,
                Charge::class,
                'json'
            );

        return $responseObject;
    }
}
