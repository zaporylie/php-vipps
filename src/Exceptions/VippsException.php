<?php

/**
 * Vipps exception.
 *
 * Provides and handles vipps exception.
 */

namespace Vipps\Exceptions;

use Psr\Http\Message\ResponseInterface;
use Vipps\Model\Error\ErrorInterface;

/**
 * Class VippsException
 * @package Vipps\Exceptions
 */
class VippsException extends \Exception
{
    /**
     * Initiate code description array.
     *
     * @var array
     */
    static public $codes = [
        01 => "Provided credentials doesn't match",
        21 => "Reference Order ID is not valid",
        22 => "Reference Order ID is not in valid state",
        31 => "Merchant is blocked because of {}",
        32 => "Receiving limit of merchant has exceeded",
        33 => "Number of payment requests has been exceeded",
        34 => "Unique constraint violation of the order id",
        35 => "Requested Order not found",
        36 => "Merchant agreement not signed",
        37 => "Merchant not available or deactivated or blocked",
        41 => "User don’t have a valid card",
        42 => "Refused by issuer bank",
        43 => "Refused by issuer bank because of invalid amount",
        44 => "Refused by issuer because of expired card",
        45 => "Reservation failed for some unknown reason",
        51 => "Can't cancel already captured order",
        52 => "Cancellation failed",
        53 => "Can’t cancel order which is not reserved yet",
        61 => "Captured amount exceeds the reserved amount ordered",
        62 => "Can't capture cancelled order",
        63 => "Capture failed for some unknown reason, please use Get Payment Details API to know the exact status",
        71 => "Cant refund more than captured amount",
        72 => "Cant refund for reserved order, use cancellation API for the",
        73 => "Can't refund on cancelled order",
        74 => "Refund failed during debit from merchant account",
        81 => "User Not registered with vipps",
        82 => "User App Version is not supported",
        91 => "Transaction is not allowed",
        92 => "Transaction already processed",
        98 => "Too many concurrent requests",
        99 => "Internal error",
    ];

    /**
     * Error group.
     *
     * @var null
     */
    protected $errorGroup;

    /**
     * Error code.
     *
     * @var int
     */
    protected $errorCode = 0;

    /**
     * Error message.
     *
     * @var null
     */
    protected $errorMessage;

    /**
     * VippsException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null)
    {
        if ($previous instanceof VippsException) {
            $this->errorCode = $previous->getErrorCode();
            $this->errorGroup = $previous->getErrorGroup();
            $this->errorMessage = $previous->getErrorMessage();
        }
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return mixed
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @return mixed
     */
    public function getErrorGroup()
    {
        return $this->errorGroup;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

    /**
     * Create new Exception from Response.
     *
     * @param $response
     * @return self|null
     */
    public static function createFromResponse(ResponseInterface $response)
    {

        $content = $response->getBody()->getContents();

        // @todo: Match one of the error types.

        // @todo: Check if error.
        if (!($content instanceof ErrorInterface)) {
            // Rewind content pointer.
            $response->getBody()->rewind();
            return null;
        }

        // @todo: Create Exception of correct type.

        return new static();
    }

    /**
     * @param $code
     * @return null
     */
    public static function getErrorCodeDescription($code = 0)
    {
        if (isset($codes[$code])) {
            return $codes[$code];
        }
        return null;
    }
}
