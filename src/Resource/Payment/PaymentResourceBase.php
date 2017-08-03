<?php

namespace zaporylie\Vipps\Resource\Payment;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use zaporylie\Vipps\Resource\AuthorizedResourceBase;
use zaporylie\Vipps\Resource\RequestIdFactory;

/**
 * Class PaymentResourceBase
 *
 * @package Vipps\Resource\Payment
 */
abstract class PaymentResourceBase extends AuthorizedResourceBase
{

    /**
     * {@inheritdoc}
     */
    public function __construct(\zaporylie\Vipps\VippsInterface $vipps, $subscription_key)
    {
        parent::__construct($vipps, $subscription_key);

        // Adjust serializer.
        $this->serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new SerializedNameAnnotationStrategy(new IdenticalPropertyNamingStrategy()))
            ->build();

        // Content type for all requests must be set.
        $this->headers['Content-Type'] = 'application/json';

        // Client ID must be set in X-App-Id header.
        $this->headers['X-App-Id'] = $this->app->getClient()->getClientId();

        // By default RequestID is different for each Resource object.
        $this->headers['X-Request-Id'] = RequestIdFactory::generate();

        // Timestamp is equal to current DateTime.
        $this->headers['X-TimeStamp'] = (new \DateTime())->format(\DateTime::ISO8601);

        // Autodiscover X-Source-Address from env.
        $this->headers['X-Source-Address'] = getenv('HTTP_CLIENT_IP')
            ?:getenv('HTTP_X_FORWARDED_FOR')
            ?:getenv('HTTP_X_FORWARDED')
            ?:getenv('HTTP_FORWARDED_FOR')
            ?:getenv('HTTP_FORWARDED')
            ?:getenv('REMOTE_ADDR')
            ?:gethostname();
    }
}
