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
     * @var float
     * @Serializer\Type("double")
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
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

}
