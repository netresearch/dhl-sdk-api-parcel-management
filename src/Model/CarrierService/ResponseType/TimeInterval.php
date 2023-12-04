<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Model\CarrierService\ResponseType;

class TimeInterval
{
    private string $start;

    private string $end;

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }
}
