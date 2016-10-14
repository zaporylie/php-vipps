<?php

/**
 * Vipps exception.
 *
 * Provides and handles invalid request exception.
 */

namespace Vipps\Exceptions;

/**
 * Class InvalidRequestException
 * @package Vipps\Exceptions
 */
class InvalidRequestException extends VippsException
{
    /**
     * @var string
     */
    protected $errorCode = '';

    /**
     * InvalidRequestException constructor.
     * @param string $message
     * @param string $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = '', \Exception $previous = null)
    {
        parent::__construct($message, 0, $previous);
        $this->code = $code;
    }
}
