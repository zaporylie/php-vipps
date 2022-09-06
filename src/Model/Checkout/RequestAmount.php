<?php

namespace zaporylie\Vipps\Model\Checkout;

/**
 * Class RequestAmount.
 *
 * @package Vipps\Model\Checkout
 */
class RequestAmount extends AmountBase
{

    /**
     * Sets amount currency.
     *
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency(string $currency): RequestAmount
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * Sets amount value.
     *
     * @param int $value
     *
     * @return $this
     */
    public function setValue(int $value): RequestAmount
    {
        $this->value = $value;
        return $this;
    }
}
