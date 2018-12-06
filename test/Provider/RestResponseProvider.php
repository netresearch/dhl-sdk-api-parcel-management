<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Test\Provider;

/**
 * Class RestResponseProvider
 *
 * @package Dhl\ParcelManagement\Test
 */
class RestResponseProvider
{
    /**
     * @return string[]
     */
    public static function checkoutServiceRequestDataProvider(): array
    {
        return [
            'response_1' => [
                file_get_contents(
                    __DIR__ . DIRECTORY_SEPARATOR . '_files/checkoutServiceResponse.json'
                ) ?: '',
            ],
        ];
    }

    /**
     * @return string[]
     */
    public static function checkoutServiceFailRequestDataProvider(): array
    {
        return [
            'response_1' => [
                file_get_contents(
                    __DIR__ . DIRECTORY_SEPARATOR . '_files/checkoutServiceResponseFail.json'
                ) ?: '',
            ],
        ];
    }
}
