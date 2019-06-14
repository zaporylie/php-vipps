<?php

namespace zaporylie\Vipps\Model;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerInterface;

trait CreateFromStringTrait
{
    /**
     * {@inheritdoc}
     */
    public static function createFromString($string, SerializerInterface $serializer = null)
    {
        if (!isset($serializer) && in_array(SupportsSerializationInterface::class, class_implements(static::class))) {
            AnnotationRegistry::registerLoader('class_exists');
            $serializer = static::getSerializer();
        } elseif (!isset($serializer)) {
            throw new \InvalidArgumentException(sprintf('Missing %s', SerializerInterface::class));
        }
        return $serializer->deserialize(
            $string,
            static::class,
            'json'
        );
    }
}
