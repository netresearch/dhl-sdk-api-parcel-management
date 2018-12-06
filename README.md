# DHL Parcel Management API SDK for PHP

- version 1.0.0

This library enables PHP developers send and recieve messages to and from the DHL Parcel Management API in a structured way.

## Requirements

- PHP >= 7.0
- An implementation of "php-http/client-implementation" ^1.0, see [this list](https://packagist.org/providers/php-http/client-implementation).

## Installation

### Composer

To install the library via [Composer](http://getcomposer.org/), add the following to your projects `composer.json`:

```
{
  "require": {
    "dhl/sdk-api-parcel-management": "^1.0.0",
    "kriswallsmith/buzz": "*"
  }
}
```

Then run `composer install`

## Getting Started

Please follow the [installation procedure](#installation) and then run the following:

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

$logger = \Monolog\Logger();      // You can use any PSR compliant logger
$client = new Buzz\Client\Curl(); // You can use any client that implements php-http/client-implementation, see [Requirements](#requirements)

$serviceFactory = new \Dhl\ParcelManagement\Webservice\ServiceFactory();
$checkoutService = $serviceFactory->createCheckoutService(
    'appId',    // string | Application id from DHL
    'appToken', // string | Application token from DHL
    'ekp',      // string | DHL customer number of the sender
    $logger,
    \Dhl\ParcelManagement\Api\ServiceFactoryInterface::BASE_URL_PRODUCTION, // Switch between PRODUCTION and SANDBOX
    $client     // Optional. The SDK will try to autodetect installed clients via php-http/discovery
);

try {
    $response = $checkoutService->performAvailableServiceRequest(
        'recipientZip', // string | ZIP code of recipient.
        'startDate'     // string | Day in format "2018-12-31" when the shipment will be dropped off in the DHL parcel center
    );
} catch (\Dhl\ParcelManagement\Exception\ApiException $e) {
    echo 'Exception while retrieving available checkout services: ', $e->getMessage(), PHP_EOL;
}

?>
```

## Documentation for API Endpoints

See [https://entwickler.dhl.de/en/group/ep/wsapis/paketsteuerung-](https://entwickler.dhl.de/en/group/ep/wsapis/paketsteuerung-)

Author
------
* Sebastian Ertner | [Netresearch GmbH & Co. KG](http://www.netresearch.de/)
* Max Melzer | [Netresearch GmbH & Co. KG](http://www.netresearch.de/)

License
-------
MIT License
