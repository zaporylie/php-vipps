<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MerchantInfo
 *
 * @package Vipps\Model\Payment
 */
class MerchantInfo
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $authToken;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $merchantSerialNumber;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $callbackPrefix;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $fallBack;

    /**
     * @var string
     * @Serializer\Type("boolean")
     */
    protected $isApp;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $consentRemovalPrefix;

    /**
     * @var string ['eComm Regular Payment', 'eComm Express Payment']
     * @Serializer\Type("string")
     */
    protected $paymentType;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $shippingDetailsPrefix;

    /**
     * @return string
     */
    public function getAuthToken()
    {
        return $this->authToken;
    }

    /**
     * @param string $authToken
     *
     * @return $this
     */
    public function setAuthToken($authToken)
    {
        $this->authToken = $authToken;
        return $this;
    }

    /**
     * Gets merchantSerialNumber value.
     *
     * @return string
     */
    public function getMerchantSerialNumber()
    {
        return $this->merchantSerialNumber;
    }

    /**
     * Sets merchantSerialNumber variable.
     *
     * @param string $merchantSerialNumber
     *
     * @return $this
     */
    public function setMerchantSerialNumber($merchantSerialNumber)
    {
        $this->merchantSerialNumber = $merchantSerialNumber;
        return $this;
    }

    /**
     * Gets callBack value.
     *
     * @return string
     */
    public function getCallbackPrefix()
    {
        return $this->callbackPrefix;
    }

    /**
     * Sets callbackPrefix variable.
     *
     * @param string $callbackPrefix
     *
     * @return $this
     */
    public function setCallbackPrefix($callbackPrefix)
    {
        $this->callbackPrefix = $callbackPrefix;
        return $this;
    }

    /**
     * Gets consentRemovalPrefix value.
     *
     * @return string
     */
    public function getConsentRemovalPrefix()
    {
        return $this->consentRemovalPrefix;
    }

    /**
     * Sets consentRemovalPrefix variable.
     *
     * @param string $consentRemovalPrefix
     *
     * @return $this
     */
    public function setConsentRemovalPrefix($consentRemovalPrefix)
    {
        $this->consentRemovalPrefix = $consentRemovalPrefix;
        return $this;
    }

    /**
     * Gets fallBack value.
     *
     * @return string
     */
    public function getFallBack()
    {
        return $this->fallBack;
    }

    /**
     * Sets fallBack variable.
     *
     * @param string $fallBack
     *
     * @return $this
     */
    public function setFallBack($fallBack)
    {
        $this->fallBack = $fallBack;
        return $this;
    }

    /**
     * @return string
     */
    public function isApp()
    {
        return $this->isApp;
    }

    /**
     * @param string $isApp
     *
     * @return $this
     */
    public function setIsApp($isApp)
    {
        $this->isApp = $isApp;

        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param string $paymentType
     *
     * @return $this
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingDetailsPrefix()
    {
        return $this->shippingDetailsPrefix;
    }

    /**
     * @param string $shippingDetailsPrefix
     *
     * @return $this
     */
    public function setShippingDetailsPrefix($shippingDetailsPrefix)
    {
        $this->shippingDetailsPrefix = $shippingDetailsPrefix;
        return $this;
    }
}
