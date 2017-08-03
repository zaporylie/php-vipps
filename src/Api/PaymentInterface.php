<?php

namespace zaporylie\Vipps\Api;

/**
 * Interface PaymentInterface
 *
 * @package Vipps\Api
 */
interface PaymentInterface
{

    /**
     * @param string $order_id
     * @param string $text
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseCancelPayment
     */
    public function cancelPayment($order_id, $text);

    /**
     * @param string $order_id
     * @param string $text
     * @param int $amount
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseCapturePayment
     */
    public function capturePayment($order_id, $text, $amount = 0);

    /**
     * @param string $order_id
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus
     */
    public function getOrderStatus($order_id);

    /**
     * @param string $order_id
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails
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
     * @return \zaporylie\Vipps\Model\Payment\ResponseInitiatePayment
     */
    public function initiatePayment($order_id, $mobile_number, $amount, $text, $callback, $refOrderID = null);

    /**
     * @param string $order_id
     * @param string $text
     * @param int $amount
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseRefundPayment
     */
    public function refundPayment($order_id, $text, $amount = 0);
}
