<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class PrefillCustomer.
 *
 * @package Vipps\Model\Checkout
 */
class PrefillCustomer extends CustomerDetailsBase
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $city;

    /**
     * Sets first name.
     *
     * @param string $first_name
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setFirstName(string $first_name): PrefillCustomer
    {
        $this->firstName = $first_name;
        return $this;
    }

    /**
     * Sets last name.
     *
     * @param string $last_name
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setLastName(string $last_name): PrefillCustomer
    {
        $this->lastName = $last_name;
        return $this;
    }

    /**
     * Sets email.
     *
     * @param string $email
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setEmail(string $email): PrefillCustomer
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Sets phone number.
     *
     * @param string $phone_number
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setPhoneNumber(string $phone_number): PrefillCustomer
    {
        $this->phoneNumber = $phone_number;
        return $this;
    }

    /**
     * Sets street address.
     *
     * @param string $street_address
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setStreetAddress(string $street_address): PrefillCustomer
    {
        $this->streetAddress = $street_address;
        return $this;
    }

    /**
     * Sets postal code.
     *
     * @param string $postal_code
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setPostalCode(string $postal_code): PrefillCustomer
    {
        $this->postalCode = $postal_code;
        return $this;
    }

    /**
     * Gets city.
     *
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * Sets city.
     *
     * @param string $city
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setCity(string $city): PrefillCustomer
    {
        $this->city = $city;
        return $this;
    }

    /**
     * Sets country.
     *
     * @param string $country
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function setCountry(string $country): PrefillCustomer
    {
        $this->country = $country;
        return $this;
    }

}
