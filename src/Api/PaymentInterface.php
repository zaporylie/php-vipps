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

    /**
     * @param string $order_id
     *
     * @return \Vipps\Model\Payment\ResponseGetOrderStatus
     */
    public function getOrderStatus($order_id);

    /**
     * @param string $order_id
     *
     * @return \Vipps\Model\Payment\ResponseGetPaymentDetails
     */
    public function getPaymentDetails($order_id);

    /**
     * @param string $order_id
     * @param string $mobile_number
     * @param int $amount
     * @param string $text
     * @param string $callback
     * @param null $refOrderID
     *
     * @return \Vipps\Model\Payment\ResponseInitiatePayment
     */
    public function initiatePayment($order_id, $mobile_number, $amount, $text, $callback, $refOrderID = null);

    public function refundPayment();
}
