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
}
