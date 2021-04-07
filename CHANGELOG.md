# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## 3.0.0

### Changed

- Argument type of `$startDate` in `CheckoutService::getCarrierServices`
  was changed from `\DateTime` to `\DateTimeInterface`.

## 2.0.0 - 2020-03-04

### Changed

- HTTPlug package is upgraded to version 2.
- PHP-HTTP packages are replaced by their PSR successors. SDK now requires a `psr/http-client-implementation`.

### Removed

- PHP 7.0 is no longer supported.

## 1.0.0 - 2019-12-02

### Changed

- Specific (public api) entry points for SDK usage are provided.
- HTTPlug version 1 is used with PHP-HTTP (virtual) packages. SDK now requires a `php-http/client-implementation`.
- Generated code is replaced by handcrafted request/response models.

### Removed

- The `checkout` endpoint's `deliveryDayEstimation` operation is no longer supported.
- The `intransit` endpoint is no longer supported.

## 0.1.1 - 2019-01-22

### Added

- Initial release generated with [Swagger Codegen](https://github.com/swagger-api/swagger-codegen)
