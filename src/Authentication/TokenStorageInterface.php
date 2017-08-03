<?php

namespace Vipps\Authentication;

use Vipps\Model\Authorization\ResponseGetToken;

/**
 * Interface TokenStorageInterface
 *
 * @package Vipps\Authentication
 */
interface TokenStorageInterface
{

    /**
     * @return \Vipps\Model\Authorization\ResponseGetToken
     * @throws \Vipps\Exceptions\Authentication\InvalidArgumentException
     */
    public function get();

    /**
     * @param \Vipps\Model\Authorization\ResponseGetToken $token
     *
     * @return self
     */
    public function set(ResponseGetToken $token);

    /**
     * @return bool
     */
    public function has();

    /**
     * @return self
     */
    public function delete();

    /**
     * @return self
     */
    public function clear();
}
