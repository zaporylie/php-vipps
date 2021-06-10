<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Exceptions\Api\InvalidArgumentException;
use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement;
use zaporylie\Vipps\Resource\RecurringPayment\CreateAgreement;
use zaporylie\Vipps\Resource\RecurringPayment\GetAgreement;
use zaporylie\Vipps\VippsInterface;

/**
 * Class RecurringPayment
 *
 * @package Vipps\Api
 */
class RecurringPayment extends ApiBase implements RecurringPaymentInterface
{

    /**
     * @var string
     */
    protected $merchantSerialNumber;

    /**
     * Gets merchantSerialNumber value.
     *
     * @return string
     */
    public function getMerchantSerialNumber()
    {
        if (empty($this->merchantSerialNumber)) {
            throw new InvalidArgumentException('Missing merchant serial number');
        }
        return $this->merchantSerialNumber;
    }

    /**
     * Payment constructor.
     *
     * Payments API needs one extra param - merchant serial number.
     *
     * @param \zaporylie\Vipps\VippsInterface $app
     * @param string $subscription_key
     * @param $merchant_serial_number
     * @param $custom_path
     */
    public function __construct(
        VippsInterface $app,
        $subscription_key,
        $merchant_serial_number
    ) {
        parent::__construct($app, $subscription_key);
        $this->merchantSerialNumber = $merchant_serial_number;
    }

    /**
     * {@inheritdoc}
     */
    public function createAgreement(RequestCreateAgreement $request)
    {
        $resource = new CreateAgreement($this->app, $this->getSubscriptionKey(), $request);
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateAgreement $response */
        $response = $resource->call();
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getAgreement($agreement_id)
    {
        $resource = new GetAgreement($this->app, $this->getSubscriptionKey(), $agreement_id);
        /** @var \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement $response */
        $response = $resource->call();
        return $response;
    }
}
