<?php

namespace Vipps\Data;

class DataTime extends \DateTime implements \JsonSerializable
{
    public function jsonSerialize()
    {
        return $this->format(self::ISO8601);
    }

    public function __toString()
    {
        return $this->format(self::ISO8601);
    }
}
