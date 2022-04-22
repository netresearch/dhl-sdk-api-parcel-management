<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Test\Provider;

class CheckoutServiceTestProvider
{
    /**
     * Provide responses for the test case
     * - request sent to the API, services successfully returned.
     *
     * @return int[][]|string[][]
     */
    public static function getCarrierServicesSuccess()
    {
        $availableServicesResponse = \file_get_contents(__DIR__ . '/_files/checkout/success.json');

        return [
            '200 ok' => [200, 'application/json', $availableServicesResponse],
        ];
    }

    /**
     * Provide responses for the test case
     * - request sent to the API, error returned
     *
     * @return int[][]|string[][]
     */
    public static function getCarrierServicesError()
    {
        // note: errors don't care about "Accept" header.
        $badRequestResponse = \file_get_contents(__DIR__ . '/_files/checkout/badRequest.json');
        $unauthorizedResponse = \file_get_contents(__DIR__ . '/_files/checkout/unauthorized.html');
        $serverErrorResponse = \file_get_contents(__DIR__ . '/_files/checkout/serverError.html');

        return [
            '400 bad request' => [400, 'application/json', $badRequestResponse],
            '401 unauthorized' => [401, 'text/html', $unauthorizedResponse],
            '500 server error' => [500, 'text/html', $serverErrorResponse],
        ];
    }
}
