<?php

namespace zaporylie\Vipps\Model\Authorization;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseGetToken
 *
 * @package Vipps\Model\Authorization
 */
class ResponseGetToken
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $tokenType;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $expiresIn;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $extExpiresIn;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'U'>")
     */
    protected $expiresOn;

    /**
     * @var \DateTimeInterface
     * @Serializer\Type("DateTime<'U'>")
     */
    protected $notBefore;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $resource;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $accessToken;

    /**
     * Gets accessToken value.
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * Gets expiresIn value.
     *
     * @return int
     */
    public function getExpiresIn()
    {
        return $this->expiresIn;
    }

    /**
     * Gets expiresOn value.
     *
     * @return \DateTimeInterface
     */
    public function getExpiresOn()
    {
        return $this->expiresOn;
    }

    /**
     * Gets extExpiresIn value.
     *
     * @return int
     */
    public function getExtExpiresIn()
    {
        return $this->extExpiresIn;
    }

    /**
     * Gets notBefore value.
     *
     * @return \DateTimeInterface
     */
    public function getNotBefore()
    {
        return $this->notBefore;
    }

    /**
     * Gets resource value.
     *
     * @return string
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Gets tokenType value.
     *
     * @return string
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }
}
