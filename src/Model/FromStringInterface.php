<?php

namespace zaporylie\Vipps\Model;

use JMS\Serializer\SerializerInterface;

interface FromStringInterface
{
    /**
     * @param string $string
     * @param SerializerInterface|null $serializer
     * @return static
     */
    public static function fromString($string, SerializerInterface $serializer = null);
}
