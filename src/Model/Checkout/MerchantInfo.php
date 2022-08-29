<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class MerchantInfo.
 *
 * @package Vipps\Model\Checkout
 */
class MerchantInfo
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $callbackPrefix;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $returnUrl;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $callbackAuthorizationToken;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $termsAndConditionsUrl;

    /**
     * Gets callback prefix.
     *
     * @return string
     */
    public function getCallbackPrefix(): string
    {
        return $this->callbackPrefix;
    }

    /**
     * Sets callback prefix.
     *
     * @param string $callback_prefix
     *
     * @return $this
     */
    public function setCallbackPrefix(string $callback_prefix): MerchantInfo
    {
        $this->callbackPrefix = $callback_prefix;
        return $this;
    }

    /**
     * Gets return url.
     *
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

  /**
   * Sets return url.
   *
   * @param string $url
   *
   * @return $this
   */
    public function setReturnUrl(string $url): MerchantInfo
    {
        $this->returnUrl = $url;
        return $this;
    }

    /**
     * Gets callback authorization token.
     *
     * @return string
     */
    public function getCallbackAuthorizationToken(): string
    {
        return $this->callbackAuthorizationToken;
    }

    /**
     * Sets callback authorization token.
     *
     * @param string $token
     *
     * @return $this
     */
    public function setCallbackAuthorizationToken(string $token): MerchantInfo
    {
        $this->callbackAuthorizationToken = $token;
        return $this;
    }

    /**
     * Gets terms and conditions url.
     *
     * @return string
     */
    public function getTermsAndConditionsUrl(): string
    {
        return $this->termsAndConditionsUrl;
    }

    /**
     * Sets terms and conditions url.
     *
     * @param string $url
     *
     * @return $this
     */
    public function setTermsAndConditionsUrl(string $url): MerchantInfo
    {
        $this->termsAndConditionsUrl = $url;
        return $this;
    }
}
