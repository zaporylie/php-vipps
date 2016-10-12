<?php

namespace Vipps\Data;

class DataTime extends \DateTime implements \JsonSerializable
{
    /**
     * Default format for DataTime used by VIPPS is ISO8601.
     * @return string
     */
    public function jsonSerialize()
    {
        return $this->format(self::ISO8601);
    }

    /**
     * Default format for DataTime used by VIPPS is ISO8601.
     * @return string
     */
    public function __toString()
    {
        return $this->format(self::ISO8601);
    }
}
