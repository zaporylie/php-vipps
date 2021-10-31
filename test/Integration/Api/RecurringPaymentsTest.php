<?php

namespace zaporylie\Vipps\Tests\Integration\Api;

use zaporylie\Vipps\Exceptions\VippsException;
use zaporylie\Vipps\Model\RecurringPayment\InitialCharge;
use zaporylie\Vipps\Model\RecurringPayment\Interval;
use zaporylie\Vipps\Model\RecurringPayment\RequestCreateAgreement;
use zaporylie\Vipps\Model\RecurringPayment\RequestCreateCharge;
use zaporylie\Vipps\Model\RecurringPayment\RequestRefundCharge;
use zaporylie\Vipps\Model\RecurringPayment\Status;
use zaporylie\Vipps\Model\RecurringPayment\TransactionType;
use zaporylie\Vipps\Tests\Integration\IntegrationTestBase;

/**
 * Class RecurringPaymentsTest
 *
 * @package Vipps\Tests\Integration\Api
 */
class RecurringPaymentsTest extends IntegrationTestBase
{

    /**
     * @var string
     */
    protected $merchantSerialNumber = 'test_merchant_serial_number';

    /**
     * @var \zaporylie\Vipps\Api\RecurringPaymentInterface
     */
    protected $api;

    /**
     * {@inheritdoc}
     */
    protected function setUp() : void
    {
        parent::setUp();
        $this->api = $this->vipps->recurringPayment('test_subscription_key', $this->merchantSerialNumber);
    }

    /**
     * @covers \zaporylie\Vipps\Api\RecurringPayment::createAgreement()
     */
    public function testValidCreateAgreement()
    {
        $this->mockResponse(parent::getResponse([
            'agreementId' => 'test_agreement_id',
            'vippsConfirmationUrl' => 'https://www.example.com/vipps/confirmation',
            'agreementResource' => 'https://www.example.com/vipps/resource',
            'chargeId' => 'test_charge_id'
        ]));

        $requestObject = new RequestCreateAgreement();
        $requestObject->setIntervalCount(1);
        $requestObject->setInterval(Interval::MONTH);
        $requestObject->setCurrency('NOK');
        $requestObject->setCustomerPhoneNumber(98765432);
        $requestObject->setIsApp(false);
        $requestObject->setMerchantAgreementUrl('https://www.example.com/vipps');
        $requestObject->setMerchantRedirectUrl('https://www.example.com/vipps');
        $requestObject->setPrice(10000);
        $requestObject->setProductName('Product name');
        $requestObject->setProductDescription('Product description');
        $requestObject->setScope('email');
        $requestObject->setInitialCharge((new InitialCharge())
            ->setCurrency('NOK')
            ->setAmount(10000)
            ->setDescription('Charge descripton')
            ->setTransactionType(TransactionType::DIRECT_CAPTURE));

        // Do request.
        $response = $this->api->createAgreement($requestObject);

        // Assert response.
        $this->assertEquals('test_agreement_id', $response->getAgreementId());
        $this->assertEquals('https://www.example.com/vipps/confirmation', $response->getVippsConfirmationUrl());
        $this->assertEquals('https://www.example.com/vipps/resource', $response->getAgreementResource());
        $this->assertEquals('test_charge_id', $response->getChargeId());
    }

    /**
     * @covers \zaporylie\Vipps\Api\RecurringPayment::createAgreement()
     */
    public function testInvalidCreateAgreement()
    {
        $this->mockResponse(parent::getErrorResponse());
        $this->expectException(VippsException::class);
        $this->api->createAgreement(new RequestCreateAgreement());
    }

    /**
     * @covers \zaporylie\Vipps\Api\RecurringPayment::createCharge()
     */
    public function testValidCreateCharge()
    {
        // Mock response.
        $this->mockResponse(parent::getResponse([
            "chargeId" => "chr-123abc456"
        ]));

        // Do request.
        $response = $this->api->createCharge(
            'test_agreement_id',
            (new RequestCreateCharge())
            ->setDescription('Example charge')
            ->setAmount(10000)
            ->setCurrency('NOK')
            ->setDue(new \DateTime())
            ->setRetryDays(5)
        );

        // Assert response.
        $this->assertEquals('chr-123abc456', $response->getChargeId());
    }

    /**
     * @covers \zaporylie\Vipps\Api\RecurringPayment::cancelCharge()
     */
    public function testValidCancelCharge()
    {

        // Mock response.
        $this->mockResponse(parent::getResponse([]));

        // Do request.
        $response = $this->api->cancelCharge(
            'test_agreement_id',
            'test_charge_id'
        );

        // Assert response.
        $this->assertEquals('[]', $response);
    }

    /**
     * @covers \zaporylie\Vipps\Api\RecurringPayment::refundCharge()
     */
    public function testValidRefundCharge()
    {

        // Mock response.
        $this->mockResponse(parent::getResponse([]));

        // Do request.
        $response = $this->api->refundCharge(
            'test_agreement_id',
            'test_charge_id',
            (new RequestRefundCharge())
            ->setAmount(10000)
            ->setDescription('Refund')
        );

        // Assert response.
        $this->assertEquals('[]', $response);
    }

    /**
     * @covers \zaporylie\Vipps\Api\RecurringPayment::getAgreement()
     */
    public function testValidGetAgreement()
    {

        // Mock response.
        $this->mockResponse(parent::getResponse([
            "currency" => "NOK",
            "id" => "test_agreement_id",
            "interval" => "MONTH",
            "intervalCount" => 1,
            "price" => 1200,
            "productName" => "Premier League subscription",
            "productDescription" => "Access to all games of English top football",
            "start" => "2019-01-01T00:00:00Z",
            "stop" => null,
            "status" => "ACTIVE",
            "sub" => "8d7de74e-0243-11eb-adc1-0242ac120002",
            "userinfoUrl" => "https://api.vipps.no/vipps-userinfo-api/userinfo/8d7de74e-0243-11eb-adc1-0242ac120002",
            "tags" => [
                "payment-source-issue"
            ],
            "merchantAgreementUrl" => "https://www.example.com/vipps-subscriptions/1234/"
        ]));

        // Do request.
        $response = $this->api->getAgreement(
            'test_agreement_id'
        );

        // Assert response.
        $this->assertEquals('test_agreement_id', $response->getId());
        $this->assertEquals(1200, $response->getPrice());
        $this->assertEquals(
            '2019-01-01T00:00:00Z',
            $response->getStart()->format('Y-m-d\TH:i:s\Z')
        );
        $this->assertEquals(Status::ACTIVE, $response->getStatus());
        $this->assertEquals(Interval::MONTH, $response->getInterval());
        $this->assertEquals(1, $response->getIntervalCount());
        $this->assertEquals('NOK', $response->getCurrency());
        $this->assertEquals('Access to all games of English top football', $response->getProductDescription());
        $this->assertEquals('Premier League subscription', $response->getProductName());
        $this->assertEquals('8d7de74e-0243-11eb-adc1-0242ac120002', $response->getSub());
        $this->assertEquals(
            'https://api.vipps.no/vipps-userinfo-api/userinfo/8d7de74e-0243-11eb-adc1-0242ac120002',
            $response->getUserInfoUrl()
        );
        $this->assertEquals(["payment-source-issue"], $response->getTags());
    }

    /**
     * @covers \zaporylie\Vipps\Api\RecurringPayment::getCharge()
     */
    public function testValidGetCharge()
    {

        // Mock response.
        $this->mockResponse(parent::getResponse([
            "amount" => 39900,
            "amountRefunded" => 39900,
            "description" => "Premier League subscription: September",
            "due" => "2019-06-01T00:00:00Z",
            "id" => "test_charge_id",
            "status" => "PENDING",
            "transactionId" => "5001419121",
            "type" => "RECURRING",
            "failureReason" => "insufficient_funds",
            "failureDescription" => "Payment was declined by the payer bank due to lack of funds"
        ]));

        // Do request.
        $response = $this->api->getCharge(
            'test_agreement_id',
            'test_charge_id'
        );

        // Assert response.
        $this->assertEquals('test_charge_id', $response->getId());

        $this->assertEquals('PENDING', $response->getStatus());
        $this->assertEquals(
            '2019-06-01T00:00:00Z',
            $response->getDue()->format('Y-m-d\TH:i:s\Z')
        );
        $this->assertEquals(39900, $response->getAmount());
        $this->assertEquals(39900, $response->getAmountRefunded());
        $this->assertEquals('Premier League subscription: September', $response->getDescription());
        $this->assertEquals(
            'Payment was declined by the payer bank due to lack of funds',
            $response->getFailureDescription()
        );
        $this->assertEquals('insufficient_funds', $response->getFailureReason());
        $this->assertEquals('5001419121', $response->getTransactionId());
        $this->assertEquals('RECURRING', $response->getType());
    }
}
