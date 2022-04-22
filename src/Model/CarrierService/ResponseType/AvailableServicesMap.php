<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class AvailableServicesMap
{
    /**
     * @var ServiceAvailable
     */
    private $preferredLocation;

    /**
     * @var ServiceAvailable
     */
    private $preferredNeighbour;

    /**
     * @var PreferredDayAvailable
     */
    private $preferredDay;

    /**
     * @var PreferredTimeAvailable
     */
    private $preferredTime;

    /**
     * @var ServiceAvailable
     */
    private $inCarDelivery;

    /**
     * @var SameDayDeliveryAvailable
     */
    private $sameDayDelivery;

    /**
     * @var ServiceAvailable
     */
    private $noNeighbourDelivery;

    public function getPreferredLocation(): ServiceAvailable
    {
        return $this->preferredLocation;
    }

    public function getPreferredNeighbour(): ServiceAvailable
    {
        return $this->preferredNeighbour;
    }

    public function getPreferredDay(): PreferredDayAvailable
    {
        return $this->preferredDay;
    }

    public function getPreferredTime(): PreferredTimeAvailable
    {
        return $this->preferredTime;
    }

    public function getInCarDelivery(): ServiceAvailable
    {
        return $this->inCarDelivery;
    }

    public function getSameDayDelivery(): SameDayDeliveryAvailable
    {
        return $this->sameDayDelivery;
    }

    public function getNoNeighbourDelivery(): ServiceAvailable
    {
        return $this->noNeighbourDelivery;
    }
}
