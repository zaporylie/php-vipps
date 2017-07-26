<?php

namespace Vipps\Resource;

use Eloquent\Enumeration\AbstractEnumeration;

class HttpMethod extends AbstractEnumeration
{
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
}
