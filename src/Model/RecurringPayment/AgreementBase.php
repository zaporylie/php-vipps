<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class AgreementBase
 *
 * @package Vipps\Model\RecurringPayment
 */
class AgreementBase
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $id;

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
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $start;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'Y-m-d\TH:i:s\Z'>")
     */
    protected $stop;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $status;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $sub;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $userinfoUrl;

    /**
     * @var string[]
     * @Serializer\Type("array<string>")
     */
    protected $tags;

    /**
     * Gets id value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets productDescription value.
     *
     * @return string
     */
    public function getProductDescription()
    {
        return $this->productDescription;
    }

    /**
     * Gets start value.
     *
     * @return string
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Gets stop value.
     *
     * @return string
     */
    public function getStop()
    {
        return $this->stop;
    }

    /**
     * Gets productName value.
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Gets status value.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Gets sub value.
     *
     * @return string
     */
    public function getSub()
    {
        return $this->sub;
    }

    /**
     * Gets tags value.
     *
     * @return string[]
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Gets userInfoUrl value.
     *
     * @return string
     */
    public function getUserInfoUrl()
    {
        return $this->userinfoUrl;
    }
}
