<?php

namespace zaporylie\Vipps\Resource\Checkout;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use zaporylie\Vipps\Resource\ResourceBase;
use zaporylie\Vipps\VippsInterface;

/**
 * Class CheckoutResourceBase.
 *
 * @package Vipps\Resource\Checkout
 */
abstract class CheckoutResourceBase extends ResourceBase
{

    /**
     * {@inheritdoc}
     */
    public function __construct(VippsInterface $vipps, string $subscription_key, string $client_secret)
    {
        parent::__construct($vipps, $subscription_key);

        // Adjust serializer.
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();

        // Client id and secret should be set in headers.
        $this->headers['client_id'] = $this->app->getClient()->getClientId();
        $this->headers['client_secret'] = $client_secret;

        // Content type for all requests must be set.
        $this->headers['Content-Type'] = 'application/json';
    }
}
