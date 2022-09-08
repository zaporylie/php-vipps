<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseGetSessionDetails.
 *
 * @package Vipps\Model\Checkout
 */
class ResponseGetSessionDetails
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $sessionId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $reference;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $sessionState;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $paymentMethod;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\PaymentDetails
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\PaymentDetails")
     */
    protected $paymentDetails;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\ShippingDetails
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\ShippingDetails")
     */
    protected $shippingDetails;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\BillingDetails
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\BillingDetails")
     */
    protected $billingDetails;

    /**
     * Gets session id.
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Gets reference.
     *
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Gets session state.
     *
     * @return string
     */
    public function getSessionState(): string
    {
        return $this->sessionState;
    }

    /**
     * Gets payment method.
     *
     * @return string
     */
    public function getPaymentMethod(): string
    {
        return $this->paymentMethod;
    }

    /**
     * Gets payment details.
     *
     * @return \zaporylie\Vipps\Model\Checkout\PaymentDetails
     */
    public function getPaymentDetails(): PaymentDetails
    {
        return $this->paymentDetails;
    }

    /**
     * Gets shipping details.
     *
     * @return \zaporylie\Vipps\Model\Checkout\ShippingDetails
     */
    public function getShippingDetails(): ShippingDetails
    {
        return $this->shippingDetails;
    }

    /**
     * Gets billing details.
     *
     * @return \zaporylie\Vipps\Model\Checkout\BillingDetails
     */
    public function getBillingDetails(): BillingDetails
    {
        return $this->billingDetails;
    }
}
