<?php

namespace zaporylie\Vipps\Authentication;

use zaporylie\Vipps\Model\Authorization\ResponseGetToken;

/**
 * Interface TokenStorageInterface
 *
 * @package Vipps\Authentication
 */
interface TokenStorageInterface
{

    /**
     * @return \zaporylie\Vipps\Model\Authorization\ResponseGetToken
     * @throws \zaporylie\Vipps\Exceptions\Authentication\InvalidArgumentException
     */
    public function get();

    /**
     * @param \zaporylie\Vipps\Model\Authorization\ResponseGetToken $token
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
