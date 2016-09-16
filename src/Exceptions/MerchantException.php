<?php

namespace Vipps\Exceptions;

class MerchantException extends VippsException
{
    static public $codes = [
        31 => "Merchant is blocked because of {}",
        32 => "Receiving limit of merchant has exceeded",
        33 => "Number of payment requests has been exceeded",
        34 => "Unique constraint violation of the order id",
        35 => "Requested Order not found",
        36 => "Merchant agreement not signed",
    ];
}
