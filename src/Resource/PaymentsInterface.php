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
    public function setOrderID(string $orderID): self;

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
     * @param string $fallback
     *   Fallback absolute Url.
     * @param string|null $refOrderID
     *   (optional) Reference to previous order.
     * @return $this
     */
    public function create(int $mobileNumber, int $amount, string $text, string $callback, string $fallback, string $refOrderID = null): self;

    /**
     * Cancel payment.
     *
     * @param string $text
     * @return $this
     */
    public function cancel(string $text): self;

    /**
     * Capture payment.
     *
     * @param string $text
     *   Comment.
     * @param int $amount
     *   (optional) Amount in øre.
     * @return $this
     */
    public function capture(string $text, int $amount = 0): self;

    /**
     * Refund payment.
     *
     * @param string $text
     *   Comment.
     * @param int $amount
     *   (optional) Amount in øre.
     * @return $this
     */
    public function refund(string $text, int $amount = 0): self;

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
