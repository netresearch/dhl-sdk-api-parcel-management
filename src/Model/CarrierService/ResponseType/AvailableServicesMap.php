<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class AvailableServicesMap
{
    private ServiceAvailable $preferredLocation;

    private ServiceAvailable $preferredNeighbour;

    private PreferredDayAvailable $preferredDay;

    private PreferredTimeAvailable $preferredTime;

    private ServiceAvailable $inCarDelivery;

    private SameDayDeliveryAvailable $sameDayDelivery;

    private ServiceAvailable $noNeighbourDelivery;

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
