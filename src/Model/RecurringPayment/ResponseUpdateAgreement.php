<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseUpdateAgreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class ResponseUpdateAgreement
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $agreementId;

    /**
     * Gets agreementId value.
     *
     * @return string
     */
    public function getAgreementId()
    {
        return $this->agreementId;
    }
}
