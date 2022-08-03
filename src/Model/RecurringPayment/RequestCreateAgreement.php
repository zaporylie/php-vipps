<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class RequestCreateAgreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class RequestCreateAgreement
{
    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\CampaignRequest
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\CampaignRequest")
     */
    protected $campaign;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $currency;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $customerPhoneNumber;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\InitialCharge
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\InitialCharge")
     */
    protected $initialCharge;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $interval;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $intervalCount;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     */
    protected $isApp;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $merchantAgreementUrl;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $merchantRedirectUrl;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $price;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $productName;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $productDescription;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $scope;

    /**
     * Sets campaign variable.
     *
     * @param \zaporylie\Vipps\Model\RecurringPayment\CampaignRequest $campaign
     *
     * @return $this
     */
    public function setCampaign(CampaignRequest $campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }

    /**
     * Sets currency variable.
     *
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Sets customerPhoneNumber variable.
     *
     * @param string $customerPhoneNumber
     *
     * @return $this
     */
    public function setCustomerPhoneNumber($customerPhoneNumber)
    {
        $this->customerPhoneNumber = $customerPhoneNumber;
        return $this;
    }

    /**
     * Sets initialCharge variable.
     *
     * @param \zaporylie\Vipps\Model\RecurringPayment\InitialCharge $initialCharge
     *
     * @return $this
     */
    public function setInitialCharge(InitialCharge $initialCharge)
    {
        $this->initialCharge = $initialCharge;
        return $this;
    }

    /**
     * Sets interval variable.
     *
     * @param string $interval
     *
     * @return $this
     */
    public function setInterval($interval)
    {
        $this->interval = $interval;
        return $this;
    }

    /**
     * Sets intervalCount variable.
     *
     * @param int $intervalCount
     *
     * @return $this
     */
    public function setIntervalCount($intervalCount)
    {
        $this->intervalCount = $intervalCount;
        return $this;
    }

    /**
     * Sets isApp variable.
     *
     * @param bool $isApp
     *
     * @return $this
     */
    public function setIsApp($isApp)
    {
        $this->isApp = $isApp;
        return $this;
    }

    /**
     * Sets merchantAgreementUrl variable.
     *
     * @param string $merchantAgreementUrl
     *
     * @return $this
     */
    public function setMerchantAgreementUrl($merchantAgreementUrl)
    {
        $this->merchantAgreementUrl = $merchantAgreementUrl;
        return $this;
    }

    /**
     * Sets merchantRedirectUrl variable.
     *
     * @param string $merchantRedirectUrl
     *
     * @return $this
     */
    public function setMerchantRedirectUrl($merchantRedirectUrl)
    {
        $this->merchantRedirectUrl = $merchantRedirectUrl;
        return $this;
    }

    /**
     * Sets price variable.
     *
     * @param int $price
     *
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Sets productDescription variable.
     *
     * @param string $productDescription
     *
     * @return $this
     */
    public function setProductDescription($productDescription)
    {
        $this->productDescription = $productDescription;
        return $this;
    }

    /**
     * Sets productName variable.
     *
     * @param string $productName
     *
     * @return $this
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;
        return $this;
    }

    /**
     * Sets scope variable.
     *
     * @param string $scope
     *
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }
}
