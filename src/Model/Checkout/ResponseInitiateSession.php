<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseInitiateSession.
 *
 * @package Vipps\Model\Checkout
 */
class ResponseInitiateSession
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $token;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $checkoutFrontendUrl;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $pollingUrl;

    /**
     * Gets token.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Gets checkout frontend url.
     *
     * @return string
     */
    public function getCheckoutFrontendUrl(): string
    {
        return $this->checkoutFrontendUrl;
    }

    /**
     * Gets polling url.
     *
     * @return string
     */
    public function getPollingUrl(): string
    {
        return $this->pollingUrl;
    }
}
