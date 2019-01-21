<?php
/**
 * See LICENSE.md for license details.
 */
declare(strict_types=1);

namespace Dhl\ParcelManagement\Types\CheckoutService\Response;

/**
 * Class AvailableServicesMap
 *
 * @package Dhl\ParcelManagement\Types
 */
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

    /**
     * @return ServiceAvailable
     */
    public function getPreferredLocation(): ServiceAvailable
    {
        return $this->preferredLocation;
    }

    /**
     * @return ServiceAvailable
     */
    public function getPreferredNeighbour(): ServiceAvailable
    {
        return $this->preferredNeighbour;
    }

    /**
     * @return PreferredDayAvailable
     */
    public function getPreferredDay(): PreferredDayAvailable
    {
        return $this->preferredDay;
    }

    /**
     * @return PreferredTimeAvailable
     */
    public function getPreferredTime(): PreferredTimeAvailable
    {
        return $this->preferredTime;
    }

    /**
     * @return ServiceAvailable
     */
    public function getInCarDelivery(): ServiceAvailable
    {
        return $this->inCarDelivery;
    }

    /**
     * @return SameDayDeliveryAvailable
     */
    public function getSameDayDelivery(): SameDayDeliveryAvailable
    {
        return $this->sameDayDelivery;
    }

    /**
     * @return ServiceAvailable
     */
    public function getNoNeighbourDelivery(): ServiceAvailable
    {
        return $this->noNeighbourDelivery;
    }
}
