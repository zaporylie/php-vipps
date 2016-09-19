<?php

namespace Vipps\Resources;

use Vipps\Data\DataTime;

class Payments extends AbstractResource implements ResourceInterface
{
    /**
     * @var string
     */
    private $orderID;

    /**
     * @return string
     */
    public function getResourceUri()
    {
        return 'payments';
    }

    /**
     * Set Order ID for payment.
     *
     * @param string $orderID
     * @return $this
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
        return $this;
    }

    /**
     * Create payment in VIPPS.
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
    public function create($mobileNumber, $amount, $text, $callback, $refOrderID = null)
    {
        $this->validation(__FUNCTION__);
        $payload = [];
        $payload += [
            'merchantInfo' => [
                'callBack' => $callback,
            ],
        ];
        $payload += [
            'customerInfo' => [
                'mobileNumber' => $mobileNumber,
            ],
        ];
        $payload += [
            'transaction' => [
                'orderId' => $this->orderID,
                'amount' => (int) $amount,
                'timeStamp' => (string) new DataTime(),
                'transactionText' => $text,
            ],
        ];
        // Add refOrderID if applicable.
        if (!empty($refOrderID)) {
            $payload['transaction']['refOrderId'] = $refOrderID;
        }
        $this->request(
            $this,
            'POST',
            '',
            $payload
        );
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function cancel($text)
    {
        $this->validation(__FUNCTION__);
        $payload = [
            'transaction' => [
                'transactionText' => $text,
            ],
        ];
        $this->request(
            $this,
            'PUT',
            $this->orderID . '/cancel',
            $payload
        );
        return $this;
    }

    /**
     * @param string $text
     *   Comment.
     * @param int $amount
     *   (optional) Amount in øre.
     * @return $this
     */
    public function capture($text, $amount = 0)
    {
        $this->validation(__FUNCTION__);
        $payload = [
            'transaction' => [
                'amount' => $amount,
                'transactionText' => $text,
            ]
        ];
        $this->request(
            $this,
            'POST',
            $this->orderID . '/capture',
            $payload
        );
        return $this;
    }

    /**
     * @param string $text
     *   Comment.
     * @param int $amount
     *   (optional) Amount in øre.
     * @return $this
     */
    public function refund($text, $amount = 0)
    {
        $this->validation(__FUNCTION__);
        $payload = [
            'transaction' => [
                'amount' => $amount,
                'transactionText' => $text,
            ]
        ];
        $this->request(
            $this,
            'POST',
            $this->orderID . '/refund',
            $payload
        );
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        $this->validation(__FUNCTION__);
        $this->request(
            $this,
            'GET',
            $this->orderID . '/serialNumber/' . $this->vipps->getMerchantSerialNumber() . '/status'
        );
        return $this->getLastResponse();
    }

    /**
     * @return mixed
     */
    public function getDetails()
    {
        $this->validation(__FUNCTION__);
        $this->request(
            $this,
            'GET',
            $this->orderID . '/serialNumber/' . $this->vipps->getMerchantSerialNumber() . '/details'
        );
        return $this->getLastResponse();
    }

    /**
     * Validate if method has all required parameters.
     *
     * @param string $action
     *   Method name.
     */
    private function validation($action)
    {
        switch ($action) {
            case 'capture':
            case 'refund':
            case 'cancel':
            case 'getStatus':
            case 'getDetails':
                if (empty($this->orderID)) {
                    throw new \InvalidArgumentException('Missing order ID');
                }
                break;

            case 'create':
                break;

            default:
                throw new \UnexpectedValueException('Invalid action');
        }
    }
}
