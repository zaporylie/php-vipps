<?php

namespace zaporylie\Vipps\Api;

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
    public function userInfo($sub);
}
