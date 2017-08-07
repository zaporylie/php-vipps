<?php

namespace zaporylie\Vipps\Model;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class OrderStatus
 *
 * @todo: Currently this package is not used anywhere in the project. Use it for
 * reference and comparision only.
 *
 * @package Vipps\Model
 */
class OrderStatus extends AbstractEnumeration
{
    const INITIATE = 'INITIATE';
    const REGISTER = 'REGISTER';
    const RESERVE = 'RESERVE';
    const SALE = 'SALE';
    const CANCEL = 'CANCEL';
    const VOID = 'VOID';
    const AUTOREVERSAL = 'AUTOREVERSAL';
    const AUTOCANCEL = 'AUTOCANCEL';
    const FAILED = 'FAILED';
    const REJECTED = 'REJECTED';
}
