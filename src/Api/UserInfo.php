<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Resource\UserInfo\UserInfo as UserInfoResource;
use zaporylie\Vipps\VippsInterface;

/**
 * Class UserInfo
 *
 * @package Vipps\Api
 */
class UserInfo extends ApiBase implements UserInfoInterface
{

    /**
     * UserInfo constructor.
     *
     * @param \zaporylie\Vipps\VippsInterface $app
     */
    public function __construct(VippsInterface $app)
    {
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function userInfo($sub)
    {
        $resource = new UserInfoResource($this->app, $sub);
        /** @var \zaporylie\Vipps\Model\UserInfo\ResponseUserInfo $response */
        $response = $resource->call();
        return $response;
    }
}
