<?php

namespace Vipps\Exceptions;

class ViPPSErrorException extends VippsException
{
    static public $codes = [
        99 => "Internal error",
    ];
}
