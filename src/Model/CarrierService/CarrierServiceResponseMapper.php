<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\CarrierServiceInterface;
use Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType\AvailableServicesMap;
use Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService\AreaTimeFrameOption;
use Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService\CarrierService;
use Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService\IntervalOption;
use Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService\TimeFrameOption;

class CarrierServiceResponseMapper
{
    /**
     * Map the webservice data structure to publicly response object suitable for third-party consumption.
     *
     * @param AvailableServicesMap $response
     * @return CarrierServiceInterface[]
     */
    public function map(AvailableServicesMap $response): array
    {
        $services = [];

        $preferredLocationService = new CarrierService(
            'preferredLocation',
            $response->getPreferredLocation()->isAvailable()
        );
        $preferredNeighbourService = new CarrierService(
            'preferredNeighbour',
            $response->getPreferredNeighbour()->isAvailable()
        );
        $inCarDeliveryService = new CarrierService(
            'inCarDelivery',
            $response->getInCarDelivery()->isAvailable()
        );
        $noNeighbourDeliveryService = new CarrierService(
            'noNeighbourDelivery',
            $response->getInCarDelivery()->isAvailable()
        );

        $preferredDayOptions = [];
        foreach ($response->getPreferredDay()->getValidDays() as $interval) {
            $preferredDayOptions[] = new IntervalOption($interval->getStart(), $interval->getEnd());
        }
        $preferredDayService = new CarrierService(
            'preferredDay',
            $response->getPreferredDay()->isAvailable(),
            $preferredDayOptions
        );

        $preferredTimeOptions = [];
        foreach ($response->getPreferredTime()->getTimeFrames() as $timeFrame) {
            $preferredTimeOptions[] = new TimeFrameOption(
                $timeFrame->getStart(),
                $timeFrame->getEnd(),
                $timeFrame->getCode()
            );
        }
        $preferredTimeService = new CarrierService(
            'preferredTime',
            $response->getPreferredTime()->isAvailable(),
            $preferredTimeOptions
        );

        $sameDayDeliveryOptions = [];
        foreach ($response->getSameDayDelivery()->getSameDayTimeframes() as $areaTimeFrame) {
            $sameDayDeliveryOptions[] = new AreaTimeFrameOption(
                $areaTimeFrame->getStart(),
                $areaTimeFrame->getEnd(),
                $areaTimeFrame->getCode(),
                $areaTimeFrame->getDenselyPopulatedAreaId(),
                $areaTimeFrame->getDenselyPopulatedAreaName(),
                $areaTimeFrame->getDeliveryBaseId()
            );
        }
        $sameDayDeliveryService = new CarrierService(
            'sameDayDelivery',
            $response->getSameDayDelivery()->isAvailable(),
            $sameDayDeliveryOptions
        );

        $services[] = $preferredLocationService;
        $services[] = $preferredNeighbourService;
        $services[] = $inCarDeliveryService;
        $services[] = $noNeighbourDeliveryService;
        $services[] = $preferredDayService;
        $services[] = $preferredTimeService;
        $services[] = $sameDayDeliveryService;

        return $services;
    }
}
