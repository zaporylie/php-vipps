<?php

namespace Vipps\Resource\Payment;

use Vipps\Resource\AuthorizedResourceBase;
use Vipps\Resource\RequestIdFactory;

abstract class PaymentResourceBase extends AuthorizedResourceBase
{
    public function __construct(\Vipps\VippsInterface $vipps, $subscription_key)
    {
        parent::__construct($vipps);
        $this->headers['Content-Type'] = 'application/json';
        $this->headers['Ocp-Apim-Subscription-Key'] = $subscription_key;
        $this->headers['X-App-Id'] = $this->app->getClient()->getClientId();
        $this->headers['X-Request-Id'] = RequestIdFactory::generate();
        $this->headers['X-TimeStamp'] = (new \DateTime())->format(\DateTime::ISO8601);
        $this->headers['X-Source-Address'] = getenv('HTTP_CLIENT_IP')
            ?:getenv('HTTP_X_FORWARDED_FOR')
            ?:getenv('HTTP_X_FORWARDED')
            ?:getenv('HTTP_FORWARDED_FOR')
            ?:getenv('HTTP_FORWARDED')
            ?:getenv('REMOTE_ADDR')
            ?:gethostname();
    }
}
