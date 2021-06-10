<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use Eloquent\Enumeration\AbstractEnumeration;

/**
 * Class Status
 *
 * @todo: Currently this package is not used anywhere in the project. Use it for
 * reference and comparison only.
 *
 * @package Vipps\Model\RecurringPayment
 */
class Status extends AbstractEnumeration
{
    const PENDING = 'PENDING';
    const ACTIVE = 'ACTIVE';
    const STOPPED = 'STOPPED';
    const EXPIRED = 'EXPIRED';
}
