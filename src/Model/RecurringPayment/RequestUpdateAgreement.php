<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class RequestUpdateAgreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class RequestUpdateAgreement
{
    /**
     * @var \zaporylie\Vipps\Model\RecurringPayment\CampaignRequest
     * @Serializer\Type("zaporylie\Vipps\Model\RecurringPayment\CampaignRequest")
     */
    protected $campaign;

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
    protected $status;

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
}
