<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Model\Payment\ResponseCancelPayment;
use zaporylie\Vipps\Model\Payment\ResponseCapturePayment;
use zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus;
use zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails;
use zaporylie\Vipps\Model\Payment\ResponseInitiatePayment;
use zaporylie\Vipps\Model\Payment\ResponseRefundPayment;

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
    public function cancelPayment(string $order_id, string $text): ResponseCancelPayment;

    /**
     * @param string $order_id
     * @param string $text
     * @param int $amount
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseCapturePayment
     */
    public function capturePayment(string $order_id, string $text, int $amount = 0): ResponseCapturePayment;

    /**
     * @param string $order_id
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus
     *
     * @deprecated Get order status was deprecated and can be removed in version 3.0.
     * @see \zaporylie\Vipps\Resource\Payment\GetOrderStatus
     */
    public function getOrderStatus(string $order_id): ResponseGetOrderStatus;

    /**
     * @param string $order_id
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails
     */
    public function getPaymentDetails(string $order_id): ResponseGetPaymentDetails;

    /**
     * @param string $order_id
     * @param int $amount
     * @param string $text
     * @param string $callbackPrefix
     * @param string $fallback
     * @param array $options
     *   Optional values.
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseInitiatePayment
     *
     * @see https://vippsas.github.io/vipps-ecom-api/#/Vipps_eCom_API/initiatePaymentV3UsingPOST
     */
    public function initiatePayment(string $order_id, int $amount, string $text, string $callbackPrefix, string $fallback, array $options = []): ResponseInitiatePayment;

    /**
     * @param string $order_id
     * @param string $text
     * @param int $amount
     *
     * @return \zaporylie\Vipps\Model\Payment\ResponseRefundPayment
     */
    public function refundPayment(string $order_id, string $text, int $amount = 0): ResponseRefundPayment;
}
