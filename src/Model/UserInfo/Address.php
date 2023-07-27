<?php

namespace zaporylie\Vipps\Model\UserInfo;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Address
 *
 * @package Vipps\Model\UserInfo
 */
final class Address
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $address_type;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $street_address;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $region;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $country;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $postal_code;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $formatted;

    /**
     * Gets address_type value.
     *
     * @return string
     */
    public function getAddressType(): string
    {
        return $this->address_type;
    }

    /**
     * Gets street_address value.
     *
     * @return string
     */
    public function getStreetAddress(): string
    {
        return $this->street_address;
    }

    /**
     * Gets region value.
     *
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * Gets country value.
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * Gets postal_code value.
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postal_code;
    }

    /**
     * Gets formatted value.
     *
     * @return string
     */
    public function getFormatted(): string
    {
        return $this->formatted;
    }
}
