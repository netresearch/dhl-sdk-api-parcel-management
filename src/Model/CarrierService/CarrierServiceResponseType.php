<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService;

use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType\AvailableServicesMap;

class CarrierServiceResponseType
{
    /**
     * @var AvailableServicesMap
     */
    private $availableServicesMap;

    public function __construct(AvailableServicesMap $availableServicesMap)
    {
        $this->availableServicesMap = $availableServicesMap;
    }

    public function getAvailableServicesMap(): AvailableServicesMap
    {
        return $this->availableServicesMap;
    }
}
