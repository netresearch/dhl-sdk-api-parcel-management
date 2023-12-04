<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class PreferredDayAvailable
{
    private bool $available;

    /**
     * @var TimeInterval[]
     */
    private array $validDays;

    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return TimeInterval[]
     */
    public function getValidDays(): array
    {
        return $this->validDays;
    }
}
