<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\UserInfo\ResponseUserInfo;

/**
 * Interface UserInfoInterface
 *
 * @package Vipps\Api
 */
interface UserInfoInterface
{

    /**
     * @param string $sub
     *
     * @return \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo
     */
    public function userInfo(string $sub): ResponseUserInfo;
}
