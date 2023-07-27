<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\RecurringPayment\Charge;
use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement;
use zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\RequestRefundCharge;
use zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreement;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCreateAgreement;
use zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement;
use zaporylie\Vipps\Model\RecurringPayment\ResponseUpdateAgreement;

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
    public function createAgreement(RequestCreateAgreement $requestCreateAgreement): ResponseCreateAgreement;

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement[]
     */
    public function getAgreements(): array;

    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement
     */
    public function getAgreement(string $agreement_id): ResponseGetAgreement;

    /**
     * @param $agreement_id
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestUpdateAgreement $request
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseUpdateAgreement
     */
    public function updateAgreement(string $agreement_id, RequestUpdateAgreement $request): ResponseUpdateAgreement;

    /**
     * @param $agreement_id
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\Charge[]
     */
    public function getCharges(string $agreement_id): array;

    /**
     * @param $agreement_id
     * @param $charge_id
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\Charge
     */
    public function getCharge(string $agreement_id, string $charge_id): Charge;

    /**
     * @param $agreement_id
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge $request
     *
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseCreateCharge
     */
    public function createCharge(string $agreement_id, RequestCreateCharge $request): ResponseCreateCharge;

    /**
     * @param string $agreement_id
     * @param string $charge_id
     *
     * @return string
     */
    public function cancelCharge(string $agreement_id, string $charge_id): string;

    /**
     * @param string $agreement_id
     * @param string $charge_id
     *
     * @return string
     */
    public function captureCharge(string $agreement_id, string $charge_id): string;

    /**
     * @param string $agreement_id
     * @param string $charge_id
     * @param \zaporylie\Vipps\Model\RecurringPayment\RequestRefundCharge $requestObject
     *
     * @return string
     */
    public function refundCharge(string $agreement_id, string $charge_id, RequestRefundCharge $requestObject): string;
}
