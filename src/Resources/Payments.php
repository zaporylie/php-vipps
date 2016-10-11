<?php

namespace Vipps\Resources;

use Vipps\Data\DataTime;

/**
 * Class Payments
 * @package Vipps\Resources
 */
class Payments extends AbstractResource implements PaymentsInterface {

    /**
     * @var string
     */
    private $orderID;

    /**
     * {@inheritdoc}
     */
    public function getResourcePath()
    {
        return '/payments';
    }

    /**
     * {@inheritdoc}
     */
    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
        return $this;
    }

    /**
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
     * {@inheritdoc}
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
