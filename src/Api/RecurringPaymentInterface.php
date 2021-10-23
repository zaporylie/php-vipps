<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement;
use zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\RequestRefundCharge;
use zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreement;

/**
 * Interface PaymentInterface
 *
 * @package Vipps\Api
 */
interface RecurringPaymentInterface
{

    /**
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateAgreement
     */
    public function createAgreement(RequestCreateAgreement $requestCreateAgreement);

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement[]
     */
    public function getAgreements();

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement
     */
    public function getAgreement($agreement_id);

    /**
     * @param $agreement_id
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreement $request
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseUpdateAgreement
     */
    public function updateAgreement($agreement_id, RequestUpdateAgreement $request);

    /**
     * @param $agreement_id
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\Charge[]
     */
    public function getCharges($agreement_id);

    /**
     * @param $agreement_id
     * @param $charge_id
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\Charge
     */
    public function getCharge($agreement_id, $charge_id);

    /**
     * @param $agreement_id
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge $request
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge
     */
    public function createCharge($agreement_id, RequestCreateCharge $request);

    /**
     * @param string $agreement_id
     * @param string $charge_id
     *
     * @return string
     */
    public function cancelCharge($agreement_id, $charge_id);

    /**
     * @param string $agreement_id
     * @param string $charge_id
     *
     * @return string
     */
    public function captureCharge($agreement_id, $charge_id);

    /**
     * @param string $agreement_id
     * @param string $charge_id
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestRefundCharge $requestObject
     *
     * @return string
     */
    public function refundCharge($agreement_id, $charge_id, RequestRefundCharge $requestObject);
}
