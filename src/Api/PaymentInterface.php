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
     *
     * @deprecated Get order status was deprecated and can be removed in version 3.0.
     * @see \zaporylie\Vipps\Resource\Payment\GetOrderStatus
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
     * @param int $amount
     * @param string $text
     * @param string $callbackPrefix
     * @param string $fallback
     * @param $options array
     *   Optional values.
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseInitiatePayment
     *
     * @see https://vippsas.github.io/vipps-ecom-api/#/Vipps_eCom_API/initiatePaymentV3UsingPOST
     */
    public function initiatePayment($order_id, $amount, $text, $callbackPrefix, $fallback, $options = []);

    /**
     * @param string $order_id
     * @param string $text
     * @param int $amount
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseRefundPayment
     */
    public function refundPayment($order_id, $text, $amount = 0);
}
