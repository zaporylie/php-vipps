<?php

namespace zaporylie\Vipps\Model;

use JMS\Serializer\SerializerInterface;

interface ToStringInterface
{
    /**
     * @return string
     */
    public function toString();
}
