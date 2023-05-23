<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

use zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreementBase;
use JMS\Serializer\Annotation as Serializer;

/**
 * Class RequestUpdateAgreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class RequestUpdateAgreement extends RequestUpdateAgreementBase
{
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
    protected $merchantAgreementUrl;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $externalId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $status;

    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\v3\Pricing
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\v3\Pricing")
     */
    protected $pricing;


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
     * Sets status variable.
     *
     * @param string $status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
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
}
