<?php

namespace zaporylie\Vipps\Model;

use JMS\Serializer\SerializerInterface;

interface CreateFromStringInterface
{
    /**
     * @param string $string
     * @param SerializerInterface|null $serializer
     * @return static
     */
    public static function createFromString($string, SerializerInterface $serializer = null);
}
