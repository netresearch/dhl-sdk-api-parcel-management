<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Api;

use Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;
use Http\Discovery\Exception\NotFoundException;
use Psr\Log\LoggerInterface;

/**
 * Interface ServiceFactoryInterface
 *
 * @api
 * @package Dhl\Sdk\Paket\ParcelManagement\Api
 * @author  Paul Siedler <paul.siedler@netresearch.de>
 * @link    https://www.netresearch.de/
 */
interface ServiceFactoryInterface
{
    const BASE_URL_PRODUCTION = 'https://cig.dhl.de/services/production/rest/';
    const BASE_URL_SANDBOX = 'https://cig.dhl.de/services/sandbox/rest/';

    const HEADER_X_EKP = 'X-EKP';

    /**
     * Create the checkout service to retrieve applicable services and estimated delivery dates during checkout.
     *
     * @param string $appId
     * @param string $appToken
     * @param string $ekp
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     * @return CheckoutService
     *
     * @throws NotFoundException
     */
    public function createCheckoutService(
        string $appId,
        string $appToken,
        string $ekp,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): CheckoutServiceInterface;
}
