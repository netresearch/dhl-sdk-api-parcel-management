<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService;

use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType\AvailableServicesMap;

/**
 * Class CarrierServiceResponseType
 *
 * @author  Max Melzer <max.melzer@netresearch.de>
 * @link    https://www.netresearch.de/
 */
class CarrierServiceResponseType
{
    /**
     * @var AvailableServicesMap
     */
    private $availableServicesMap;

    /**
     * Response constructor.
     *
     * @param AvailableServicesMap $availableServicesMap
     */
    public function __construct(AvailableServicesMap $availableServicesMap)
    {
        $this->availableServicesMap = $availableServicesMap;
    }

    /**
     * @return AvailableServicesMap
     */
    public function getAvailableServicesMap(): AvailableServicesMap
    {
        return $this->availableServicesMap;
    }
}
