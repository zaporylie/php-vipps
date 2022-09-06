<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class AmountBase.
 *
 * @package Vipps\Model\Checkout
 */
abstract class AmountBase
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $currency;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $value;

    /**
     * Gets amount currency.
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Gets amount value.
     *
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }
}
