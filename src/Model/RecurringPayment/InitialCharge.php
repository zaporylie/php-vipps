<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class InitialCharge.
 *
 * @package Vipps\Model\RecurringPayment
 */
class InitialCharge
{
    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $amount;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $currency;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $description;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $transactionType;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $orderId;
}
