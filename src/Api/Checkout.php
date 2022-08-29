<?php

namespace zaporylie\Vipps\Api;

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

/**
 * Class Checkout.
 *
 * @package Vipps\Api
 */
class Checkout extends ApiBase implements CheckoutInterface {

    /**
     * {@inheritdoc}
     */
    public function initiateSession(
      string $client_secret,
      string $callback_prefix,
      string $return_url,
      string $callback_auth_token,
      RequestAmount $amount,
      array $options = [],
      bool $contact_fields = TRUE,
      bool $address_fields = TRUE
    ): ResponseInitiateSession {
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
            ->setPrefillCustomer(new PrefillCustomer())
            ->setContactFields($contact_fields)
            ->setAddressFields($address_fields);

        // Set other options.
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
                // User flow.
                case 'userFlow':
                    $request->setUserFlow($value);
                    break;
            }
        }

        $resource = new InitiateSession(
            $this->app,
            $this->getSubscriptionKey(),
            $client_secret,
            $request
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }


    /**
     * {@inheritdoc}
     */
    public function getSessionDetails(string $client_secret, string $session_id): ResponseGetSessionDetails
    {
        $resource = new GetSessionDetails(
            $this->app,
            $this->getSubscriptionKey(),
            $client_secret,
            $session_id
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }

    /**
     * {@inheritdoc}
     */
    public function cancelSession(string $client_secret, string $session_id): ResponseCancelSession {
        $request = (new RequestCancelSession())->setSessionId($session_id);
        $resource = new CancelSession(
            $this->app,
            $this->getSubscriptionKey(),
            $client_secret,
            $request
        );
        $resource->setPath($resource->getPath());
        return $resource->call();
    }
}
