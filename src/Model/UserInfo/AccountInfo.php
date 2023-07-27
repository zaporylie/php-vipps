<?php

namespace zaporylie\Vipps\Model\UserInfo;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class AccountInfo
 *
 * @package Vipps\Model\UserInfo
 */
final class AccountInfo
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $account_name;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $account_number;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected string $bank_name;

    /**
     * Gets account_name value.
     *
     * @return string
     */
    public function getAccountName(): string
    {
        return $this->account_name;
    }

    /**
     * Gets account_number value.
     *
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->account_number;
    }

    /**
     * Gets bank_name value.
     *
     * @return string
     */
    public function getBankName(): string
    {
        return $this->bank_name;
    }
}
