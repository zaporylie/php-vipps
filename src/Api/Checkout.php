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
class Checkout extends ApiBase implements CheckoutInterface
{

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
            );

        // Set other options.
        $default_options = [
            'contactFields' => true,
            'addressFields' => true,
        ];
        $options += $default_options;

        // Some general options.
        foreach ($options as $option => $value) {
            if (!$value) {
              continue;
            }
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

        // Prefill customer options.
        $prefill_customer_options = $options['prefillCustomer'] ?? [];
        if ($prefill_customer_options) {
            $prefill_customer = new PrefillCustomer();
            foreach ($prefill_customer_options as $option => $value) {
                if (!$value) {
                  continue;
                }
                switch ($option) {
                    case 'firstName':
                        $prefill_customer->setFirstName($value);
                        break;
                    case 'lastName':
                        $prefill_customer->setLastName($value);
                        break;
                    case 'email':
                        $prefill_customer->setEmail($value);
                        break;
                    case 'phoneNumber':
                        $prefill_customer->setPhoneNumber($value);
                        break;
                    case 'streetAddress':
                        $prefill_customer->setStreetAddress($value);
                        break;
                    case 'city':
                        $prefill_customer->setCity($value);
                        break;
                    case 'postalCode':
                        $prefill_customer->setPostalCode($value);
                        break;
                    case 'country':
                        $prefill_customer->setCountry($value);
                        break;
                }
            }
            $request->setPrefillCustomer($prefill_customer);
        }

        // Logistics options.
        $logistics_options = $options['logistics'] ?? [];
        if ($logistics_options) {
            $logistics = new Logistics();
            foreach ($logistics_options as $option => $value) {
                if (!$value) {
                  continue;
                }
                switch ($option) {
                    // Logistics options.
                    case 'dynamicOptionsCallback':
                        $logistics->setDynamicOptionsCallback($value);
                        break;
                    case 'fixedOptions':
                        $logistics->setFixedOptions($value);
                        break;
                }
            }
            $request->setLogistics($logistics);
        }

        // Call resource.
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
    public function cancelSession(string $session_id): ResponseCancelSession
    {
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
