<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Test\Expectation;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\CarrierServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Api\Data\IntervalOptionInterface;
use PHPUnit\Framework\Assert;
use Psr\Http\Message\RequestInterface;
use Psr\Log\Test\TestLogger;

/**
 * Class CheckoutServiceTestExpectation
 *
 * @author  Christoph Aßmann <christoph.assmann@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CheckoutServiceTestExpectation
{
    /**
     * Assert that web service response json was properly mapped to service response objects.
     *
     * @param string $responseJson
     * @param CarrierServiceInterface[] $carrierServices
     */
    public static function assertAvailableServices(string $responseJson, array $carrierServices)
    {
        $expected = json_decode($responseJson, true);

        // assert that the number of available carrier services in the response json matches with service response.
        $expectedCount = array_reduce($expected, function (array $carry, array $service) {
            $carry['total']++;
            $carry['available'] += (int) $service['available'];

            return $carry;
        }, ['total' => 0, 'available' => 0]);

        /** @var CarrierServiceInterface[] $availableServices */
        $availableServices = array_reduce(
            $carrierServices,
            function (array $carry, CarrierServiceInterface $carrierService) {
                if ($carrierService->isAvailable()) {
                    $carry[$carrierService->getCode()] = $carrierService;
                }

                return $carry;
            },
            []
        );

        Assert::assertCount($expectedCount['total'], $carrierServices);
        Assert::assertCount($expectedCount['available'], $availableServices);

        $optionsMap = [
            'preferredDay' => 'validDays',
            'preferredTime' => 'timeframes',
            'sameDayDelivery' => 'sameDayTimeframes',
        ];

        foreach ($expected as $serviceCode => $service) {
            // assert availability flag is properly mapped.
            if ($service['available']) {
                Assert::assertArrayHasKey($serviceCode, $availableServices);
            } else {
                Assert::assertArrayNotHasKey($serviceCode, $availableServices);
            }

            if (in_array($serviceCode, array_keys($optionsMap))) {
                // assert that number of options in the response json matches with service response.
                $expectedOptions = $service[$optionsMap[$serviceCode]];
                $actualOptions = $availableServices[$serviceCode]->getOptions();

                Assert::assertNotEmpty($actualOptions);
                Assert::assertContainsOnlyInstancesOf(IntervalOptionInterface::class, $actualOptions);
                Assert::assertCount(count($expectedOptions), $actualOptions);
            }
        }
    }

    /**
     * Assert that logger contains records with HTTP status code and messages.
     *
     * @param RequestInterface $request
     * @param TestLogger $logger
     */
    public static function assertRequestLogged(
        RequestInterface $request,
        TestLogger $logger
    ) {
        Assert::assertTrue($logger->hasInfoRecords(), 'Logger has no info messages');

        $uriRegex = '|services/[a-z]+/rest/checkout/\d{5}/availableServices\?startDate=\d+|';
        foreach ($request->getHeaders() as $name => $values) {
            $logger->hasInfoThatContains($values[0]);
        }

        Assert::assertTrue($logger->hasInfoThatMatches($uriRegex), 'Logged messages do not contain request');
    }

    /**
     * @param string $responseJson
     * @param TestLogger $logger
     */
    public static function assertResponseLogged(string $responseJson, TestLogger $logger)
    {
        $statusRegex = '|^HTTP/\d\.\d\s\d{3}\s[\w\s]+$|m';
        $hasResponseStatus = $logger->hasInfoThatMatches($statusRegex);
        $hasResponse = $logger->hasInfoThatContains($responseJson);

        Assert::assertTrue($hasResponseStatus, 'Logged messages do not contain response status code.');
        Assert::assertTrue($hasResponse, 'Logged messages do not contain response');
    }

    /**
     * @param string $responseBody
     * @param TestLogger $logger
     */
    public static function assertErrorResponseLogged(string $responseBody, TestLogger $logger)
    {
        $statusRegex = '|^HTTP/\d\.\d\s\d{3}\s[\w\s]+$|m';
        $hasResponseStatus = $logger->hasErrorThatMatches($statusRegex);
        $hasResponse = $logger->hasErrorThatContains($responseBody);

        Assert::assertTrue($hasResponseStatus, 'Logged messages do not contain response status code.');
        Assert::assertTrue($hasResponse, 'Logged messages do not contain response');
    }
}
