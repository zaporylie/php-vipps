<?php

namespace zaporylie\Vipps\Resource\RecurringPayment;

use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;
use JMS\Serializer\Naming\SerializedNameAnnotationStrategy;
use JMS\Serializer\SerializerBuilder;
use zaporylie\Vipps\Resource\AuthorizedResourceBase;
use zaporylie\Vipps\Resource\IdempotencyKeyFactory;
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
     * @var int
     */
    protected $api_endpoint_version;

    /**
     * {@inheritdoc}
     */
    public function __construct(\zaporylie\Vipps\VippsInterface $vipps, $api_endpoint_version, $subscription_key)
    {
        parent::__construct($vipps, $subscription_key);
        $this->api_endpoint_version = $api_endpoint_version;

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

        $this->headers['Idempotency-Key'] = IdempotencyKeyFactory::generate();
    }


    /**
     * {@inheritdoc}
     *
     * All occurrences of {charge_id} pattern will be replaced with $this->id
     * All occurrances of {api_endpoint_version} will be replaced by $this->api_endpoint_version
     */
    public function getPath()
    {
        $path = parent::getPath();
        // If charge_id is set replace {charge_id} pattern with model's charge_id.
        if (isset($this->charge_id)) {
            $path = str_replace('{charge_id}', strval($this->charge_id), $path);
        }

        //If API Endpoint is set replace {api_endpoint_version} pattern with 
        if (isset($this->api_endpoint_version)) {
            $path = str_replace('{api_endpoint_version}', $this->api_endpoint_version, $path);
        }
        return $path;
    }
}
