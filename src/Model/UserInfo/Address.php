<?php

namespace zaporylie\Vipps\Model\UserInfo;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Address
 *
 * @package Vipps\Model\UserInfo
 */
class Address
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $address_type;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $street_address;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $region;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $country;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $postal_code;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $formatted;

    /**
     * Gets address_type value.
     *
     * @return string
     */
    public function getAddressType()
    {
        return $this->address_type;
    }

    /**
     * Gets street_address value.
     *
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->street_address;
    }

    /**
     * Gets region value.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Gets country value.
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Gets postal_code value.
     *
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Gets formatted value.
     *
     * @return string
     */
    public function getFormatted()
    {
        return $this->formatted;
    }
}
