<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\IntervalOptionInterface;

class IntervalOption implements IntervalOptionInterface
{
    public function __construct(private readonly string $start, private readonly string $end)
    {
    }

    public function getStart(): string
    {
        return $this->start;
    }

    public function getEnd(): string
    {
        return $this->end;
    }
}
