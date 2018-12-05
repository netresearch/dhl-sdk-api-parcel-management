<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Test\Webservice;

use Dhl\ParcelManagement\Api\ServiceFactoryInterface;
use Dhl\ParcelManagement\Test\Provider\RestResponseProvider;

/**
 * Class ServiceFactoryTest
 *
 * @package Dhl\ParcelManagement\Test
 */
class ServiceFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @return string[]
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function checkoutServiceRequestDataProvider(): array
    {
        return RestResponseProvider::checkoutServiceRequestDataProvider();
    }

    /**
     * @return string[]
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function checkoutServiceFailRequestDataProvider(): array
    {
        return RestResponseProvider::checkoutServiceFailRequestDataProvider();
    }

    /**
     * @param string $responseBody
     * @dataProvider checkoutServiceRequestDataProvider
     * @throws \Dhl\ParcelManagement\Exception\ApiException
     */
    public function testCreateCheckoutService(string $responseBody)
    {
        $responseFactory = \Http\Discovery\MessageFactoryDiscovery::find();
        $client = new \Http\Mock\Client();
        $client->setDefaultResponse($responseFactory->createResponse(
            200,
            '',
            [],
            $responseBody
        ));

        $appId = 'appId';
        $appToken = 'appToken';
        $ekp = 'ekp';
        $mockRecipientZip = 'mockRecipientZip';
        $mockStartDate = 'mockStartDate';

        $serviceFactory = new \Dhl\ParcelManagement\Webservice\ServiceFactory();
        $checkoutService = $serviceFactory->createCheckoutService(
            $appId,
            $appToken,
            $ekp,
            new \Psr\Log\NullLogger(),
            \Dhl\ParcelManagement\Api\ServiceFactoryInterface::BASE_URL_PRODUCTION,
            $client
        );

        $response = $checkoutService->performRequest($mockRecipientZip, $mockStartDate);
        $request = $client->getLastRequest();

        self::assertNotFalse(
            strpos($request->getUri()->getPath(), $mockRecipientZip),
            'The recipient zip is not submitted in the request uri path.'
        );
        self::assertNotFalse(
            strpos($request->getUri()->getQuery(), 'startDate=' . $mockStartDate),
            'The start date is not submitted in the request uri query.'
        );

        self::assertEquals(
            'Basic ' . base64_encode(implode(':', [$appId, $appToken])),
            $request->getHeaderLine('Authorization'),
            'The authorization header is not set correctly.'
        );
        self::assertEquals(
            $ekp,
            $request->getHeaderLine(ServiceFactoryInterface::HEADER_X_EKP),
            'The EKP is not included in the request header.'
        );

        self::assertTrue(
            $response->getAvailableServicesMap()->getPreferredNeighbour()->isAvailable(),
            'The response object contains invalid data.'
        );
        self::assertEquals(
            '2018-12-08T00:00:00.000+01:00',
            $response->getAvailableServicesMap()->getPreferredDay()->getValidDays()[0]->getStart(),
            'The response object contains invalid data.'
        );
        self::assertEquals(
            '10:00',
            $response->getAvailableServicesMap()->getPreferredTime()->getTimeFrames()[0]->getStart(),
            'The response object contains invalid data.'
        );
        self::assertEquals(
            'Leipzig',
            $response->getAvailableServicesMap()->getSameDayDelivery()->getSameDayTimeframes()[0]
                ->getDenselyPopulatedAreaName(),
            'The response object contains invalid data.'
        );
    }

    /**
     * @param string $responseBody
     * @dataProvider checkoutServiceRequestDataProvider
     * @expectedException \Dhl\ParcelManagement\Exception\ApiException
     * @expectedExceptionMessage Unauthorized
     */
    public function testCreateCheckoutServiceFail(string $responseBody)
    {
        $responseFactory = \Http\Discovery\MessageFactoryDiscovery::find();
        $client = new \Http\Mock\Client();
        $client->setDefaultResponse($responseFactory->createResponse(
            401,
            '',
            [],
            $responseBody
        ));

        $serviceFactory = new \Dhl\ParcelManagement\Webservice\ServiceFactory();
        $checkoutService = $serviceFactory->createCheckoutService(
            'appId',
            'appToken',
            'ekp',
            new \Psr\Log\NullLogger(),
            \Dhl\ParcelManagement\Api\ServiceFactoryInterface::BASE_URL_PRODUCTION,
            $client
        );
        $checkoutService->performRequest('recipientZip', 'startDate');
    }
}
