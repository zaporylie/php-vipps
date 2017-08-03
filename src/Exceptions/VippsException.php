<?php

/**
 * Vipps exception.
 *
 * Provides and handles vipps exception.
 */

namespace zaporylie\Vipps\Exceptions;

use JMS\Serializer\Serializer;
use Psr\Http\Message\ResponseInterface;
use zaporylie\Vipps\Model\Error\AuthorizationError;
use zaporylie\Vipps\Model\Error\ErrorInterface;
use zaporylie\Vipps\Model\Error\PaymentError;

/**
 * Class VippsException
 * @package Vipps\Exceptions
 */
class VippsException extends \Exception
{

    /**
     * @var \zaporylie\Vipps\Model\Error\ErrorInterface
     */
    protected $error;

    /**
     * VippsException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Exception|null $previous
     * @param \zaporylie\Vipps\Model\Error\ErrorInterface|null $error
     */
    public function __construct($message = '', $code = 0, \Exception $previous = null, ErrorInterface $error = null)
    {
        parent::__construct($message, $code, $previous);
        $this->error = $error;
    }

    /**
     * @param string $phrase
     * @param \JMS\Serializer\Serializer|null $serializer
     *
     * @return object|array|integer|double|string|boolean
     */
    protected static function parsePhrase($phrase, $serializer = null)
    {
        if (!($serializer instanceof Serializer)) {
            return $phrase;
        }

        try {
            $decoded = json_decode($phrase, true);
            // Match AuthorizationError.
            if (isset($decoded['error'])) {
                return $serializer->deserialize(
                    $phrase,
                    AuthorizationError::class,
                    'json'
                );
            }
            // Match PaymentError collection.
            if (isset($decoded[0]['errorGroup'])) {
                $phrase = $serializer->deserialize(
                    $phrase,
                    'array<' . PaymentError::class . '>',
                    'json'
                );
                return reset($phrase);
            }
        } catch (\Exception $exception) {
            // Mute exceptions.
        }

        return $phrase;
    }

    /**
     * @return mixed
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Create new Exception from Response.
     *
     * @param ResponseInterface $response
     * @param \JMS\Serializer\Serializer|null $serializer
     * @param bool $force
     *
     * @return null|\zaporylie\Vipps\Exceptions\VippsException
     */
    public static function createFromResponse(
        ResponseInterface $response,
        $serializer = null,
        $force = true
    ) {

        // If error code tells us that something went wrong we must accept it.
        if (!$force && $response->getStatusCode() >= 400) {
            $force = true;
        }

        $phrase = $response->getBody()->getContents();
        $phrase = self::parsePhrase($phrase, $serializer);

        // If not an instance of ErrorInterface we must assume everything is ok.
        if (!$force && !($phrase instanceof ErrorInterface)) {
            // Rewind content pointer.
            $response->getBody()->rewind();
            return null;
        }

        // If Error can be parsed.
        if ($phrase instanceof ErrorInterface) {
            return new static(
                $phrase->getMessage(),
                $response->getStatusCode(),
                null,
                $phrase
            );
        }

        // If Error cannot be parsed.
        return new static(
            $phrase ?: $response->getReasonPhrase(),
            $response->getStatusCode()
        );
    }
}
