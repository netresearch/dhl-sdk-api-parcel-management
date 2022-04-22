<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api;

use Dhl\Sdk\Paket\ParcelManagement\Exception\ServiceException;
use Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;
use Psr\Log\LoggerInterface;

/**
 * @api
 */
interface ServiceFactoryInterface
{
    public const BASE_URL_PRODUCTION = 'https://cig.dhl.de/services/production/rest/';
    public const BASE_URL_SANDBOX = 'https://cig.dhl.de/services/sandbox/rest/';

    public const HEADER_X_EKP = 'X-EKP';

    /**
     * Create the checkout service to retrieve applicable carrier services and estimated delivery dates during checkout.
     *
     * @param string $appId
     * @param string $appToken
     * @param string $ekp
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     * @return CheckoutService
     *
     * @throws ServiceException
     */
    public function createCheckoutService(
        string $appId,
        string $appToken,
        string $ekp,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): CheckoutServiceInterface;
}
