<?php

namespace zaporylie\Vipps\Model;

use Doctrine\Common\Annotations\AnnotationRegistry;
use JMS\Serializer\SerializerInterface;

trait ToStringTrait
{
    /**
     * {@inheritdoc}
     */
    public function toString()
    {
        if (!isset($this->serializer) && ($this instanceof SupportsSerializationInterface)) {
            if (class_exists(AnnotationRegistry::class) && method_exists(AnnotationRegistry::class, 'registerLoader')) {
                AnnotationRegistry::registerLoader('class_exists');
            }
            $serializer = static::getSerializer();
        } elseif (!isset($this->serializer)) {
            throw new \InvalidArgumentException(sprintf('Missing %s', SerializerInterface::class));
        } else {
            $serializer = $this->serializer;
        }
        return $serializer->serialize(
            $this,
            'json'
        );
    }
}
