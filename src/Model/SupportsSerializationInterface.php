<?php

namespace zaporylie\Vipps\Model;

use JMS\Serializer\SerializerInterface;

interface SupportsSerializationInterface
{
    /**
     * @return SerializerInterface $serializer
     */
    public static function getSerializer();
}
