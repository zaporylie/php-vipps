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
    public function get(): ResponseGetToken
    {
        if (!$this->has()) {
            throw new InvalidArgumentException('Missing Token');
        }
        return $this->token;
    }

    /**
     * {@inheritdoc}
     */
    public function set(ResponseGetToken $token): TokenStorageInterface
    {
        $this->token = $token;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has(): bool
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
    public function delete(): TokenStorageInterface
    {
        $this->token = null;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function clear(): TokenStorageInterface
    {
        $this->delete();
        return $this;
    }
}
