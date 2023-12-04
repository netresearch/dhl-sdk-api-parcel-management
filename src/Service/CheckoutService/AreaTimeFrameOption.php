<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\AreaTimeFrameOptionInterface;

class AreaTimeFrameOption implements AreaTimeFrameOptionInterface
{
    public function __construct(
        private readonly string $start,
        private readonly string $end,
        private readonly string $code,
        private readonly string $denselyPopulatedAreaId,
        private readonly string $denselyPopulatedAreaName,
        private readonly string $deliveryBaseId
    ) {
    }

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
