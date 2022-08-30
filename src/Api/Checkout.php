<?php

namespace zaporylie\Vipps\Api;

use zaporylie\Vipps\Exceptions\Api\InvalidArgumentException;
use zaporylie\Vipps\Model\Checkout\Logistics;
use zaporylie\Vipps\Model\Checkout\MerchantInfo;
use zaporylie\Vipps\Model\Checkout\PaymentTransaction;
use zaporylie\Vipps\Model\Checkout\PrefillCustomer;
use zaporylie\Vipps\Model\Checkout\RequestAmount;
use zaporylie\Vipps\Model\Checkout\RequestInitiateSession;
use zaporylie\Vipps\Model\Checkout\ResponseCancelSession;
use zaporylie\Vipps\Model\Checkout\ResponseGetSessionDetails;
use zaporylie\Vipps\Model\Checkout\RequestCancelSession;
use zaporylie\Vipps\Model\Checkout\ResponseInitiateSession;
use zaporylie\Vipps\Resource\Checkout\CancelSession;
use zaporylie\Vipps\Resource\Checkout\GetSessionDetails;
use zaporylie\Vipps\Resource\Checkout\InitiateSession;
use zaporylie\Vipps\VippsInterface;

/**
 * Class Checkout.
 *
 * @package Vipps\Api
 */
class Checkout extends ApiBase implements CheckoutInterface {

    /**
     * @var string
     */
    protected $clientSecret;

    /**
     * Gets client secret.
     *
     * @return string
     */
    public function getClientSecret(): string
    {
        if (!$this->clientSecret) {
            throw new InvalidArgumentException('Missing client secret');
        }
        return $this->clientSecret;
    }

    /**
     * Checkout constructor.
     */
    public function __construct(VippsInterface $app, string $subscription_key, string $client_secret)
    {
        parent::__construct($app, $subscription_key);
        $this->clientSecret = $client_secret;
    }

    /**
     * {@inheritdoc}
     */
    public function initiateSession(
      string $callback_prefix,
      string $return_url,
      string $callback_auth_token,
      RequestAmount $amount,
      array $options = []
    ): ResponseInitiateSession
    {
        $request = (new RequestInitiateSession())
            ->setMerchantInfo(
                (new MerchantInfo())
                    ->setCallbackPrefix($callback_prefix)
                    ->setReturnUrl($return_url)
                    ->setCallbackAuthorizationToken($callback_auth_token)
              )
            ->setPaymentTransaction(
                (new PaymentTransaction())
                    ->setAmount($amount)
            )
            ->setLogistics(new Logistics())
            ->setPrefillCustomer(new PrefillCustomer());

        // Set other options.
        $default_options = [
          'contactFields' => TRUE,
          'addressFields' => TRUE,
        ];
        $options += $default_options;
        foreach ($options as $option => $value) {
            switch ($option) {
                case 'termsAndConditionsUrl':
                  $request->getMerchantInfo()->setTermsAndConditionsUrl($value);
                  break;
                // Payment transaction options.
                case 'reference':
                    $request->getPaymentTransaction()->setReference($value);
                    break;
                case 'paymentDescription':
                    $request->getPaymentTransaction()->setDescription($value);
                    break;
                // Logistics options.
                case 'dynamicOptionsCallback':
                    $request->getLogistics()->setDynamicOptionsCallback($value);
                    break;
                case 'fixedOptions':
                    $request->getLogistics()->setFixedOptions($value);
                    break;
                // Prefill customer options.
                case 'firstName':
                    $request->getPrefillCustomer()->setFirstName($value);
                    break;
                case 'lastName':
                    $request->getPrefillCustomer()->setLastName($value);
                    break;
                case 'email':
                    $request->getPrefillCustomer()->setEmail($value);
                    break;
                case 'phoneNumber':
                    $request->getPrefillCustomer()->setPhoneNumber($value);
                    break;
                case 'streetAddress':
                    $request->getPrefillCustomer()->setStreetAddress($value);
                    break;
                case 'city':
                    $request->getPrefillCustomer()->setCity($value);
                    break;
                case 'postalCode':
                    $request->getPrefillCustomer()->setPostalCode($value);
                    break;
                case 'country':
                    $request->getPrefillCustomer()->setCountry($value);
                    break;
                // Customer interaction.
                case 'customerInteraction':
                    $request->setCustomerInteraction($value);
                    break;
                // Contact fields.
                case 'contactFields':
                    $request->setContactFields($value);
                    break;
                // Address fields.
                case 'addressFields':
                    $request->setAddressFields($value);
                    break;
                // User flow.
                case 'userFlow':
                    $request->setUserFlow($value);
                    break;
            }
        }

        $resource = new InitiateSession(
            $this->app,
            $this->getSubscriptionKey(),
            $this->getClientSecret(),
            $request
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }


    /**
     * {@inheritdoc}
     */
    public function getSessionDetails(string $session_id): ResponseGetSessionDetails
    {
        $resource = new GetSessionDetails(
            $this->app,
            $this->getSubscriptionKey(),
            $this->getClientSecret(),
            $session_id
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }

    /**
     * {@inheritdoc}
     */
    public function cancelSession(string $session_id): ResponseCancelSession {
        $request = (new RequestCancelSession())->setSessionId($session_id);
        $resource = new CancelSession(
            $this->app,
            $this->getSubscriptionKey(),
            $this->getClientSecret(),
            $request
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }
}
