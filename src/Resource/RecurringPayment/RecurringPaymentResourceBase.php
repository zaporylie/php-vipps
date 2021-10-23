<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

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
abstract class RecurringPaymentResourceBase extends AuthorizedResourceBase
{

    /**
     * @var string
     */
    protected $charge_id;

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

        // By default RequestID is different for each Resource object.
        $this->headers['X-Request-Id'] = RequestIdFactory::generate();

        // Timestamp is equal to current DateTime.
        $this->headers['X-TimeStamp'] = (new \DateTime())->format(\DateTime::ISO8601);
    }


    /**
     * {@inheritdoc}
     *
     * All occurrences of {id} pattern will be replaced with $this->id
     */
    public function getPath()
    {
        $path = parent::getPath();
        // If ID is set replace {id} pattern with model's ID.
        if (isset($this->charge_id)) {
            $path = str_replace('{charge_id}', $this->charge_id, $path);
        }
        return $path;
    }
}
