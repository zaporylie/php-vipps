<?php

/**
 * Resource interface.
 *
 * Defines what methods should be implemented by resource.
 */

namespace Vipps\Resource;

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
     */
    public function getPath();

    /**
     * HTTP method.
     *
     * @return \Vipps\Resource\HttpMethod
     */
    public function getMethod();

    /**
     * HTTP headers.
     *
     * @return array
     */
    public function getHeaders();

    /**
     * @return mixed
     */
    public function call();
}
