<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class RequestCancelSession.
 *
 * @package Vipps\Model\Checkout
 */
class RequestCancelSession
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $sessionId;

    /**
     * Gets session id.
     *
     * @return string
     */
    public function getSessionId(): string
    {
        return $this->sessionId;
    }

    /**
     * Sets session id.
     *
     * @param string $session_id
     *   Session id.
     *
     * @return \zaporylie\Vipps\Model\Checkout\RequestCancelSession
     */
    public function setSessionId(string $session_id): RequestCancelSession
    {
        $this->sessionId = $session_id;
        return $this;
    }
}
