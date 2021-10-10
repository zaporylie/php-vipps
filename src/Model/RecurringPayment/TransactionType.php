<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class TransactionType
 *
 * @todo: Currently this package is not used anywhere in the project. Use it for
 * reference and comparison only.
 *
 * @package Vipps\Model\RecurringPayment
 */
class TransactionType extends AbstractEnumeration
{
    const DIRECT_CAPTURE = 'DIRECT_CAPTURE';
    const RESERVE_CAPTURE = 'RESERVE_CAPTURE';
}
