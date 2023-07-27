<?php

namespace zaporylie\Vipps\Model\UserInfo;

use JMS\Serializer\Annotation as Serializer;

final class ResponseUserInfo
{
    /**
     * @var \zaporylie\Vipps\Model\UserInfo\AccountInfo[]
     * @Serializer\Type("array<zaporylie\Vipps\Model\UserInfo\AccountInfo>")
     */
    protected array $accounts;

    /**
     * @var \zaporylie\Vipps\Model\UserInfo\Address
     * @Serializer\Type("zaporylie\Vipps\Model\UserInfo\Address")
     */
    protected Address $address;

    /**
     * @var \zaporylie\Vipps\Model\UserInfo\Address[]
     * @Serializer\Type("array<zaporylie\Vipps\Model\UserInfo\Address>")
     */
    protected array $other_addresses;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $birthdate;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $email;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     */
    protected bool $email_verified;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $family_name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $given_name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $nin;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $phone_number;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $sid;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $sub;

    /**
     * Gets accounts value.
     *
     * @return \zaporylie\Vipps\Model\UserInfo\AccountInfo[]
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * Gets address value.
     *
     * @return \zaporylie\Vipps\Model\UserInfo\Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * Gets birthdate value.
     *
     * @return string
     */
    public function getBirthdate(): string
    {
        return $this->birthdate;
    }

    /**
     * Gets email value.
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Gets family_name value.
     *
     * @return string
     */
    public function getFamilyName(): string
    {
        return $this->family_name;
    }

    /**
     * Gets given_name value.
     *
     * @return string
     */
    public function getGivenName(): string
    {
        return $this->given_name;
    }

    /**
     * Gets name value.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets nin value.
     *
     * @return string
     */
    public function getNin(): string
    {
        return $this->nin;
    }

    /**
     * Gets other_addresses value.
     *
     * @return \zaporylie\Vipps\Model\UserInfo\Address[]
     */
    public function getOtherAddresses(): array
    {
        return $this->other_addresses;
    }

    /**
     * Gets phone_number value.
     *
     * @return string
     */
    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    /**
     * Gets sid value.
     *
     * @return string
     */
    public function getSid(): string
    {
        return $this->sid;
    }

    /**
     * Gets sub value.
     *
     * @return string
     */
    public function getSub(): string
    {
        return $this->sub;
    }
}
