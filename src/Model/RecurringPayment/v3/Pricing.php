<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Pricing.
 *
 * @package Vipps\Model\RecurringPayment
 */
class Pricing
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $type;

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
     * @var int
     * @Serializer\Type("int")
     */
    protected $suggestedMaxAmount;

    /**
     * Sets type variable.
     *
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Sets amount variable.
     *
     * @param int $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * Sets currency variable.
     *
     * @param string $currency
     *
     * @return $this
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
        return $this;
    }


    /**
     * Set the value of suggestedMaxAmount
     *
     * @param  int  $suggestedMaxAmount
     *
     * @return  self
     */ 
    public function setSuggestedMaxAmount($suggestedMaxAmount)
    {
        $this->suggestedMaxAmount = $suggestedMaxAmount;

        return $this;
    }
}
