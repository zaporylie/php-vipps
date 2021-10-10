<?php

namespace zaporylie\Vipps\Model\UserInfo;

use JMS\Serializer\Annotation as Serializer;

class ResponseUserInfo
{
    /**
     * @var \zaporylie\Vipps\Model\UserInfo\AccountInfo[]
     * @Serializer\Type("array<zaporylie\Vipps\Model\UserInfo\AccountInfo>")
     */
    protected $accounts;

    /**
     * @var \zaporylie\Vipps\Model\UserInfo\Address
     * @Serializer\Type("zaporylie\Vipps\Model\UserInfo\Address")
     */
    protected $address;

    /**
     * @var \zaporylie\Vipps\Model\UserInfo\Address[]
     * @Serializer\Type("array<zaporylie\Vipps\Model\UserInfo\Address>")
     */
    protected $other_addresses;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $birthday;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     */
    protected $email_verified;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $family_name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $given_name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $nin;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $phone_number;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $sid;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $sub;

    /**
     * Gets accounts value.
     *
     * @return \zaporylie\Vipps\Model\UserInfo\AccountInfo[]
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Gets address value.
     *
     * @return \zaporylie\Vipps\Model\UserInfo\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Gets birthday value.
     *
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Gets email value.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Gets family_name value.
     *
     * @return string
     */
    public function getFamilyName()
    {
        return $this->family_name;
    }

    /**
     * Gets given_name value.
     *
     * @return string
     */
    public function getGivenName()
    {
        return $this->given_name;
    }

    /**
     * Gets name value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets nin value.
     *
     * @return string
     */
    public function getNin()
    {
        return $this->nin;
    }

    /**
     * Gets other_addresses value.
     *
     * @return \zaporylie\Vipps\Model\UserInfo\Address[]
     */
    public function getOtherAddresses()
    {
        return $this->other_addresses;
    }

    /**
     * Gets phone_number value.
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * Gets sid value.
     *
     * @return string
     */
    public function getSid()
    {
        return $this->sid;
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
}
