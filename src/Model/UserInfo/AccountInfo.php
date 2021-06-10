<?php

namespace zaporylie\Vipps\Model\UserInfo;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class AccountInfo
 *
 * @package Vipps\Model\UserInfo
 */
class AccountInfo
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $account_name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $account_number;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $bank_name;
}
