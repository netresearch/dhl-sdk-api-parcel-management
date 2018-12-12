<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Test\Webservice;

use Dhl\ParcelManagement\Api\ServiceFactoryInterface;
use Dhl\ParcelManagement\Test\Provider\RestResponseProvider;
use Dhl\ParcelManagement\Webservice\CheckoutService;
use Http\Client\Exception\HttpException;
use PHPUnit\Framework\TestCase;

class CheckoutServiceTest extends TestCase
{
    /**
     * @return string[][]
     */
    public function checkoutServiceRequestDataProvider(): array
    {
        return RestResponseProvider::checkoutServiceRequestDataProvider();
    }

    /**
     * @return string[][]
     */
    public function checkoutServiceFailRequestDataProvider(): array
    {
        return RestResponseProvider::checkoutServiceFailRequestDataProvider();
    }

    /**
     * @dataProvider checkoutServiceRequestDataProvider
     */
    public function testGetAvailableServices(string $responseBody)
    {
        $responseFactory = \Http\Discovery\MessageFactoryDiscovery::find();
        $client = new \Http\Mock\Client();
        $client->setDefaultResponse(
            $responseFactory->createResponse(
                200,
                '',
                [],
                $responseBody
            )
        );

        $mockRecipientZip = 'mockRecipientZip';
        $mockStartDate = 'mockStartDate';

        $checkoutService = new CheckoutService(
            ServiceFactoryInterface::BASE_URL_PRODUCTION,
            $responseFactory,
            $client
        );

        $response = $checkoutService->getAvailableServices($mockRecipientZip, $mockStartDate);
        $request = $client->getLastRequest();

        self::assertNotFalse(
            strpos($request->getUri()->getPath(), $mockRecipientZip),
            'The recipient zip is not submitted in the request uri path.'
        );

        self::assertNotFalse(
            strpos($request->getUri()->getQuery(), 'startDate=' . $mockStartDate),
            'The start date is not submitted in the request uri query.'
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
     * @dataProvider checkoutServiceFailRequestDataProvider
     * @expectedException \Dhl\ParcelManagement\Exception\AuthenticationException
     * @expectedExceptionMessage error
     */
    public function testCreateCheckoutServiceFail(string $responseBody)
    {
        $responseFactory = \Http\Discovery\MessageFactoryDiscovery::find();
        $client = new \Http\Mock\Client();
        $client->setDefaultException(
            new HttpException(
                'error',
                $responseFactory->createRequest(
                    'GET',
                    '',
                    [],
                    ''
                ),
                $responseFactory->createResponse(
                    401,
                    '',
                    [],
                    $responseBody
                )
            )
        );

        $checkoutService = new CheckoutService(
            ServiceFactoryInterface::BASE_URL_PRODUCTION,
            $responseFactory,
            $client
        );

        $checkoutService->getAvailableServices('recipientZip', 'startDate');
    }
}
