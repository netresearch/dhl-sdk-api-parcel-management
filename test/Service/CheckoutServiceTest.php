<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Test\Service;

use Dhl\Sdk\Paket\ParcelManagement\Exception\AuthenticationException;
use Dhl\Sdk\Paket\ParcelManagement\Exception\ServiceException;
use Dhl\Sdk\Paket\ParcelManagement\Http\HttpServiceFactory;
use Dhl\Sdk\Paket\ParcelManagement\Test\Expectation\CheckoutServiceTestExpectation as Expectation;
use Dhl\Sdk\Paket\ParcelManagement\Test\Provider\CheckoutServiceTestProvider;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Log\Test\TestLogger;

/**
 * Class CheckoutServiceTest
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CheckoutServiceTest extends TestCase
{
    /**
     * @return int[][]|string[][]
     */
    public function successDataProvider()
    {
        return CheckoutServiceTestProvider::getCarrierServicesSuccess();
    }

    /**
     * @return int[][]|string[][]
     */
    public function errorDataProvider()
    {
        return CheckoutServiceTestProvider::getCarrierServicesError();
    }

    /**
     * Test checkout service success.
     *
     * Assert that request is logged.
     * Assert that response is logged.
     * Assert that available services are mapped properly.
     *
     * @test
     * @dataProvider successDataProvider
     *
     * @param int $status
     * @param string $contentType
     * @param string $responseBody
     * @throws ServiceException
     */
    public function getCarrierServicesSuccess(int $status, string $contentType, string $responseBody): void
    {
        $httpClient = new Client();
        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $servicesResponse = $responseFactory
            ->createResponse($status)
            ->withBody($streamFactory->createStream($responseBody))
            ->withHeader('Content-Type', $contentType);

        $httpClient->setDefaultResponse($servicesResponse);
        $logger = new TestLogger();
        $serviceFactory = new HttpServiceFactory($httpClient);

        $service = $serviceFactory->createCheckoutService('4pp-1D', '4pp-t0k3N', '1234567890', $logger, true);
        $carrierServices = $service->getCarrierServices('04229', new \DateTime('2019-02-21'));

        $request = $httpClient->getLastRequest();
        Expectation::assertRequestLogged($request, $logger);
        Expectation::assertResponseLogged($responseBody, $logger);
        Expectation::assertAvailableServices($responseBody, $carrierServices);
    }

    /**
     * Test checkout service error.
     *
     * Assert that request is logged.
     * Assert that error response is logged.
     * Assert that exception is thrown.
     *
     * @test
     * @dataProvider errorDataProvider
     *
     * @param int $status
     * @param string $contentType
     * @param string $responseBody
     * @throws ServiceException
     */
    public function getCarrierServicesError(int $status, string $contentType, string $responseBody): void
    {
        $this->expectExceptionCode($status);

        if ($status === 401) {
            $this->expectException(AuthenticationException::class);
        } elseif (($status >= 400) && ($status < 600)) {
            $this->expectException(ServiceException::class);
        } else {
            self::markTestIncomplete('Invalid mock response.');
        }

        $httpClient = new Client();
        $responseFactory = Psr17FactoryDiscovery::findResponseFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $servicesResponse = $responseFactory
            ->createResponse($status)
            ->withBody($streamFactory->createStream($responseBody))
            ->withHeader('Content-Type', $contentType);

        $httpClient->setDefaultResponse($servicesResponse);
        $logger = new TestLogger();
        $serviceFactory = new HttpServiceFactory($httpClient);

        $service = $serviceFactory->createCheckoutService('4pp-1D', '4pp-t0k3N', '1234567890', $logger, true);

        try {
            $service->getCarrierServices('12345', new \DateTime('1970-01-01'));
        } catch (ServiceException $exception) {
            $request = $httpClient->getLastRequest();

            Expectation::assertRequestLogged($request, $logger);
            Expectation::assertErrorResponseLogged($responseBody, $logger);

            throw $exception;
        }
    }
}
