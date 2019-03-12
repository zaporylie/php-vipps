<?php

namespace zaporylie\Vipps\Model;

use JMS\Serializer\SerializerInterface;

interface CreateFromStringInterface
{
    /**
     * @param string $string
     * @param SerializerInterface|null $serializer
     * @return mixed
     */
    public static function createFromString($string, SerializerInterface $serializer = null);
}
