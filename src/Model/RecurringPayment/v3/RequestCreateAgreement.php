<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreementBase;
use JMS\Serializer\Annotation as Serializer;


/**
 * Class RequestCreateAgreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class RequestCreateAgreement extends RequestCreateAgreementBase
{
    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest")
     */
    protected $campaign;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\Pricing
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\Pricing")
     */
    protected $pricing;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $phoneNumber;

    //TODO: Check if this is changed in v3
    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\InitialCharge
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\InitialCharge")
     */
    protected $initialCharge;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\Period
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\Period")
     */
    protected $interval;

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
     * @var bool
     * @Serializer\Type("boolean")
     */
    protected $skipLandingPage;
    
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $externalId;
   
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $countryCode;
   
    /**
     * Sets campaign variable.
     *
     * @param \zaporylie\Vipps\Model\RecurringPayment\v3\CampaignRequest $campaign
     *
     * @return $this
     */
    public function setCampaign(CampaignRequest $campaign)
    {
        $this->campaign = $campaign;
        return $this;
    }

    /**
     * Set the value of pricing
     *
     * @param  \zaporylie\Vipps\Model\RecurringPayment\v3\Pricing  $pricing
     *
     * @return  self
     */ 
    public function setPricing(\zaporylie\Vipps\Model\RecurringPayment\v3\Pricing $pricing)
    {
        $this->pricing = $pricing;
        return $this;
    }

    /**
     * Sets phoneNumber variable.
     *
     * @param string $phoneNumber
     *
     * @return $this
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * Sets initialCharge variable.
     *
     * @param \zaporylie\Vipps\Model\RecurringPayment\InitialCharge $initialCharge
     *
     * @return $this
     */
    public function setInitialCharge(\zaporylie\Vipps\Model\RecurringPayment\InitialCharge $initialCharge)
    {
        $this->initialCharge = $initialCharge;
        return $this;
    }

    /**
     * Sets interval variable.
     *
     * @param \zaporylie\Vipps\Model\RecurringPayment\v3\Period $interval
     *
     * @return $this
     */
    public function setInterval(\zaporylie\Vipps\Model\RecurringPayment\v3\Period $interval)
    {
        $this->interval = $interval;
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

    /**
     * Set the value of skipLandingPage
     *
     * @param  bool  $skipLandingPage
     *
     * @return  self
     */ 
    public function setSkipLandingPage($skipLandingPage)
    {
        $this->skipLandingPage = $skipLandingPage;

        return $this;
    }

    /**
     * Set the value of externalId
     *
     * @param  string  $externalId
     *
     * @return  self
     */ 
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * Set the value of countryCode
     *
     * @param  string  $countryCode
     *
     * @return  self
     */ 
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;

        return $this;
    }
}
