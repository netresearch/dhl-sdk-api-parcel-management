<?php

/**
 * See LICENSE.md for license details.
 */

declare(strict_types=1);

namespace Dhl\Sdk\Paket\ParcelManagement\Service\CheckoutService;

use Dhl\Sdk\Paket\ParcelManagement\Api\Data\TimeFrameOptionInterface;

class TimeFrameOption implements TimeFrameOptionInterface
{
    public function __construct(
        private readonly string $start,
        private readonly string $end,
        private readonly string $code
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
}
