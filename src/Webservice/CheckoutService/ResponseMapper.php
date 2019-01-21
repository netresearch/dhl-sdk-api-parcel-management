<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Webservice\CheckoutService;

/**
 * Class ResponseMapper
 *
 * @package Dhl\ParcelManagement\Webservice
 */
class ResponseMapper
{
    /**
     * @param $jsonString
     * @param $className
     * @return object
     * @throws \JsonMapper_Exception
     */
    public function map($jsonString, $className)
    {
        $jsonMapper = new \JsonMapper();
        $jsonMapper->bIgnoreVisibility = true;

        $jsonData = \json_decode($jsonString);

        return $jsonMapper->map($jsonData, new $className());
    }
}
