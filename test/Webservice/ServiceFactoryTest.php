<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Test\Webservice;

use Dhl\ParcelManagement\Webservice\CheckoutService;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\Strategy\MockClientStrategy;

/**
 * Class ServiceFactoryTest
 *
 * @package Dhl\ParcelManagement\Test
 */
class ServiceFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param        string $responseBody
     * @throws       \Dhl\ParcelManagement\Exception\ApiException
     */
    public function testCreateCheckoutService()
    {
        HttpClientDiscovery::prependStrategy(MockClientStrategy::class);

        $appId = 'appId';
        $appToken = 'appToken';
        $ekp = 'ekp';

        $serviceFactory = new \Dhl\ParcelManagement\Webservice\ServiceFactory();
        $checkoutService = $serviceFactory->createCheckoutService(
            $appId,
            $appToken,
            $ekp,
            new \Psr\Log\NullLogger(),
            false
        );

        $this->assertInstanceOf(CheckoutService::class, $checkoutService);
    }
}
