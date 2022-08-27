<?php

namespace zaporylie\Vipps\Model\Checkout;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class RequestInitiateSession.
 *
 * @package Vipps\Model\Checkout
 */
class RequestInitiateSession
{

    /**
     * @var \zaporylie\Vipps\Model\Checkout\MerchantInfo
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\MerchantInfo")
     */
    protected $merchantInfo;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\PaymentTransaction
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\PaymentTransaction")
     */
    protected $transaction;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\Logistics
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\Logistics")
     */
    protected $logistics;

    /**
     * @var \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     * @Serializer\Type("zaporylie\Vipps\Model\Checkout\PrefillCustomer")
     */
    protected $prefillCustomer;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $customerInteraction;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     */
    protected $contactFields;

    /**
     * @var bool
     * @Serializer\Type("boolean")
     */
    protected $addressFields;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $userFlow;

    /**
     * Gets merchant info.
     *
     * @return \zaporylie\Vipps\Model\Checkout\MerchantInfo
     */
    public function getMerchantInfo(): MerchantInfo
    {
        return $this->merchantInfo;
    }

    /**
     * Sets merchant info.
     *
     * @param \zaporylie\Vipps\Model\Checkout\MerchantInfo $merchant_info
     *
     * @return $this
     */
    public function setMerchantInfo(MerchantInfo $merchant_info): RequestInitiateSession
    {
        $this->merchantInfo = $merchant_info;
        return $this;
    }

    /**
     * Gets payment transaction.
     *
     * @return \zaporylie\Vipps\Model\Checkout\PaymentTransaction
     */
    public function getPaymentTransaction(): PaymentTransaction
    {
        return $this->transaction;
    }

    /**
     * Sets payment transaction.
     *
     * @param \zaporylie\Vipps\Model\Checkout\PaymentTransaction $transaction
     *
     * @return $this
     */
    public function setPaymentTransaction(PaymentTransaction $transaction): RequestInitiateSession
    {
        $this->transaction = $transaction;
        return $this;
    }

    /**
     * Gets logistics.
     *
     * @return \zaporylie\Vipps\Model\Checkout\Logistics
     */
    public function getLogistics(): Logistics
    {
        return $this->logistics;
    }

    /**
     * Sets logistics.
     *
     * @param \zaporylie\Vipps\Model\Checkout\Logistics $logistics
     *
     * @return $this
     */
    public function setLogistics(Logistics $logistics): RequestInitiateSession
    {
        $this->logistics = $logistics;
        return $this;
    }

    /**
     * Gets prefill customer.
     *
     * @return \zaporylie\Vipps\Model\Checkout\PrefillCustomer
     */
    public function getPrefillCustomer(): PrefillCustomer
    {
        return $this->prefillCustomer;
    }

    /**
     * Sets prefill customer.
     *
     * @param \zaporylie\Vipps\Model\Checkout\PrefillCustomer $prefill_customer
     *
     * @return $this
     */
    public function setPrefillCustomer(PrefillCustomer $prefill_customer): RequestInitiateSession
    {
        $this->prefillCustomer = $prefill_customer;
        return $this;
    }

    /**
     * Gets customer interaction.
     *
     * @return string
     */
    public function getCustomerInteraction(): string
    {
        return $this->customerInteraction;
    }

    /**
     * Sets customer interaction.
     *
     * @param string $customer_interaction
     *
     * @return $this
     */
    public function setCustomerInteraction(string $customer_interaction): RequestInitiateSession
    {
        $this->customerInteraction = $customer_interaction;
        return $this;
    }

    /**
     * Gets "contact fields" boolean value.
     *
     * @return bool
     */
    public function contactFields(): bool
    {
        return $this->contactFields;
    }

    /**
     * Sets "contact fields" boolean value.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setContactFields(bool $value): RequestInitiateSession
    {
        $this->contactFields = $value;
        return $this;
    }

    /**
     * Gets "address fields" boolean value.
     *
     * @return bool
     */
    public function addressFields(): bool
    {
        return $this->addressFields;
    }

    /**
     * Sets "address fields" boolean value.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setAddressFields(bool $value): RequestInitiateSession
    {
        $this->addressFields = $value;
        return $this;
    }

    /**
     * Gets user flow.
     *
     * @return string
     */
    public function getUserFlow(): string
    {
      return $this->userFlow;
    }

    /**
     * Sets user flow.
     *
     * @param string $user_flow
     *
     * @return $this
     */
    public function setUserFlow(string $user_flow): RequestInitiateSession
    {
      $this->userFlow = $user_flow;
      return $this;
    }

}
