<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Api;

use Dhl\ParcelManagement\Webservice\CheckoutService;
use Http\Discovery\Exception\NotFoundException;
use Psr\Log\LoggerInterface;

/**
 * Interface ServiceFactoryInterface
 *
 * @package Dhl\ParcelManagement\Api
 */
interface ServiceFactoryInterface
{
    const BASE_URL_PRODUCTION = 'https://cig.dhl.de/services/production/rest/';
    const BASE_URL_SANDBOX = 'https://cig.dhl.de/services/sandbox/rest/';

    const HEADER_X_EKP = 'X-EKP';

    /**
     * Creates the checkout service able to retrieve available checkout services
     *
     * @param  string $appId
     * @param  string $appToken
     * @param  string $ekp
     * @param  LoggerInterface $logger
     * @param  bool $isSandboxMode
     * @return CheckoutService
     *
     * @throws NotFoundException
     */
    public function createCheckoutService(
        string $appId,
        string $appToken,
        string $ekp,
        LoggerInterface $logger,
        bool $isSandboxMode
    ): CheckoutService;
}
