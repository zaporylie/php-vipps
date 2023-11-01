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

    /**
     * Set the value of agreementId
     *
     * @param  string  $agreementId
     *
     * @return  self
     */ 
    public function setAgreementId(string $agreementId)
    {
        $this->agreementId = $agreementId;

        return $this;
    }
}
