<?php

namespace Vipps\Exceptions;

class CustomerException extends VippsException
{
    static public $codes = [
        81 => "User Not registered with vipps",
    ];
}
