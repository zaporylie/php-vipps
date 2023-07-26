<?php

/**
 * Resource interface.
 *
 * Defines what methods should be implemented by resource.
 */

namespace zaporylie\Vipps\Resource;

/**
 * Interface ResourceInterface
 * @package Vipps\Resources
 */
interface ResourceInterface
{
    /**
     * Return URI for resource.
     *
     * Path should start with trailing slash.
     *
     * @return string
     * @throws \LogicException
     */
    public function getPath(): string;

    /**
     * HTTP method.
     *
     * @return \zaporylie\Vipps\Resource\HttpMethod
     * @throws \LogicException
     */
    public function getMethod(): HttpMethod;

    /**
     * HTTP headers.
     *
     * @return array
     * @throws \LogicException
     */
    public function getHeaders(): array;

    /**
     * @return mixed
     */
    public function call();
}
