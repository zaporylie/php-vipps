<?php

namespace zaporylie\Vipps\Resource;

/**
 * Class RequestIdFactory
 *
 * @package Vipps\Resource
 */
abstract class RequestIdFactory
{

    /**
     * Generates unique 23 character long ID.
     *
     * @return string
     */
    public static function generate()
    {
        return uniqid('', true);
    }
}
