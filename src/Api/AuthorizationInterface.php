<?php
/**
 * Created by PhpStorm.
 * User: zaporylie
 * Date: 24.07.17
 * Time: 14:54
 */

namespace Vipps\Api;

interface AuthorizationInterface
{

    /**
     * @param string $client_id
     * @param string $client_secret
     *
     * @return \Vipps\Model\Authorization\ResponseGetToken
     */
    public function getToken($client_id, $client_secret);
}
