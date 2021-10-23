<?php

namespace zaporylie\Vipps\Model\RecurringPayment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ResponseCreateAgreement
 *
 * @package Vipps\Model\RecurringPayment
 */
class ResponseCreateAgreement
{

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $agreementResource;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $agreementId;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $vippsConfirmationUrl;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $chargeId;

    /**
     * Gets agreementResource value.
     *
     * @return string
     */
    public function getAgreementResource()
    {
        return $this->agreementResource;
    }

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
     * Gets vippsConfirmetionUrl value.
     *
     * @return string
     */
    public function getVippsConfirmationUrl()
    {
        return $this->vippsConfirmationUrl;
    }

    /**
     * Gets chargeId value.
     *
     * @return string
     */
    public function getChargeId()
    {
        return $this->chargeId;
    }
}
