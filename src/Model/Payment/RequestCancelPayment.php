<?php

namespace zaporylie\Vipps\Model\Payment;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class RequestCancelPayment
 *
 * @package Vipps\Model\Payment
 */
class RequestCancelPayment
{
    /**
     * @var \zaporylie\Vipps\Model\Payment\MerchantInfo
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\MerchantInfo")
     */
    protected $merchantInfo;

    /**
     * @var \zaporylie\Vipps\Model\Payment\Transaction
     * @Serializer\Type("zaporylie\Vipps\Model\Payment\Transaction")
     */
    protected $transaction;

    /**
     * Gets merchantInfo value.
     *
     * @return \zaporylie\Vipps\Model\Payment\MerchantInfo
     */
    public function getMerchantInfo()
    {
        return $this->merchantInfo;
    }

    /**
     * Sets merchantInfo variable.
     *
     * @param \zaporylie\Vipps\Model\Payment\MerchantInfo $merchantInfo
     *
     * @return $this
     */
    public function setMerchantInfo($merchantInfo)
    {
        $this->merchantInfo = $merchantInfo;
        return $this;
    }

    /**
     * Gets transaction value.
     *
     * @return \zaporylie\Vipps\Model\Payment\Transaction
     */
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Sets transaction variable.
     *
     * @param \zaporylie\Vipps\Model\Payment\Transaction $transaction
     *
     * @return $this
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;
        return $this;
    }
}
