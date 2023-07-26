<?php

namespace zaporylie\Vipps\Api;

use http\Env\Response;
use zaporylie\Vipps\Exceptions\Api\InvalidArgumentException;
use zaporylie\Vipps\Model\Payment\CustomerInfo;
use zaporylie\Vipps\Model\Payment\MerchantInfo;
use zaporylie\Vipps\Model\Payment\RequestCancelPayment;
use zaporylie\Vipps\Model\Payment\RequestCapturePayment;
use zaporylie\Vipps\Model\Payment\RequestInitiatePayment;
use zaporylie\Vipps\Model\Payment\RequestRefundPayment;
use zaporylie\Vipps\Model\Payment\ResponseCancelPayment;
use zaporylie\Vipps\Model\Payment\ResponseCapturePayment;
use zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus;
use zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails;
use zaporylie\Vipps\Model\Payment\ResponseInitiatePayment;
use zaporylie\Vipps\Model\Payment\ResponseRefundPayment;
use zaporylie\Vipps\Model\Payment\Transaction;
use zaporylie\Vipps\Resource\Payment\CancelPayment;
use zaporylie\Vipps\Resource\Payment\CapturePayment;
use zaporylie\Vipps\Resource\Payment\GetOrderStatus;
use zaporylie\Vipps\Resource\Payment\GetPaymentDetails;
use zaporylie\Vipps\Resource\Payment\InitiatePayment;
use zaporylie\Vipps\Resource\Payment\RefundPayment;
use zaporylie\Vipps\VippsInterface;

/**
 * Class Payment
 *
 * @package Vipps\Api
 */
class Payment extends ApiBase implements PaymentInterface
{

    /**
     * @var string
     */
    protected string $merchantSerialNumber;

    /**
     * @var string
     */
    protected string $customPath;

    /**
     * Gets merchantSerialNumber value.
     *
     * @return string
     */
    public function getMerchantSerialNumber(): string
    {
        if (empty($this->merchantSerialNumber)) {
            throw new InvalidArgumentException('Missing merchant serial number');
        }
        return $this->merchantSerialNumber;
    }

    /**
     * @return string
     */
    public function getCustomPath(): string
    {
        return $this->customPath;
    }

    /**
     * Payment constructor.
     *
     * Payments API needs one extra param - merchant serial number.
     *
     * @param \zaporylie\Vipps\VippsInterface $app
     * @param string $subscription_key
     * @param $merchant_serial_number
     * @param $custom_path
     */
    public function __construct(
        VippsInterface $app,
        string $subscription_key,
        string $merchant_serial_number,
        string $custom_path = 'ecomm'
    ) {
        parent::__construct($app, $subscription_key);
        $this->merchantSerialNumber = $merchant_serial_number;
        $this->customPath = $custom_path;
    }

    /**
     * {@inheritdoc}
     */
    public function cancelPayment(string $order_id, string $text): ResponseCancelPayment
    {
        // Build request object from data passed to method.
        $request = (new RequestCancelPayment())
            ->setMerchantInfo(
                (new MerchantInfo())
                    ->setMerchantSerialNumber($this->getMerchantSerialNumber())
            )
            ->setTransaction(
                (new Transaction())
                    ->setTransactionText($text)
            );
        $resource = new CancelPayment($this->app, $this->getSubscriptionKey(), $order_id, $request);
        $resource->setPath(str_replace('ecomm', $this->customPath, $resource->getPath()));
        /** @var \zaporylie\Vipps\Model\Payment\ResponseCancelPayment $response */
        $response = $resource->call();
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function capturePayment(string $order_id, string $text, int $amount = 0): ResponseCapturePayment
    {
        // Build request object from data passed to method.
        $request = (new RequestCapturePayment())
            ->setMerchantInfo(
                (new MerchantInfo())
                    ->setMerchantSerialNumber($this->getMerchantSerialNumber())
            )
            ->setTransaction(
                (new Transaction())
                    ->setTransactionText($text)
            );
        // If amount is 0 (default) all remaining founds will be captured.
        if ($amount !== 0) {
            $request->getTransaction()->setAmount($amount);
        }
        $resource = new CapturePayment($this->app, $this->getSubscriptionKey(), $order_id, $request);
        $resource->setPath(str_replace('ecomm', $this->customPath, $resource->getPath()));
        /** @var \zaporylie\Vipps\Model\Payment\ResponseCapturePayment $response */
        $response = $resource->call();
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getOrderStatus(string $order_id): ResponseGetOrderStatus
    {
        // Get order status.
        // this is GET request so no need to create request object.
        $resource = new GetOrderStatus(
            $this->app,
            $this->getSubscriptionKey(),
            $order_id
        );
        $resource->setPath(str_replace('ecomm', $this->customPath, $resource->getPath()));
        /** @var \zaporylie\Vipps\Model\Payment\ResponseGetOrderStatus $response */
        $response = $resource->call();
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function getPaymentDetails(string $order_id): ResponseGetPaymentDetails
    {
        // Get payment details.
        // this is GET request so no need to create request object.
        $resource = new GetPaymentDetails(
            $this->app,
            $this->getSubscriptionKey(),
            $order_id
        );
        $resource->setPath(str_replace('ecomm', $this->customPath, $resource->getPath()));
        /** @var \zaporylie\Vipps\Model\Payment\ResponseGetPaymentDetails $response */
        $response = $resource->call();
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function initiatePayment(
        string $order_id,
        int $amount,
        string $text,
        string $callbackPrefix,
        string $fallback,
        array $options = []
    ): ResponseInitiatePayment {
        // Create Request object based on data passed to this method.
        $request = (new RequestInitiatePayment())
            ->setCustomerInfo(
                (new CustomerInfo())
            )
            ->setMerchantInfo(
                (new MerchantInfo())
                    ->setCallbackPrefix($callbackPrefix)
                    ->setFallBack($fallback)
                    ->setMerchantSerialNumber($this->getMerchantSerialNumber())
            )
            ->setTransaction(
                (new Transaction())
                    ->setTransactionText($text)
                    ->setAmount($amount)
                    ->setOrderId($order_id)
            );

        // Set optional values.
        foreach ($options as $option => $value) {
            switch ($option) {
                case 'mobileNumber':
                    $request->getCustomerInfo()->setMobileNumber($value);
                    break;
                case 'authToken':
                    $request->getMerchantInfo()->setAuthToken($value);
                    break;
                case 'consentRemovalPrefix':
                    $request->getMerchantInfo()->setConsentRemovalPrefix($value);
                    break;
                case 'isApp':
                    $request->getMerchantInfo()->setIsApp($value);
                    break;
                case 'paymentType':
                    $request->getMerchantInfo()->setPaymentType($value);
                    break;
                case 'shippingDetailsPrefix':
                    $request->getMerchantInfo()->setShippingDetailsPrefix($value);
                    break;
                case 'refOrderId':
                    $request->getTransaction()->setRefOrderId($value);
                    break;
                case 'timeStamp':
                    $request->getTransaction()->setTimeStamp($value);
                    break;
            }
        }
        // Pass request object along with all data required by InitiatePayment
        // to make a call.
        $resource = new InitiatePayment($this->app, $this->getSubscriptionKey(), $request);
        $resource->setPath(str_replace('ecomm', $this->customPath, $resource->getPath()));
        /** @var \zaporylie\Vipps\Model\Payment\ResponseInitiatePayment $response */
        $response = $resource->call();
        return $response;
    }

    /**
     * {@inheritdoc}
     */
    public function refundPayment(string $order_id, string $text, int $amount = 0): ResponseRefundPayment
    {
        // Prepare request object based on data passed to method.
        $request = (new RequestRefundPayment())
            ->setMerchantInfo(
                (new MerchantInfo())
                    ->setMerchantSerialNumber($this->getMerchantSerialNumber())
            )
            ->setTransaction(
                (new Transaction())
                    ->setTransactionText($text)
            );

        // If amount is 0 all remaining founds will be refunded.
        if ($amount !== 0) {
            $request->getTransaction()->setAmount($amount);
        }
        // Create a resource.
        $resource = new RefundPayment($this->app, $this->getSubscriptionKey(), $order_id, $request);
        $resource->setPath(str_replace('ecomm', $this->customPath, $resource->getPath()));
        /** @var \zaporylie\Vipps\Model\Payment\ResponseRefundPayment $response */
        $response = $resource->call();
        return $response;
    }
}
