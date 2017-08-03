<?php

/**
 * Payment interface.
 *
 * Interface which defines payments.
 */

namespace zaporylie\Vipps\Resource;

/**
 * Interface PaymentsInterface
 * @package Vipps\Resources
 */
interface PaymentsInterface extends ResourceInterface
{

    /**
     * Set Order ID for payment.
     *
     * @param string $orderID
     * @return $this
     */
    public function setOrderID($orderID);

    /**
     * Create new payment.
     *
     * @param int $mobileNumber
     *   Mobile number for person registered in Vipps.
     * @param int $amount
     *   Amount in øre.
     * @param string $text
     *   Additional transaction text.
     * @param string $callback
     *   Callback absolute Url.
     * @param null $refOrderID
     *   (optional) Reference to previous order.
     * @return $this
     */
    public function create($mobileNumber, $amount, $text, $callback, $refOrderID = null);

    /**
     * Cancel payment.
     *
     * @param string $text
     * @return $this
     */
    public function cancel($text);

    /**
     * Capture payment.
     *
     * @param string $text
     *   Comment.
     * @param int $amount
     *   (optional) Amount in øre.
     * @return $this
     */
    public function capture($text, $amount = 0);

    /**
     * Refund payment.
     *
     * @param string $text
     *   Comment.
     * @param int $amount
     *   (optional) Amount in øre.
     * @return $this
     */
    public function refund($text, $amount = 0);

    /**
     * Get payment status.
     *
     * @return mixed
     */
    public function getStatus();

    /**
     * Get payment details.
     *
     * @return mixed
     */
    public function getDetails();
}
