<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service;

use Dhl\Sdk\Paket\ParcelManagement\Api\CheckoutServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Api\ServiceFactoryInterface;
use Dhl\Sdk\Paket\ParcelManagement\Http\HttpServiceFactory;
use Http\Discovery\HttpClientDiscovery;
use Psr\Log\LoggerInterface;

/**
 * Class ServiceFactory
 *
 * @author  Paul Siedler <paul.siedler@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class ServiceFactory implements ServiceFactoryInterface
{
    /**
     * Create the checkout service to retrieve applicable carrier services and estimated delivery dates during checkout.
     *
     * @param string $appId
     * @param string $appToken
     * @param string $ekp
     * @param LoggerInterface $logger
     * @param bool $sandboxMode
     * @return CheckoutServiceInterface
     */
    public function createCheckoutService(
        string $appId,
        string $appToken,
        string $ekp,
        LoggerInterface $logger,
        bool $sandboxMode = false
    ): CheckoutServiceInterface {
        $httpClient = HttpClientDiscovery::find();
        $httpServiceFactory = new HttpServiceFactory($httpClient);

        $authService = $httpServiceFactory->createCheckoutService($appId, $appToken, $ekp, $logger, $sandboxMode);

        return $authService;
    }
}
