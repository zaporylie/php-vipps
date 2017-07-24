<?php

/**
 * Payment resource.
 *
 * Operates on payment transactions: create, cancel, capture, refund, get status
 * and details.
 */

namespace Vipps\Resource;

use Vipps\Data\DataTime;

/**
 * Class Payments
 * @package Vipps\Resources
 */
class Payments extends ResourceBase implements PaymentsInterface
{

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
        $this->validation(__FUNCTION__, [
            'mobileNumber' => $mobileNumber,
            'amount' => $amount,
            'text' => $text,
            'callback' => $callback,
        ]);
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
        $this->validation(__FUNCTION__, [
            'text' => $text,
        ]);
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
        $this->validation(__FUNCTION__, [
            'text' => $text,
            'amount' => $amount,
        ]);
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
        $this->validation(__FUNCTION__, [
            'text' => $text,
            'amount' => $amount,
        ]);
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
     * @param array $data
     */
    private function validation($action, array $data = [])
    {
        switch ($action) {
            case 'capture':
            case 'refund':
                $this->validateAmount($data['amount'], 0);
                $this->validateEmpty($data, 'text');
                $this->validateOrderId();
                break;
            case 'cancel':
                $this->validateEmpty($data, 'text');
                $this->validateOrderId();
                break;
            case 'getStatus':
            case 'getDetails':
                $this->validateOrderId();
                break;

            case 'create':
                $this->validateEmpty($data, 'mobileNumber');
                $this->validateEmpty($data, 'amount');
                $this->validateEmpty($data, 'text');
                $this->validateEmpty($data, 'callback');
                // TODO: Add phone number validation.
                $this->validateMobileNumber($data['mobileNumber']);
                $this->validateAmount($data['amount']);
                $this->validateCallback($data['callback']);
                break;
        }
    }

    /**
     * @param $array
     * @param $key
     * @throws \UnexpectedValueException
     */
    private function validateEmpty($array, $key)
    {
        if (empty($array[$key])) {
            throw new \UnexpectedValueException(sprintf('%s cannot be empty', $key));
        }
    }

    /**
     * @param $amount
     * @param int $minimum
     * @param int $maximum
     * @throws \UnexpectedValueException
     */
    private function validateAmount($amount, $minimum = 100, $maximum = 99999999)
    {
        if (!is_int($amount)) {
            throw new \UnexpectedValueException('Amount must be integer');
        }
        if ($amount < $minimum) {
            throw new \UnexpectedValueException(sprintf('Amount must be equal or higher than %s', $minimum));
        }
        if ($amount > $maximum) {
            throw new \UnexpectedValueException(sprintf('Amount must be equal or lower than %s', $maximum));
        }
    }

    /**
     * @param $mobileNumber
     * @throws \UnexpectedValueException
     */
    private function validateMobileNumber($mobileNumber)
    {
        if (!is_int($mobileNumber)) {
            throw new \UnexpectedValueException('mobileNumber must be integer');
        }
    }

    /**
     * @param $callback
     * @throws \UnexpectedValueException
     */
    private function validateCallback($callback)
    {
        if (!is_string($callback)) {
            throw new \UnexpectedValueException('callback must be string');
        }
        if (strpos($callback, 'https://') !== 0) {
            throw new \UnexpectedValueException('callback must start with https://');
        }
    }

    /**
     * @throws \UnexpectedValueException
     */
    private function validateOrderId()
    {
        if (empty($this->orderID)) {
            throw new \UnexpectedValueException('Missing order ID');
        }
    }
}
