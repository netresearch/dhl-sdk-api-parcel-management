<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class SameDayDeliveryAvailable
{
    private bool $available;

    /**
     * @var SameDayTimeframe[]
     */
    private array $sameDayTimeframes;

    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return SameDayTimeframe[]
     */
    public function getSameDayTimeframes(): array
    {
        return $this->sameDayTimeframes;
    }
}
