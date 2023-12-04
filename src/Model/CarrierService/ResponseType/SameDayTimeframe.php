<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class SameDayTimeframe
{
    private string $start;

    private string $end;

    private string $code;

    private string $denselyPopulatedAreaId;

    private string $denselyPopulatedAreaName;

    private string $deliveryBaseId;

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getDenselyPopulatedAreaId(): string
    {
        return $this->denselyPopulatedAreaId;
    }

    public function getDenselyPopulatedAreaName(): string
    {
        return $this->denselyPopulatedAreaName;
    }

    public function getDeliveryBaseId(): string
    {
        return $this->deliveryBaseId;
    }
}
