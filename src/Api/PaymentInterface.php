<?php
/**
 * Created by PhpStorm.
 * User: zaporylie
 * Date: 24.07.17
 * Time: 14:52
 */

namespace Vipps\Api;

interface PaymentInterface
{

    public function cancelPayment();

    public function capturePayment();

    public function getOrderStatus();

    public function getPaymentDetails();

    /**
     * @param $order_id
     * @param $mobile_number
     * @param $amount
     * @param $text
     * @param $callback
     * @param null $refOrderID
     *
     * @return \Vipps\Model\Payment\ResponseInitiatePayment
     */
    public function initiatePayment($order_id, $mobile_number, $amount, $text, $callback, $refOrderID = null);

    public function refundPayment();
}
