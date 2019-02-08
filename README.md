Vipps PHP SDK
=====================
[![Packagist](https://img.shields.io/packagist/v/zaporylie/vipps.svg?maxAge=3600)](https://packagist.org/packages/zaporylie/vipps)
[![Packagist](https://img.shields.io/packagist/dt/zaporylie/vipps.svg?maxAge=3600)](https://packagist.org/packages/zaporylie/vipps)
[![codecov](https://codecov.io/gh/zaporylie/php-vipps/branch/1.x/graph/badge.svg)](https://codecov.io/gh/zaporylie/php-vipps)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zaporylie/php-vipps/badges/quality-score.png?b=1.x)](https://scrutinizer-ci.com/g/zaporylie/php-vipps/?branch=1.x)
[![Build Status](https://travis-ci.org/zaporylie/php-vipps.svg?branch=1.x)](https://travis-ci.org/zaporylie/php-vipps)
[![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.com/paypalme/zaporylie/50)

[Vipps](https://vipps.no) is a Norwegian payment service, used by more than 3 million people. 
Vipps was originally developed by DNB, but is now a separate company, which includes BankID and BankAxept. Vipps developer resources are available on GitHub: https://github.com/vippsas

## Prerequisites

After recent changes to Vipps architecture there is no longer need to authorize each request using cert files.
Authorization is now token-based and you can generate tokens yourself using Merchant Integration Environment. 
Please [contact Vipps integration] in order to access [Vipps Developer Portal].

## Quick start

Add Vipps SDK to your project using [Composer].

```bash
$ composer require zaporylie/vipps:^1.0
```

Vipps SDK uses [PSR-7] compliant http-message plugin system, hence before you require `zaporylie/vipps` you must 
add http client adapter of your choice, ex. `php-http/guzzle6-adapter` [(read more)](https://github.com/php-http/guzzle6-adapter).

## References 
- [SDK documentation]
- [API documentation]
- [Read more about Vipps on Wikipedia][Wikipedia]
- [Vipps Developer Portal]

## Author
- [Jakub Piasecki](mailto:jakub@piaseccy.pl) - Development and maintenance
- [Ny Media AS] - Initial development

## Donate

Do you like the library? Do you find it useful? Please donate so I can allocate some of my free time to maintain the 
project.

[![Donate](https://img.shields.io/badge/paypal-donate-yellow.svg?longCache=true&style=for-the-badge)](https://www.paypal.com/paypalme/zaporylie/50)

Default amount with the link above is 50 PLN but you can modify according to your will.

If you want to support my work on this library in a different way please [contact me](mailto:jakub@piaseccy.pl).

[Wikipedia]: https://en.wikipedia.org/wiki/Vipps "Wikipedia"
[Documentation]: https://www.vipps.no/utvikler "Documentation"
[Ny Media AS]: https://nymedia.no "Ny Media AS"
[Vipps Developer Portal]: https://apitest-portal.vipps.no "Vipps Developer Portal"
[Composer]: https://getcomposer.org/ "Composer"
[PSR-7]: http://www.php-fig.org/psr/psr-7/ "PSR-7"
[API documentation]: https://apitest-portal.vipps.no/ "API Documentation (you must login first)"
[SDK documentation]: https://github.com/zaporylie/php-vipps/wiki
[contact Vipps integration]: https://github.com/vippsas/vipps-developers/blob/master/contact.md
