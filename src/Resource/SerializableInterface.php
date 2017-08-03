<?php

namespace zaporylie\Vipps\Resource;

/**
 * Class ResourceBase
 *
 * @package Vipps\Resources
 */
interface SerializableInterface
{

    /**
     * Gets serializer value.
     *
     * @return \JMS\Serializer\Serializer
     */
    public function getSerializer();
}
