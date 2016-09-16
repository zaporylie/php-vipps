VIPPS by DNB
=====================

Vipps is a Norwegian payment application designed for smartphones developed by DNB. Vipps was released May 30, 2015 and 
by reaching 1 million users November 5, 2015 - Vipps is Norways largest payment application. Although Vipps is developed
by DNB it is an application open for customers from any Norwegian bank and 40% of the users are non-dnb customers.

source: [Wikipedia]

## Prerequisities

In order to use VIPPS API you must apply for access to test environment. VIPPS expects you to deliver CSR file 
 (Certificate Signing Request). You can read more about the procedure on [API documentation] pages and they will
 provide back signed certificate for merchant. Procedure usually takes 5-7 days. It is necessary to have signed 
 certificate in order to access API (get through DNB firewalls).
 
Next step is to generate `.pem` certificate which consists of `.crt` file delivered by DNB PKI Team and private `.key`
 file you have generated along with CSR request file:
 
```
$ cat ./vipps.crt ./vipps.key > ./vipps.pem
```

That's it. Add `.pem` cert to each request you make against VIPPS servers.

## Quick start

Add VIPPS to your project with Composer.

```
$ composer require zaporylie/vipps
```

### Create payment

```php
$client = new \GuzzleHttp\Client([
    // Add certificate.
    'cert' => __DIR__ . '/vipps.pem',
]);
$vipps = new \Vipps\Vipps($client);
// Set Vipps client.
$vipps->setMerchantID($merchant_id)->setMerchantSerialNumber($merchant_serial_number)->setToken($merchant_token);
// Get payment resource.
$payment = $vipps->payments();
// Set Order ID.
$payment->setOrderID($unique_order_id);
// Get transaction status.
$payment->create($phone_number, $amount_in_ore, $callback);
```

In case of any error `::create()` method will throw an exception.

### Get payment details

```php
$client = new \GuzzleHttp\Client([
    // Add certificate.
    'cert' => __DIR__ . '/vipps.pem',
]);
$vipps = new \Vipps\Vipps($client);
// Set Vipps client.
$vipps->setMerchantID($merchant_id)->setMerchantSerialNumber($merchant_serial_number)->setToken($merchant_token);
// Get payment resource.
$payment = $vipps->payments();
// Set Order ID.
$payment->setOrderID($unique_order_id);
// Get transaction current status.
$status = $payment->getStatus();
// Get transaction details including capture/refund history.
$details = $payment->getDetails();
```

### Using test server

For now there is no official test server. VIPPS, along with signed certificate, will tell you which server should you
use. You can add base uri for test server to Guzzle client:

```php
$client = new \GuzzleHttp\Client([
    // Set test environment base uri.
    'base_uri' => 'https://hostname:port/base_path',
    // Add certificate.
    'cert' => __DIR__ . '/vipps.pem',
]);
```

## Troubleshooting

OSX user can experience problem with `.pem` files (internal OSX issue). However, you can generate `.p12` file:

```
$ openssl pkcs12 -export -in ./vipps.crt -inkey ./vipps.pem -out ./vipps.p12
// System will ask for custom password for the file.
```  
[source](https://github.com/curl/curl/issues/283#issuecomment-161123943)


Next create Guzzle client and add certificate:

```php
$client = new \GuzzleHttp\Client([
    // Add certificate.
    'cert' => [
      __DIR__ . '/vipps.p12', // Path to .p12 file.
      'password', // Pasword to .p12 file
    ]
]);
```

From now you can use client as usual.

## References 
- [API documentation]
- [Read more about VIPPS on Wikipedia][Wikipedia]

## Author
- Jakub Piasecki <jakub@nymedia.no> for Ny Media AS [nymedia.no](http://nymedia.no) 

[Wikipedia]: https://en.wikipedia.org/wiki/Vipps "Wikipedia"
[API documentation]: https://www.vipps.no/utvikler "Documentation"
