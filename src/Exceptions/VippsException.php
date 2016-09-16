<?php

namespace Vipps\Exceptions;

class VippsException extends \Exception
{
    /**
     * Initiate code description array.
     *
     * @var array
     */
    static public $codes = [];

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
    public function __construct($message = '', $code = 0, \Exception $previous = NULL)
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
    public function setErrorResponse($content) {

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
                return new AuthenticationException($this->errorMessage, $this->errorCode, $this, $this->errorCode, $this->errorGroup, $this->errorMessage);

            case 'Payment':
                return new AuthenticationException($this->errorMessage, $this->errorCode, $this, $this->errorCode, $this->errorGroup, $this->errorMessage);

            case 'InvalidRequest':
                return new InvalidRequestException($this->errorMessage, $this->errorCode, $this, $this->errorCode, $this->errorGroup, $this->errorMessage);

            case 'ViPPSError':
                return new ViPPSErrorException($this->errorMessage, $this->errorCode, $this, $this->errorCode, $this->errorGroup, $this->errorMessage);

            case 'Customer':
                return new CustomerException($this->errorMessage, $this->errorCode, $this, $this->errorCode, $this->errorGroup, $this->errorMessage);

            case 'Merchant':
                return new MerchantException($this->errorMessage, $this->errorCode, $this, $this->errorCode, $this->errorGroup, $this->errorMessage);

            default:
                return $this;
        }
    }

    /**
     * @param $code
     * @return null
     */
    static public function getErrorCodeDescription($code = 0) {
        if (isset($codes[$code])) {
            return $codes[$code];
        }
        return NULL;
    }

}
