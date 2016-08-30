<?php

namespace Vipps\Resources;

class Payments extends AbstractResource
{
    private $uri = 'payments';

    private $orderID;

    public function setOrderID($orderID)
    {
        $this->orderID = $orderID;
        return $this;
    }

    /**
     * @param string $text
     * @return $this
     */
    public function cancel($text = '')
    {
        $this->validation(__METHOD__);
        $payload = [
            'transaction' => [
                'transactionText' => $text,
            ],
        ];
        $response = $this->vipps->request('PUT', $this->uri . '/' . $this->orderID . '/cancel', $payload);
        return $this;
    }

    /**
     * @param int $amount
     * @param string $text
     * @return $this
     */
    public function capture($amount = 0, $text = '')
    {
        $this->validation(__METHOD__);
        $payload = [
            'transaction' => [
                'amount' => $amount,
                'transactionText' => $text,
            ]
        ];
        $response = $this->vipps->request('POST', $this->uri . '/' . $this->orderID . '/capture', $payload);
        return $this;
    }

    /**
     * @param int $amount
     * @param string $text
     * @return $this
     */
    public function refund($amount = 0, $text = '')
    {
        $this->validation(__METHOD__);
        $payload = [
            'transaction' => [
                'amount' => $amount,
                'transactionText' => $text,
            ]
        ];
        $response = $this->vipps->request('POST', $this->uri . '/' . $this->orderID . '/refund', $payload);
        return $this;
    }

    /**
     * @return $this
     */
    public function getStatus()
    {
        $this->validation(__METHOD__);
        $response = $this->vipps->request('GET', $this->uri . '/' . $this->orderID . '/serialNumber/' . $this->vipps->getMerchantSerialNumber() . '/status');
        return $this;
    }

    private function validation($action)
    {
        switch ($action) {
            case 'cancel':
            case 'capture':
            case 'refund':
            case 'getStatus':
                if (empty($this->orderID)) {
                    throw new \InvalidArgumentException('Missing order ID');
                }
                break;

            default:
                throw new \UnexpectedValueException('Invalid action');
        }
    }
}
