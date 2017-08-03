<?php

namespace zaporylie\Vipps\Authentication;

use zaporylie\Vipps\Exceptions\Authentication\InvalidArgumentException;
use zaporylie\Vipps\Model\Authorization\ResponseGetToken;

/**
 * Class TokenMemoryCacheStorage
 *
 * @package Vipps\Authentication
 */
class TokenMemoryCacheStorage implements TokenStorageInterface
{

    /**
     * @var \zaporylie\Vipps\Model\Authorization\ResponseGetToken
     */
    protected $token;

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        if (!$this->has()) {
            throw new InvalidArgumentException('Missing Token');
        }
        return $this->token;
    }

    /**
     * {@inheritdoc}
     */
    public function set(ResponseGetToken $token)
    {
        $this->token = $token;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has()
    {
        if (!($this->token instanceof ResponseGetToken)) {
            return false;
        }

        if ($this->token->getExpiresOn()->getTimestamp() < (new \DateTime())->getTimestamp()) {
            $this->delete();
            return false;
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function delete()
    {
        $this->token = null;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->delete();
        return $this;
    }
}
