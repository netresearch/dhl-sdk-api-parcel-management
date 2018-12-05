<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Test\Provider;

use Magento\Framework\Filesystem\Driver\File as Filesystem;

/**
 * Class RestResponseProvider
 *
 * @package Dhl\ParcelManagement\Test
 */
class RestResponseProvider
{
    /**
     * @return string[]
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public static function checkoutServiceRequestDataProvider(): array
    {
        $driver = new Filesystem();
        return [
            'response_1' => [
                $driver->fileGetContents(__DIR__ . '/_files/checkoutServiceRequest.json')
            ]
        ];
    }

    /**
     * @return string[]
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public static function checkoutServiceFailRequestDataProvider(): array
    {
        $driver = new Filesystem();
        return [
            'response_1' => [
                $driver->fileGetContents(__DIR__ . '/_files/checkoutServiceRequestFail.json')
            ]
        ];
    }
}
