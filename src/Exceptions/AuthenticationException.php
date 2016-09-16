<?php

namespace Vipps\Exceptions;

class AuthenticationException extends VippsException
{
    static public $codes = [
        01 => "Provided credentials doesn't match"
    ];
}
