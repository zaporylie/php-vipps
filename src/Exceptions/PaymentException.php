<?php

namespace Vipps\Exceptions;

class PaymentException extends VippsException
{
    static public $codes = [
        41 => "User don’t have a valid card",
        42 => "Refused by issuer bank",
        43 => "Refused by issuer bank because of invalid amount",
        44 => "Refused by issuer because of expired card",
        45 => "Reservation failed for some unknown reason",
        51 => "Can't cancel already captured order",
        61 => "Captured amount exceeds the reserved amount ordered",
        62 => "Can't capture cancelled order",
        63 => "Capture failed for some unknown reason, please use Get Payment Details API to know the exact status",
        71 => "Cant refund more than captured amount",
        72 => "Cant refund for reserved order, use cancellation API for the",
        73 => "Can't refund on cancelled order",
    ];
}
