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

    public function initiatePayment();

    public function refundPayment();
}
