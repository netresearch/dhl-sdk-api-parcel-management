<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class PreferredTimeAvailable
{
    private bool $available;

    /**
     * @var Timeframe[]
     */
    private array $timeFrames;

    public function isAvailable(): bool
    {
        return $this->available;
    }

    /**
     * @return Timeframe[]
     */
    public function getTimeFrames(): array
    {
        return $this->timeFrames;
    }
}
