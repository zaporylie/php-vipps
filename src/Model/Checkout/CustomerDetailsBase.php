<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class CustomerBase.
 *
 * @package Vipps\Model\Checkout
 */
abstract class CustomerDetailsBase
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $firstName;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $lastName;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $phoneNumber;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $streetAddress;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $postalCode;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $country;

    /**
     * Gets first name.
     *
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * Gets last name.
     *
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * Gets email.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets phone number.
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    /**
     * Gets street address.
     *
     * @return string
     */
    public function getStreetAddress(): string
    {
        return $this->streetAddress;
    }

    /**
     * Gets postal code.
     *
     * @return string
     */
    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    /**
     * Gets country.
     *
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}
