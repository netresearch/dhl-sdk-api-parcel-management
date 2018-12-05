<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService;

use Dhl\ParcelManagement\Types\CheckoutService\Response\AvailableServicesMap;

/**
 * Class Response
 *
 * @package Dhl\ParcelManagement\Types
 */
class Response
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
