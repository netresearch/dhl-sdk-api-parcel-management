<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Api;

use Dhl\ParcelManagement\Webservice\CheckoutService;
use Http\Client\HttpClient;
use Psr\Log\LoggerInterface;

/**
 * Interface ServiceFactoryInterface
 *
 * @package Dhl\ParcelManagement\Api
 */
interface ServiceFactoryInterface
{
    const BASE_URL = 'https://cig.dhl.de/services/production/rest/';

    const HEADER_X_EKP = 'X-EKP';

    /**
     * Creates the checkout service able to retrieve available checkout services
     *
     * @param string $appId
     * @param string $appToken
     * @param string $ekp
     * @param LoggerInterface $logger
     * @param string $baseUrl
     * @param HttpClient|null $client
     * @return CheckoutService
     */
    public function createCheckoutService(
        $appId,
        $appToken,
        $ekp,
        LoggerInterface $logger,
        HttpClient $client = null,
        $baseUrl = self::BASE_URL
    ): CheckoutService;
}
