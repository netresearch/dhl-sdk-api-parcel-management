<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService;

use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType\AvailableServicesMap;

class CarrierServiceResponseType
{
    public function __construct(private readonly AvailableServicesMap $availableServicesMap)
    {
    }

    public function getAvailableServicesMap(): AvailableServicesMap
    {
        return $this->availableServicesMap;
    }
}
