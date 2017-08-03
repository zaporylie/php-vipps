<?php

namespace zaporylie\Vipps\Resource;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class HttpMethod
 *
 * Enum class.
 *
 * @package Vipps\Resource
 */
class HttpMethod extends AbstractEnumeration
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
}
