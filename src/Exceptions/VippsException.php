<?php

namespace Vipps\Exceptions;

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
      31 => "Merchant is blocked because of {}",
      32 => "Receiving limit of merchant has exceeded",
      33 => "Number of payment requests has been exceeded",
      34 => "Unique constraint violation of the order id",
      35 => "Requested Order not found",
      36 => "Merchant agreement not signed",
      41 => "User don’t have a valid card",
      42 => "Refused by issuer bank",
      43 => "Refused by issuer bank because of invalid amount",
      44 => "Refused by issuer because of expired card",
      45 => "Reservation failed for some unknown reason",
      51 => "Can't cancel already captured order",
      61 => "Captured amount exceeds the reserved amount ordered",
      62 => "Can't capture cancelled order",
      63 => "Capture failed for some unknown reason, please use Get Payment Details API to know the exact status",
      71 => "Cant refund more than captured amount",
      72 => "Cant refund for reserved order, use cancellation API for the",
      73 => "Can't refund on cancelled order",
      81 => "User Not registered with vipps",
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
     * Set error response.
     *
     * @param $content
     * @return $this
     */
    public function setErrorResponse($content)
    {

        // Set errors.
        if (!is_array($content)) {
            return $this;
        }
        if (isset($content[0]->errorCode)) {
            $this->errorCode = (int)$content[0]->errorCode;
        }
        if (isset($content[0]->errorGroup)) {
            $this->errorGroup = $content[0]->errorGroup;
        }
        if (isset($content[0]->errorMessage)) {
            $this->errorMessage = $content[0]->errorMessage;
        }

        // If error has error group return correct exception type.
        switch ($this->errorGroup) {
            case 'Authentication':
                return new AuthenticationException(
                    $this->errorMessage,
                    $this->errorCode,
                    $this
                );

            case 'Payment':
                return new AuthenticationException(
                    $this->errorMessage,
                    $this->errorCode,
                    $this
                );

            case 'InvalidRequest':
                return new InvalidRequestException(
                    $this->errorMessage,
                    $this->errorCode,
                    $this
                );

            case 'ViPPSError':
                return new ViPPSErrorException(
                    $this->errorMessage,
                    $this->errorCode,
                    $this
                );

            case 'Customer':
                return new CustomerException(
                    $this->errorMessage,
                    $this->errorCode,
                    $this
                );

            case 'Merchant':
                return new MerchantException(
                    $this->errorMessage,
                    $this->errorCode,
                    $this
                );

            default:
                return $this;
        }
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
