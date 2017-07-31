VIPPS by DNB
=====================
[![Packagist](https://img.shields.io/packagist/v/zaporylie/vipps.svg?maxAge=3600)](https://packagist.org/packages/zaporylie/vipps)
[![Packagist](https://img.shields.io/packagist/dt/zaporylie/vipps.svg?maxAge=3600)](https://packagist.org/packages/zaporylie/vipps)
[![codecov](https://codecov.io/gh/zaporylie/php-vipps/branch/1.x/graph/badge.svg)](https://codecov.io/gh/zaporylie/php-vipps)
[![Build Status](https://travis-ci.org/zaporylie/php-vipps.svg?branch=1.x)](https://travis-ci.org/zaporylie/php-vipps)

Vipps is a Norwegian payment application designed for smartphones developed by DNB. Vipps was released May 30, 2015 and 
by reaching 1 million users November 5, 2015 - Vipps is Norways largest payment application. Although Vipps is developed
by DNB it is an application open for customers from any Norwegian bank and 40% of the users are non-dnb customers.

source: [Wikipedia]

## Prerequisites

After recent changes to Vipps architecture there is no longer need to authorize each request using cert files.
Authorization is now token-based and you can generate tokens yourself using Merchant Integration Environment. 
Please contact vippstech@dnb.no in order to access [Vipps Developer Portal].

## Quick start

Add VIPPS SDK to your project using [Composer].

```bash
$ composer require zaporylie/vipps:^1.0
```

Vipps SDK uses [PSR-7] compliant http-message plugin system, hence before you require `zaporylie/vipps` you must 
add http client adapter of your choice, ex. `php-http/guzzle6-adapter` [(read more)](https://github.com/php-http/guzzle6-adapter).

## Basic usage (configuration)

```php
// Create Vipps client;
$client = new \Vipps\Client([]);
// Initiate Vipps App with a previously initiatet client;
$app = new \Vipps\Vipps($client);
```

You must pass client_id obtained from Vipps Developer Portal in order to make requests to Vipps API.

```php
// Create Vipps client;
$client = new \Vipps\Client([
    'client_id' => 'xxxxxxxxxxxxxxxxxxxxxxxx',
]);
// Initiate Vipps App with a previously initiatet client;
$app = new \Vipps\Vipps($client);
```

Http client will be determined automatically, but if your application uses more than one client and you want to
choose which one will be used for Vipps calls you can pass instantiated adaptor object to `\Vipps\Client` constructor.

```php
// Initiate guzzle client in debug mode.
$httpClient = new Http\Adapter\Guzzle6\Client(new GuzzleHttp\Client(['debug' => TRUE]));
// Create Vipps client;
$client = new \Vipps\Client([
    'client_id' => 'xxxxxxxxxxxxxxxxxxxxxxxx',
    'http_client' => $httpClient,
]);
// Initiate Vipps App with a previously initiatet client;
$app = new \Vipps\Vipps($client);
```

In following examples `$app` is an instance of `\Vipps\Vipps`.

### Initiate Payment

```php
// Get payment API - pass product's subcription key obtainted from Developer Portal.
$payment = $app->payments('xxxxxxxx');
// Initiate new payment.
$payment_details = $payment->initiatePayment('<unique-order-id>', '<vipps-user-mobile-phone-number>', '<amount-in-ore>', '<payment-description>', '<callback-url>');
```

`::initiatePayment()` method takes parameters:
- unique order id
- user's mobile phone number
- transaction amount in ore
- payment description
- callback url - to this URL Vipps will push information about finalized or canceled payment
- Ref. Order ID (optional)

If everything goes smooth, `::initiatePayment()` method returns an instance of `\Vipps\Model\Payment\ResponseInitiatePayment` method.

If API throws an error, `\Vipps\Exceptions\VippsException` is thrown.


### Get payment details

```php
// Get payment API.
$payment = $app->payment('xxxxxxxx');
// Get order status (basic informations about payment).
$status = $payment->getStatus('order_id');
// Get transaction details including capture/refund history.
$details = $payment->getDetails('order_id);
```

### Using production server

By default all requests are made against Vipps Test Environment. If you want to use production environment 
you must pass endpoint option to Vipps client. 

```php
$client = new \Vipps\Client([
    'client_id' => 'xxxxxxxxxxxxxxxxxxxxxxxx',
    'endpoint' => 'live',
]);
```

## References 
- [API documentation]
- [Read more about VIPPS on Wikipedia][Wikipedia]
- [Vipps Developer Portal]

## Author
- Jakub Piasecki <jakub@nymedia.no> for [Ny Media AS] 

[Wikipedia]: https://en.wikipedia.org/wiki/Vipps "Wikipedia"
[Documentation]: https://www.vipps.no/utvikler "Documentation"
[Ny Media AS]: https://nymedia.no "Ny Media AS"
[Vipps Developer Portal]: https://apitest-portal.vipps.no "Vipps Developer Portal"
[Composer]: https://getcomposer.org/ "Composer"
[PSR-7]: http://www.php-fig.org/psr/psr-7/ "PSR-7"
