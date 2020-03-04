# DHL Paket Parcel Management API SDK

The DHL Paket Parcel Management API SDK package offers an interface to the following web services:

- Parcel Management Checkout API

## Requirements

### System Requirements

- PHP 7.0+ with JSON extension

### Package Requirements

- `netresearch/jsonmapper`: Mapper for deserialization of JSON response messages into PHP objects
- `php-http/discovery`: Discovery service for HTTP client and message factory implementations
- `php-http/httplug`: Pluggable HTTP client abstraction
- `php-http/logger-plugin`: HTTP client logger plugin for HTTPlug
- `psr/http-client`: PSR-18 HTTP client interfaces
- `psr/http-factory`: PSR-7 HTTP message factory interfaces
- `psr/http-message`: PSR-7 HTTP message interfaces
- `psr/log`: PSR-3 logger interfaces

### Virtual Package Requirements

- `psr/http-client-implementation`: Any package that provides a PSR-18 compatible HTTP client
- `psr/http-factory-implementation`: Any package that provides PSR-7 compatible HTTP message factories
- `psr/http-message-implementation`: Any package that provides PSR-7 HTTP messages

### Development Package Requirements

- `nyholm/psr7`: PSR-7 HTTP message factory & message implementation
- `phpunit/phpunit`: Testing framework
- `php-http/mock-client`: HTTPlug mock client implementation
- `phpstan/phpstan`: Static analysis tool
- `squizlabs/php_codesniffer`: Static analysis tool

## Installation

```bash
$ composer require dhl/sdk-api-parcel-management
```

## Uninstallation

```bash
$ composer remove dhl/sdk-api-parcel-management
```

## Testing

```bash
$ ./vendor/bin/phpunit -c test/phpunit.xml
```

## Features

The DHL Paket Parcel Management API SDK supports the following features:

* Query available DHL services during checkout ([`/checkout/{recipientZip}/availableServices`](https://entwickler.dhl.de/en/group/ep/operationen1#!/checkout/get_checkout_recipientZip_availableServices))

### Available Services

To present the customer with valid DHL service options during checkout, this API endpoint can be used.
Available DHL services are calculated using the zip code of the recipient's address (`recipientZip`).

#### Public API

The library's components suitable for consumption comprise of

* services:
  * service factory
  * checkout service
* data transfer objects:
  * carrier services with availability flag and options (optional)
* exceptions

#### Usage

```php
$serviceFactory = new \Dhl\Sdk\Paket\ParcelManagement\Service\ServiceFactory();
$service = $serviceFactory->createCheckoutService(
    $applicationId = '4pp-1D',
    $applicationToken = '4pp-t0k3N',
    $ekp = '1234567890',
    $logger = new \Psr\Log\NullLogger(),
    $sandbox = true
);

$carrierServices = $service->getCarrierServices($postalCode = '12345', $dropOffDate = new \DateTime('2038-01-19'));

// process response as desired:
$getAvailableServices = function (
    array $availableServices,
    \Dhl\Sdk\Paket\ParcelManagement\Api\Data\CarrierServiceInterface $carrierService
) {
    if ($carrierService->isAvailable()) {
        $availableServices[$carrierService->getCode()] = $carrierService;
    }

    return $availableServices;
};

$availableServices = array_reduce($carrierServices, $getAvailableServices, []);
```
