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
     * Return URI for resource. Path should start with trailing slash.
     *
     * @return mixed
     */
    public function getResourcePath();

    /**
     * Return last response from VIPPS API.
     *
     * @return mixed
     */
    public function getLastResponse();
}
