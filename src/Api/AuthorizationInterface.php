<?php
/**
 * Created by PhpStorm.
 * User: zaporylie
 * Date: 24.07.17
 * Time: 14:54
 */

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\Authorization\ResponseGetToken;

interface AuthorizationInterface
{

    /**
     * @param string $client_secret
     *
     * @return \zaporylie\Vipps\Model\Authorization\ResponseGetToken
     */
    public function getToken(string $client_secret): ResponseGetToken;
}
