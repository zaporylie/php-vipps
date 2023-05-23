<?php

namespace zaporylie\Vipps\Model\RecurringPayment\v3;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class Period.
 *
 * @package Vipps\Model\RecurringPayment
 */
class Period
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $unit;

    /**
     * @var int
     * @Serializer\Type("integer")
     */
    protected $count;

    /**
     * Sets unit variable.
     *
     * @param string $unit
     *
     * @return $this
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;
        return $this;
    }

    /**
     * Sets count variable.
     *
     * @param int $count
     *
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

}
