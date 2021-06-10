<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement;

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

//    /**
//     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreements
//     */
//    public function getAgreements();
//
    /**
     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreement
     */
    public function getAgreement($agreement_id);
//
//    /**
//     * @return \zaporylie\Vipps\Model\RecurringPayment\ResponseGetAgreements
//     */
//    public function updateAgreement($agreement_id);

}
