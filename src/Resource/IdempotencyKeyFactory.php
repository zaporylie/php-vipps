<?php

namespace zaporylie\Vipps\Resource;

/**
 * Class RequestIdFactory
 *
 * @package Vipps\Resource
 */
abstract class IdempotencyKeyFactory
{

    /**
     * Generates unique 23 character long ID.
     *
     * @return string
     */
    public static function generate(): string
    {
        return uniqid('', true);
    }
}
